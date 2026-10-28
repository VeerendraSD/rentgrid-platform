<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Shop;
use App\Models\Booking;
use App\Models\Unit;

class Item extends Model
{
    public function shop(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    public function units(): HasMany
    {
        return $this->hasMany(Unit::class);
    }

    /**
     * Return the total number of active units for this item.
     */
    public function totalQuantity(): int
    {
        return $this->units()
            ->where('status', 'active')
            ->count();
    }

    /**
     * Return the number of units that are NOT booked (or are booked but outside a given date range).
     */
    public function availableQuantity(string $startDate, string $endDate): int
    {
        // Units that have a conflicting booking (held or confirmed) in the period.
        $conflictingUnitIds = Booking::whereIn('status', ['held', 'confirmed'])
            ->whereDate('start_date', '<=', $endDate)
            ->whereDate('end_date', '>=', $startDate)
            ->pluck('unit_id')
            ->toArray();

        return $this->units()
            ->where('status', 'active')
            ->whereNotIn('id', $conflictingUnitIds)
            ->count();
    }
}
