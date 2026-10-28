<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Invoice;
use App\Models\Unit;
use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ResetDemoSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Clear bookings and invoices
        DB::table('booking_unit')->truncate();
        Booking::truncate();
        Invoice::truncate();

        // 2. Reset Units: Ensure every item has exactly 20 active units
        // Delete all units first
        Unit::truncate();

        $items = Item::all();
        foreach ($items as $item) {
            for ($i = 1; $i <= 20; $i++) {
                Unit::create([
                    'item_id'   => $item->id,
                    'serial_no' => strtoupper(Str::random(6)) . '-' . $item->id . '-' . $i,
                    'status'    => 'active',
                ]);
            }
        }
    }
}
