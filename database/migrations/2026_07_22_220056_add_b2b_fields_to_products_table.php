<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->text('description')->nullable()->after('name');
            $table->string('grade')->nullable()->after('description');
            $table->string('origin')->nullable()->after('grade');
            $table->boolean('is_gst_available')->default(true)->after('stock_status');
            $table->boolean('is_delivery_available')->default(true)->after('is_gst_available');
            $table->boolean('is_pickup_available')->default(true)->after('is_delivery_available');
            $table->string('price_trend_direction')->default('STABLE')->after('is_pickup_available'); // UP, DOWN, STABLE
            $table->decimal('price_trend_value', 8, 2)->default(0)->after('price_trend_direction');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'description',
                'grade', 
                'origin', 
                'is_gst_available', 
                'is_delivery_available', 
                'is_pickup_available', 
                'price_trend_direction', 
                'price_trend_value'
            ]);
        });
    }
};
