<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Shop;
use App\Models\Unit;
use Illuminate\Database\Seeder;

class AddMoreProductsSeeder extends Seeder
{
    public function run(): void
    {
        // Get or create shops
        $shops = [
            Shop::firstOrCreate(
                ['name' => 'Bengaluru Camera Rentals'],
                ['city' => 'Bengaluru', 'timezone' => 'Asia/Kolkata']
            ),
            Shop::firstOrCreate(
                ['name' => 'Mumbai Adventure Gear'],
                ['city' => 'Mumbai', 'timezone' => 'Asia/Kolkata']
            ),
            Shop::firstOrCreate(
                ['name' => 'Delhi Power Tools'],
                ['city' => 'Delhi', 'timezone' => 'Asia/Kolkata']
            ),
            Shop::firstOrCreate(
                ['name' => 'Chennai Bicycles Plus'],
                ['city' => 'Chennai', 'timezone' => 'Asia/Kolkata']
            ),
        ];

        $products = [
            // Cameras
            [
                'shop_index' => 0,
                'name' => 'Sony A7 III Mirrorless Camera',
                'category' => 'Camera',
                'description' => 'Full-frame mirrorless camera with 24.2MP sensor, 4K video recording, excellent low-light performance. Perfect for professional photography and videography.',
                'daily_price' => 2500.00,
                'units' => ['SONY-A7III-001', 'SONY-A7III-002']
            ],
            [
                'shop_index' => 0,
                'name' => 'Canon EOS R5 Mirrorless',
                'category' => 'Camera',
                'description' => 'Professional 45MP full-frame mirrorless camera with 8K video, in-body stabilization, and dual card slots.',
                'daily_price' => 4500.00,
                'units' => ['CANON-R5-001', 'CANON-R5-002', 'CANON-R5-003']
            ],
            [
                'shop_index' => 0,
                'name' => 'DJI Mavic 3 Pro Drone',
                'category' => 'Camera',
                'description' => 'Professional drone with 4/3 CMOS Hasselblad camera, 43-minute flight time, obstacle avoidance, and 15km transmission range.',
                'daily_price' => 3500.00,
                'units' => ['DJI-M3P-001', 'DJI-M3P-002']
            ],

            // Bicycles
            [
                'shop_index' => 3,
                'name' => 'Trek FX 3 Hybrid Commuter Bike',
                'category' => 'Bicycles',
                'description' => 'Lightweight aluminum hybrid bike perfect for city commuting and weekend rides. Includes 21-speed gears and front suspension.',
                'daily_price' => 500.00,
                'units' => ['TREK-FX3-001', 'TREK-FX3-002', 'TREK-FX3-003', 'TREK-FX3-004']
            ],
            [
                'shop_index' => 3,
                'name' => 'Giant ATX 1 Mountain Bike',
                'category' => 'Bicycles',
                'description' => 'Full suspension mountain bike for off-road trails. 27.5" wheels, hydraulic disc brakes, and 18-speed Shimano gears.',
                'daily_price' => 800.00,
                'units' => ['GIANT-ATX1-001', 'GIANT-ATX1-002', 'GIANT-ATX1-003']
            ],
            [
                'shop_index' => 3,
                'name' => 'Brompton Folding Bicycle',
                'category' => 'Bicycles',
                'description' => 'Compact folding bike ideal for urban travel and multi-modal commuting. Easy to carry on public transport.',
                'daily_price' => 600.00,
                'units' => ['BROMPTON-001', 'BROMPTON-002']
            ],

            // Camping Gear
            [
                'shop_index' => 1,
                'name' => 'MSR Hubba Hubba NX Tent (2-Person)',
                'category' => 'Camping',
                'description' => 'Lightweight freestanding tent with excellent ventilation. Perfect for 2 people, weighs only 1.1kg. Includes rainfly and footprint.',
                'daily_price' => 800.00,
                'units' => ['MSR-HUBBA-001', 'MSR-HUBBA-002', 'MSR-HUBBA-003']
            ],
            [
                'shop_index' => 1,
                'name' => 'Coleman Gas Stove & Cookware Set',
                'category' => 'Camping',
                'description' => 'Complete camping cook set with portable gas stove, 2 burners, pots, pans, and utensils. Easy to set up and clean.',
                'daily_price' => 350.00,
                'units' => ['COLEMAN-STOVE-001', 'COLEMAN-STOVE-002']
            ],
            [
                'shop_index' => 1,
                'name' => 'The North Face Sleeping Bag (-10°C)',
                'category' => 'Camping',
                'description' => 'Premium down sleeping bag rated for -10°C. Water-resistant shell, compression sack included. Perfect for cold weather camping.',
                'daily_price' => 400.00,
                'units' => ['TF-SLEEP-001', 'TF-SLEEP-002', 'TF-SLEEP-003', 'TF-SLEEP-004']
            ],
            [
                'shop_index' => 1,
                'name' => 'Yeti Cooler 45 Quart',
                'category' => 'Camping',
                'description' => 'High-performance cooler that keeps ice for 5+ days. Perfect for beach trips, camping, and road trips. Bear-proof certified.',
                'daily_price' => 600.00,
                'units' => ['YETI-45-001', 'YETI-45-002']
            ],

            // Power Tools
            [
                'shop_index' => 2,
                'name' => 'DeWalt DCD778 Cordless Drill Set',
                'category' => 'Power tools',
                'description' => '20V MAX cordless drill/driver with 2 batteries, charger, and carrying case. 1/2" chuck, LED light, and 530 UWO.',
                'daily_price' => 450.00,
                'units' => ['DEWALT-DCD778-001', 'DEWALT-DCD778-002', 'DEWALT-DCD778-003']
            ],
            [
                'shop_index' => 2,
                'name' => 'Makita Circular Saw 5007F',
                'category' => 'Power tools',
                'description' => '7-1/4" corded circular saw with laser guide, electric brake, and magnesium base. Cuts up to 2-3/8" at 90 degrees.',
                'daily_price' => 500.00,
                'units' => ['MAKITA-5007-001', 'MAKITA-5007-002']
            ],
            [
                'shop_index' => 2,
                'name' => 'Bosch Professional Jigsaw 1585AEVS',
                'category' => 'Power tools',
                'description' => '7.4 amp variable speed jigsaw with 4 orbital settings, tool-less blade change, and dust blower for clean cuts.',
                'daily_price' => 380.00,
                'units' => ['BOSCH-JIGSAW-001', 'BOSCH-JIGSAW-002', 'BOSCH-JIGSAW-003']
            ],
            [
                'shop_index' => 2,
                'name' => 'DeWalt DWMT70715 Impact Driver Set',
                'category' => 'Power tools',
                'description' => '20V MAX impact driver with 3-year warranty. 1750 in-lbs torque, 3 LED lights, and 1/4" hex quick-change chuck.',
                'daily_price' => 420.00,
                'units' => ['DEWALT-IMPACT-001', 'DEWALT-IMPACT-002']
            ],
            [
                'shop_index' => 2,
                'name' => 'Milwaukee 2733-20 Cordless Sawzall',
                'category' => 'Power tools',
                'description' => 'M18 cordless reciprocating saw with 1.2" stroke length and variable speed. Perfect for demolition and rough cutting.',
                'daily_price' => 550.00,
                'units' => ['MILWAUKEE-SAWZALL-001', 'MILWAUKEE-SAWZALL-002']
            ],

            // Additional Equipment
            [
                'shop_index' => 1,
                'name' => 'Professional Photography Light Kit',
                'category' => 'Camera',
                'description' => 'Complete lighting kit with 2x 150W LED panels, softboxes, stands, and triggers. Perfect for studio and outdoor shoots.',
                'daily_price' => 1200.00,
                'units' => ['LIGHT-KIT-001', 'LIGHT-KIT-002']
            ],
            [
                'shop_index' => 1,
                'name' => '4-Person Cabin Tent',
                'category' => 'Camping',
                'description' => 'Spacious cabin-style tent for 4 people with 2 doors, 3 rooms, and large vestibule. Easy setup and weather-resistant.',
                'daily_price' => 1000.00,
                'units' => ['CABIN-TENT-001', 'CABIN-TENT-002']
            ],
            [
                'shop_index' => 2,
                'name' => 'Generator 3500W',
                'category' => 'Power tools',
                'description' => 'Portable gasoline generator with electric start, 3500W running watts, quiet operation, and fuel gauge.',
                'daily_price' => 900.00,
                'units' => ['GEN-3500-001', 'GEN-3500-002']
            ],
            [
                'shop_index' => 3,
                'name' => 'Electric Scooter ES4 Pro',
                'category' => 'Bicycles',
                'description' => 'High-performance electric scooter with 40km range, 25km/h top speed, and pneumatic tires. Perfect for city commuting.',
                'daily_price' => 350.00,
                'units' => ['E-SCOOTER-001', 'E-SCOOTER-002', 'E-SCOOTER-003']
            ]
        ];

        foreach ($products as $product) {
            $shop = $shops[$product['shop_index']];

            $item = Item::firstOrCreate(
                [
                    'shop_id' => $shop->id,
                    'name' => $product['name'],
                ],
                [
                    'category' => $product['category'],
                    'description' => $product['description'],
                    'daily_price' => $product['daily_price'],
                ]
            );

            foreach ($product['units'] as $serial) {
                Unit::firstOrCreate(
                    ['serial_no' => $serial],
                    [
                        'item_id' => $item->id,
                        'status' => 'active',
                    ]
                );
            }
        }

        $this->command->info('Added ' . count($products) . ' new products with multiple units each!');
    }
}
