<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Shop;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RentGridSeeder extends Seeder
{
    public function run(): void
    {
        $shop = Shop::firstOrCreate(
            ['name' => 'Bengaluru Camera Rentals'],
            [
                'city' => 'Bengaluru',
                'timezone' => 'Asia/Kolkata',
            ]
        );

        User::updateOrCreate(
            ['email' => 'owner@rentgrid.test'],
            [
                'name' => 'RentGrid Owner',
                'password' => Hash::make('Owner@12345'),
                'role' => 'owner',
                'shop_id' => $shop->id,
            ]
        );

        User::updateOrCreate(
            ['email' => 'staff@rentgrid.test'],
            [
                'name' => 'RentGrid Staff',
                'password' => Hash::make('Staff@12345'),
                'role' => 'staff',
                'shop_id' => $shop->id,
            ]
        );

        $item = Item::firstOrCreate(
            [
                'shop_id' => $shop->id,
                'name' => 'Canon EOS R50',
            ],
            [
                'category' => 'Camera',
                'description' => 'Mirrorless camera for photography and video.',
                'daily_price' => 1500.00,
            ]
        );

        foreach (['CAM-R50-001', 'CAM-R50-002', 'CAM-R50-003'] as $serial) {
            Unit::firstOrCreate(
                ['serial_no' => $serial],
                [
                    'item_id' => $item->id,
                    'status' => 'active',
                ]
            );
        }
    }
}
