<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RentGridSeeder::class);
        $this->call(AddMoreProductsSeeder::class);
        $this->call(ResetDemoSeeder::class);
    }
}