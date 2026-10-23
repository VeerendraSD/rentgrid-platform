<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('shop_id')
                ->constrained('shops')
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('category')->index();
            $table->text('description')->nullable();
            $table->decimal('daily_price', 10, 2);

            $table->timestamps();

            $table->index(['shop_id', 'category']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};