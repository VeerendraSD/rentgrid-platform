<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SyncJobLog extends Model
{
    use HasFactory;

    protected $table = 'sync_jobs_log';

    protected $fillable = [
        'item_id',
        'target',
        'payload',
        'idempotency_key',
        'status',
        'attempts',
        'last_error',
        'synced_at',
    ];

    protected function casts(): array
    {
        return [
            'payload' => 'array',
            'attempts' => 'integer',
            'synced_at' => 'datetime',
        ];
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}