<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'unit_id',
        'item_id',
        'customer_name',
        'customer_email',
        'start_date',
        'end_date',
        'status',
        'source',
        'external_ref',
        'hold_expires_at',
        'total_price',
        'invoice_sent_at',
    ];

    protected $dates = ['hold_expires_at', 'invoice_sent_at'];
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'hold_expires_at' => 'datetime',
        'invoice_sent_at' => 'datetime',
        'total_price' => 'decimal:2',
    ];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function units(): BelongsToMany
    {
        return $this->belongsToMany(Unit::class, 'booking_unit');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
