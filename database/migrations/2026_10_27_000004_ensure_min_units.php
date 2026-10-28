<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use App\Models\Unit;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        // Ensure every item has at least 20 active units
        foreach (Item::all() as $item) {
            $existing = Unit::where('item_id', $item->id)
                ->where('status', 'active')
                ->count();
            $needed = max(0, 20 - $existing);
            for ($i = 1; $i <= $needed; $i++) {
                $serial = strtoupper(Str::random(8)) . '-'. $item->id . '-' . ($existing + $i);
                Unit::create([
                    'serial_no' => $serial,
                    'item_id' => $item->id,
                    'status' => 'active',
                ]);
            }
        }
    }

    public function down(): void
    {
        // No rollback – we only ever add units
    }
};
