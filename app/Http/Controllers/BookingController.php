 <?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Item;
use App\Models\Unit;
use Illuminate\Http\Request;
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
        ]);

        $booking = DB::transaction(function () use ($item, $validated) {
            // Lock active units for this item so concurrent requests
            // cannot allocate the same unit simultaneously.
            $units = Unit::where('item_id', $item->id)
                ->where('status', 'active')
                ->orderBy('id')
                ->lockForUpdate()
                ->get();

            foreach ($units as $unit) {
                $overlappingBooking = Booking::where('unit_id', $unit->id)
                    ->whereIn('status', ['held', 'confirmed'])
                    ->whereDate('start_date', '<=', $validated['end_date'])
                    ->whereDate('end_date', '>=', $validated['start_date'])
                    ->where(function ($query) {
                        $query->whereNull('hold_expires_at')
                            ->orWhere('hold_expires_at', '>', now())
                            ->orWhere('status', 'confirmed');
                    })
                    ->exists();

                $blocked = $unit->blackoutDates()
                    ->whereDate('start_date', '<=', $validated['end_date'])
                    ->whereDate('end_date', '>=', $validated['start_date'])
                    ->exists();

                if (!$overlappingBooking && !$blocked) {
                    $start = \Carbon\Carbon::parse($validated['start_date']);
                    $end = \Carbon\Carbon::parse($validated['end_date']);

                    // Inclusive rental dates: one selected day costs one day.
                    $days = $start->diffInDays($end) + 1;
                    $total = $days * (float) $item->daily_price;

                    return Booking::create([
                        'unit_id' => $unit->id,
                        'item_id' => $item->id,
                        'customer_name' => $validated['customer_name'],
                        'customer_email' => $validated['customer_email'],
                        'start_date' => $validated['start_date'],
                        'end_date' => $validated['end_date'],
                        'status' => 'held',
                        'source' => 'marketplace',
                        'hold_expires_at' => now()->addMinutes(15),
                        'total_price' => $total,
                    ]);
                }
            }

            throw ValidationException::withMessages([
                'start_date' => 'Sorry, this equipment is unavailable for the selected dates. Please try different dates.',
            ]);
        });

        return redirect()
            ->route('marketplace.booking-success', $booking)
            ->with('success', 'Your booking request has been saved.');
    }

    public function success(Booking $booking)
    {
        return view('marketplace.booking-success', compact('booking'));
    }
}