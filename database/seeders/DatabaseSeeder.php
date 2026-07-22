<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\BulkDeal;
use App\Models\LedgerEntry;
use App\Models\Notification;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Users
        $admin = User::firstOrCreate(
            ['email' => 'admin@mandiprime.com'],
            ['name' => 'System Admin', 'password' => Hash::make('password'), 'role' => 'ADMIN']
        );
        $buyer1 = User::firstOrCreate(
            ['email' => 'buyer1@retail.com'],
            ['name' => 'ABC Retailers', 'password' => Hash::make('password'), 'role' => 'BUYER']
        );
        $buyer2 = User::firstOrCreate(
            ['email' => 'buyer2@hotel.com'],
            ['name' => 'Taj Hotels Sourcing', 'password' => Hash::make('password'), 'role' => 'BUYER']
        );

        // 2. Seed Categories
        $catRoot = Category::create([
            'name' => 'Root Vegetables',
            'slug' => 'root-vegetables',
            'description' => 'Potatoes, Onions, Carrots, Garlic, and Ginger.',
        ]);
        $catFruit = Category::create([
            'name' => 'Fresh Fruits',
            'slug' => 'fresh-fruits',
            'description' => 'Apples, Bananas, Citrus, and Melons.',
        ]);
        $catExotic = Category::create([
            'name' => 'Exotic Produce',
            'slug' => 'exotic-produce',
            'description' => 'Avocados, Dragon Fruit, Kiwi, and Broccoli.',
        ]);

        // 3. Seed Products
        $onion = Product::create([
            'category_id' => $catRoot->id,
            'name' => 'Nashik Red Onion',
            'description' => 'Premium quality red onions sourced directly from Nashik. Excellent keeping quality.',
            'price_per_unit' => 24.50,
            'unit' => 'Kg',
            'stock_status' => 'IN_STOCK',
            'min_order_qty' => 500,
            'image_url' => '/images/onions.png',
            'grade' => 'A',
            'origin' => 'Nashik, MH',
            'is_gst_available' => false,
            'is_delivery_available' => true,
            'is_pickup_available' => true,
            'price_trend_direction' => 'DOWN',
            'price_trend_value' => 4.2
        ]);

        $tomato = Product::create([
            'category_id' => $catRoot->id,
            'name' => 'Hybrid Tomato',
            'description' => 'Firm, red tomatoes ideal for long-distance transport and restaurant use.',
            'price_per_unit' => 32.00,
            'unit' => 'Crate (20Kg)',
            'stock_status' => 'LIMITED',
            'min_order_qty' => 50,
            'image_url' => '/images/tomatoes.png',
            'grade' => 'Premium',
            'origin' => 'Pune, MH',
            'is_gst_available' => true,
            'is_delivery_available' => true,
            'is_pickup_available' => false,
            'price_trend_direction' => 'UP',
            'price_trend_value' => 2.5
        ]);

        $apple = Product::create([
            'category_id' => $catFruit->id,
            'name' => 'Kashmiri Apple (Kinnaur)',
            'description' => 'Crisp, sweet red apples packed in protective cardboard boxes.',
            'price_per_unit' => 120.00,
            'unit' => 'Box (10Kg)',
            'stock_status' => 'IN_STOCK',
            'min_order_qty' => 20,
            'image_url' => '/images/apples.png',
            'grade' => 'Export',
            'origin' => 'Kashmir',
            'is_gst_available' => true,
            'is_delivery_available' => true,
            'is_pickup_available' => true,
            'price_trend_direction' => 'STABLE',
            'price_trend_value' => 0.0
        ]);

        // 4. Seed Bulk Deals
        BulkDeal::create([
            'product_id' => $onion->id,
            'title' => 'Onion (Nashik Red) - 50 Ton Truckload',
            'description' => 'Excess supply arrived this morning. Immediate dispatch required to clear yard space.',
            'moq' => 50000,
            'old_price' => 24.50,
            'new_price' => 18.50,
            'valid_until' => now()->addHours(6)
        ]);

        // 5. Seed Ledger Entries for Buyer 1
        LedgerEntry::create([
            'user_id' => $buyer1->id,
            'reference_id' => 'PO-10492',
            'description' => 'Purchase: 10 Tons Onion (Nashik)',
            'amount' => 185000.00,
            'type' => 'DEBIT',
            'status' => 'DUE'
        ]);
        LedgerEntry::create([
            'user_id' => $buyer1->id,
            'reference_id' => 'TRX-99381',
            'description' => 'Bank Transfer (NEFT)',
            'amount' => 142500.00,
            'type' => 'CREDIT',
            'status' => 'SETTLED'
        ]);

        // 6. Seed Notifications for Buyer 1
        Notification::create([
            'user_id' => $buyer1->id,
            'type' => 'info',
            'title' => 'Order PO-10492 Dispatched',
            'message' => 'Your order of 10 Tons Onion (Nashik) has been loaded onto truck MH-12-AB-3456.',
            'is_read' => false
        ]);
        Notification::create([
            'user_id' => $buyer1->id,
            'type' => 'alert',
            'title' => 'Price Drop Alert: Tomatoes',
            'message' => 'Heavy arrivals at the mandi have caused a 5% drop in Tomato prices.',
            'is_read' => true
        ]);
    }
}
