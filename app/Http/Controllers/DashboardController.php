<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Item;
use App\Models\Unit;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEquipment = Item::count();

        $activeUnits = Unit::where('status', 'active')->count();

        $totalBookings = Booking::count();

        $heldBookings = Booking::where('status', 'held')->count();

        $confirmedBookings = Booking::where('status', 'confirmed')->count();

        $recentBookings = Booking::with(['item', 'unit'])
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard', compact(
            'totalEquipment',
            'activeUnits',
            'totalBookings',
            'heldBookings',
            'confirmedBookings',
            'recentBookings'
        ));
    }

    public function bookings()
    {
        $bookings = Booking::with(['item', 'unit'])
            ->latest()
            ->paginate(15);

        return view('owner.bookings', compact('bookings'));
    }

    public function updateBooking(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:confirmed,rejected'],
        ]);

        if ($booking->status !== 'held') {
            return back()->with('error', 'Only pending booking holds can be updated.');
        }

        if (
            $validated['status'] === 'confirmed'
            && $booking->hold_expires_at !== null
            && $booking->hold_expires_at->isPast()
        ) {
            return back()->with('error', 'This booking hold has expired and cannot be confirmed.');
        }

        $booking->update([
            'status' => $validated['status'],
            'hold_expires_at' => null,
        ]);

        return back()->with(
            'success',
            $validated['status'] === 'confirmed'
                ? 'Booking confirmed successfully.'
                : 'Booking rejected successfully.'
        );
    }
}
