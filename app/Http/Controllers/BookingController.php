<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Item;
use App\Models\Unit;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    public function store(Request $request, Item $item)
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        // Compute the number of days (inclusive)
        $start = Carbon::parse($validated['start_date']);
        $end   = Carbon::parse($validated['end_date']);
        $days  = $start->diffInDays($end) + 1;

        // Verify enough units are available for the requested dates
        $available = $item->availableQuantity($validated['start_date'], $validated['end_date']);
        if ($validated['quantity'] > $available) {
            throw ValidationException::withMessages([
                'quantity' => ["Only {$available} unit(s) are available for the selected dates."]
            ]);
        }

        // Allocate specific units inside a DB transaction to avoid race‑conditions
        $booking = DB::transaction(function () use ($item, $validated, $days) {
            // Lock candidate units now
            $candidateUnits = Unit::where('item_id', $item->id)
                ->where('status', 'active')
                ->whereNotIn('id', function ($q) use ($validated) {
                    $q->select('unit_id')
                        ->from('bookings')
                        ->whereIn('status', ['held', 'confirmed'])
                        ->whereDate('start_date', '<=', $validated['end_date'])
                        ->whereDate('end_date', '>=', $validated['start_date']);
                })
                ->orderBy('id')
                ->limit($validated['quantity'])
                ->lockForUpdate()
                ->get();

            // Create the booking with status held (15‑minute hold)
            $booking = Booking::create([
                'unit_id' => $candidateUnits->first()->id, // primary unit for legacy column
                'item_id' => $item->id,
                'customer_name' => $validated['customer_name'],
                'customer_email' => $validated['customer_email'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'quantity' => $validated['quantity'],
                'status' => 'held',
                'source' => 'marketplace',
                'hold_expires_at' => now()->addMinutes(15),
                'total_price' => $item->daily_price * $days * $validated['quantity'],
            ]);

            // Attach the allocated units via the pivot table
            $booking->units()->sync($candidateUnits->map(function ($u) {
                return $u->id;
            }));

            // Mark these units as "reserved" – you could add a status column if you like.
            $candidateUnits->each(function ($u) {
                $u->status = 'reserved';
                $u->save();
            });

            // Generate invoice record immediately (you may move this to a later step after payment)
            $subtotal = $item->daily_price * $days * $validated['quantity'];
            $taxRate = config('rentgrid.tax_rate', 0.10);
            $tax = round($subtotal * $taxRate, 2);
            $total = $subtotal + $tax;
            $invoice = Invoice::create([
                'invoice_number' => 'INV-' . now()->format('YmdHis') . '-' . strtoupper(Str::random(6)),
                'booking_id' => $booking->id,
                'subtotal' => $subtotal,
                'tax' => $tax,
                'total' => $total,
            ]);

            // Link the invoice to the booking (optional – you can also fetch via relationship)
            $booking->invoice_id = $invoice->id;
            $booking->save();

            return $booking;
        });

        return redirect()
            ->route('marketplace.booking-success', $booking)
            ->with('success', 'Your booking request has been saved and an invoice generated.');
    }

    public function success(Booking $booking)
    {
        // Load related data for the view
        $booking->load(['item', 'units', 'invoice']);
        return view('marketplace.booking-success', compact('booking'));
    }

    /**
     * Cancel a booking – URL must be signed to protect against abuse.
     */
    public function cancel(Request $request, Booking $booking)
    {
        if ($booking->status !== 'held' && $booking->status !== 'confirmed') {
            abort(400, 'Only pending bookings can be cancelled');
        }

        DB::transaction(function () use ($booking) {
            // Release the units
            $booking->units()
                ->update(['status' => 'active']);

            // Detach pivot records (optional – keeps a history)
            $booking->units()->sync([]);

            // Mark booking as cancelled
            $booking->status = 'cancelled';
            $booking->save();
        });

        return back()->with('status', 'Booking cancelled and inventory restored.');
    }
}
