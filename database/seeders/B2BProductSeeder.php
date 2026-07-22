<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class B2BProductSeeder extends Seeder
{
    public function run()
    {
        // Ensure some categories exist
        $catFruits = Category::firstOrCreate(['name' => 'Fruits'], ['slug' => 'fruits', 'description' => 'Fresh Fruits']);
        $catVeg = Category::firstOrCreate(['name' => 'Vegetables'], ['slug' => 'vegetables', 'description' => 'Fresh Vegetables']);
        $catExotic = Category::firstOrCreate(['name' => 'Exotic Produce'], ['slug' => 'exotic', 'description' => 'Exotic Produce']);

        $products = [
            [
                'name' => 'Nashik Red Onion',
                'category_id' => $catVeg->id,
                'price_per_unit' => 24.50,
                'unit' => 'kg',
                'min_order_qty' => 500,
                'grade' => 'A+',
                'origin' => 'Nashik, Maharashtra',
                'stock_status' => 'IN_STOCK',
                'is_gst_available' => true,
                'price_trend_direction' => 'DOWN',
                'price_trend_value' => 4.5,
                'image_url' => '/images/products/onion.jpg',
                'description' => 'Premium export quality Nashik red onions. Excellent shelf life and pungent taste. Perfect for retail supermarkets.'
            ],
            [
                'name' => 'Kashmiri Apple (Kinnaur)',
                'category_id' => $catFruits->id,
                'price_per_unit' => 120.00,
                'unit' => 'box',
                'min_order_qty' => 20,
                'grade' => 'A+',
                'origin' => 'Kinnaur, Himachal Pradesh',
                'stock_status' => 'IN_STOCK',
                'is_gst_available' => true,
                'price_trend_direction' => 'UP',
                'price_trend_value' => 2.0,
                'image_url' => '/images/products/apple.jpg',
                'description' => 'Crisp, sweet, and juicy Kinnaur apples. Deep red color, meticulously sorted and waxed for extended freshness.'
            ],
            [
                'name' => 'Hybrid Tomato',
                'category_id' => $catVeg->id,
                'price_per_unit' => 32.00,
                'unit' => 'crate',
                'min_order_qty' => 50,
                'grade' => 'A',
                'origin' => 'Kolar, Karnataka',
                'stock_status' => 'IN_STOCK',
                'is_gst_available' => true,
                'price_trend_direction' => 'UP',
                'price_trend_value' => 6.2,
                'image_url' => '/images/products/tomato.jpg',
                'description' => 'Firm and ripe hybrid tomatoes with excellent shelf life. Ideal for curries, sauces, and hotel kitchens.'
            ],
            [
                'name' => 'Agra Potato (Chandramukhi)',
                'category_id' => $catVeg->id,
                'price_per_unit' => 18.50,
                'unit' => 'kg',
                'min_order_qty' => 1000,
                'grade' => 'A',
                'origin' => 'Agra, UP',
                'stock_status' => 'IN_STOCK',
                'is_gst_available' => true,
                'price_trend_direction' => 'FLAT',
                'price_trend_value' => 0,
                'image_url' => '/images/products/potato.jpg',
                'description' => 'Large size cold storage potatoes. Perfect for making chips, fries, and bulk cooking. Hand sorted.'
            ],
            [
                'name' => 'Alphonso Mango',
                'category_id' => $catFruits->id,
                'price_per_unit' => 850.00,
                'unit' => 'dozen',
                'min_order_qty' => 10,
                'grade' => 'A+',
                'origin' => 'Ratnagiri, Maharashtra',
                'stock_status' => 'LIMITED',
                'is_gst_available' => true,
                'price_trend_direction' => 'UP',
                'price_trend_value' => 12.0,
                'image_url' => '/images/products/mango.jpg',
                'description' => 'Authentic GI-tagged Ratnagiri Alphonso. Pre-ripened and ready to display. High demand premium fruit.'
            ],
            [
                'name' => 'Cavendish Banana',
                'category_id' => $catFruits->id,
                'price_per_unit' => 35.00,
                'unit' => 'dozen',
                'min_order_qty' => 100,
                'grade' => 'A',
                'origin' => 'Jalgaon, Maharashtra',
                'stock_status' => 'IN_STOCK',
                'is_gst_available' => false,
                'price_trend_direction' => 'FLAT',
                'price_trend_value' => 0,
                'image_url' => '/images/products/banana.jpg',
                'description' => 'Spotless yellow skin Cavendish bananas. Ethylene ripened in state of the art chambers.'
            ],
            [
                'name' => 'Nagpur Orange',
                'category_id' => $catFruits->id,
                'price_per_unit' => 45.00,
                'unit' => 'kg',
                'min_order_qty' => 200,
                'grade' => 'A',
                'origin' => 'Nagpur, Maharashtra',
                'stock_status' => 'IN_STOCK',
                'is_gst_available' => true,
                'price_trend_direction' => 'DOWN',
                'price_trend_value' => 2.5,
                'image_url' => '/images/products/orange.jpg',
                'description' => 'Sweet and tangy loose jacket oranges. High juice content. Perfect for fresh juice chains.'
            ],
            [
                'name' => 'Green Lemon',
                'category_id' => $catVeg->id,
                'price_per_unit' => 60.00,
                'unit' => 'kg',
                'min_order_qty' => 50,
                'grade' => 'B',
                'origin' => 'Andhra Pradesh',
                'stock_status' => 'IN_STOCK',
                'is_gst_available' => true,
                'price_trend_direction' => 'UP',
                'price_trend_value' => 15.0,
                'image_url' => '/images/products/lemon.jpg',
                'description' => 'Juicy green lemons, medium size. Sourced directly from farms.'
            ],
            [
                'name' => 'Green Chilli (G4)',
                'category_id' => $catVeg->id,
                'price_per_unit' => 45.00,
                'unit' => 'kg',
                'min_order_qty' => 100,
                'grade' => 'A',
                'origin' => 'Guntur, Andhra',
                'stock_status' => 'IN_STOCK',
                'is_gst_available' => false,
                'price_trend_direction' => 'DOWN',
                'price_trend_value' => 5.0,
                'image_url' => '/images/products/chilli.jpg',
                'description' => 'Spicy dark green chillies. Sorted to remove stems and damaged pieces.'
            ],
            [
                'name' => 'Hass Avocado',
                'category_id' => $catExotic->id,
                'price_per_unit' => 350.00,
                'unit' => 'kg',
                'min_order_qty' => 10,
                'grade' => 'A+',
                'origin' => 'New Zealand',
                'stock_status' => 'LIMITED',
                'is_gst_available' => true,
                'price_trend_direction' => 'UP',
                'price_trend_value' => 8.0,
                'image_url' => '/images/products/avocado.jpg',
                'description' => 'Premium imported Hass Avocados. Perfect buttery texture for high-end restaurants.'
            ],
            [
                'name' => 'Fresh Broccoli',
                'category_id' => $catExotic->id,
                'price_per_unit' => 120.00,
                'unit' => 'kg',
                'min_order_qty' => 20,
                'grade' => 'A',
                'origin' => 'Ooty, TN',
                'stock_status' => 'IN_STOCK',
                'is_gst_available' => true,
                'price_trend_direction' => 'FLAT',
                'price_trend_value' => 0,
                'image_url' => '/images/products/broccoli.jpg',
                'description' => 'Tight, dark green broccoli heads. Grown organically in cool climates.'
            ],
            [
                'name' => 'Dragon Fruit (Pink)',
                'category_id' => $catExotic->id,
                'price_per_unit' => 180.00,
                'unit' => 'kg',
                'min_order_qty' => 30,
                'grade' => 'A',
                'origin' => 'Gujarat',
                'stock_status' => 'IN_STOCK',
                'is_gst_available' => true,
                'price_trend_direction' => 'DOWN',
                'price_trend_value' => 10.0,
                'image_url' => '/images/products/dragonfruit.jpg',
                'description' => 'Large, vibrant pink dragon fruits with red flesh. High visual appeal for retail shelves.'
            ]
        ];

        foreach ($products as $prod) {
            Product::create($prod);
        }
    }
}
