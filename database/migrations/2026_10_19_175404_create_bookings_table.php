<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('unit_id')
                ->constrained('units')
                ->restrictOnDelete();

            $table->foreignId('item_id')
                ->constrained('items')
                ->restrictOnDelete();

            $table->string('customer_name');
            $table->string('customer_email');

            $table->date('start_date');
            $table->date('end_date');

            $table->enum('status', [
                'held',
                'confirmed',
                'cancelled',
                'expired',
            ])->default('held');

            $table->enum('source', [
                'web',
                'marketplace',
            ])->default('web');

            $table->string('external_ref')->nullable()->unique();
            $table->timestamp('hold_expires_at')->nullable();

            $table->decimal('total_price', 10, 2);

            $table->timestamps();

            $table->index([
                'unit_id',
                'start_date',
                'end_date',
                'status',
            ]);

            $table->index(['item_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};