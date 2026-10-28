<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // SQLite doesn't support enum modification directly, so we need to recreate the table
        // For other databases, we can use ALTER TABLE
        $driverName = DB::connection()->getDriverName();
        if ($driverName === 'sqlite') {
            // Create a new table with the updated enum
            Schema::create('units_new', function (Blueprint $table) {
                $table->id();
                $table->foreignId('item_id')
                    ->constrained('items')
                    ->cascadeOnDelete();
                $table->string('serial_no')->unique();
                $table->enum('status', [
                    'active',
                    'maintenance',
                    'reserved',
                ])->default('active');
                $table->timestamps();
                $table->index(['item_id', 'status']);
            });

            // Copy data
                            DB::statement('INSERT INTO units_new (id, item_id, serial_no, status, created_at, updated_at) SELECT id, item_id, serial_no, COALESCE(status, "active"), created_at, updated_at FROM units');

            // Drop old table and rename
            Schema::drop('units');
            Schema::rename('units_new', 'units');
        } else {
            // For MySQL/PostgreSQL
            DB::statement("ALTER TABLE units MODIFY COLUMN status ENUM('active', 'maintenance', 'reserved') DEFAULT 'active'");
        }
    }

    public function down(): void
    {
        $driverName = DB::connection()->getDriverName();
        if ($driverName === 'sqlite') {
            Schema::disableForeignKeyConstraints();
            if (Schema::hasTable('units_old')) {
                Schema::drop('units_old');
            }
            Schema::create('units_old', function (Blueprint $table) {
                $table->id();
                $table->foreignId('item_id')
                    ->constrained('items')
                    ->cascadeOnDelete();
                $table->string('serial_no')->unique();
                $table->enum('status', [
                    'active',
                    'maintenance',
                ])->default('active');
                $table->timestamps();
                $table->index(['item_id', 'status']);
            });

            DB::statement('INSERT INTO units_old (id, item_id, serial_no, status, created_at, updated_at) SELECT id, item_id, serial_no, CASE WHEN status = "reserved" THEN "active" ELSE status END, created_at, updated_at FROM units');
            Schema::drop('units');
            Schema::rename('units_old', 'units');
            Schema::enableForeignKeyConstraints();
        } else {
            DB::statement("ALTER TABLE units MODIFY COLUMN status ENUM('active', 'maintenance') DEFAULT 'active'");
        }
    }
};