<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'price_per_unit', 'unit', 'stock_status', 
        'min_order_qty', 'image_url',
        'description', 'grade', 'origin', 'is_gst_available',
        'is_delivery_available', 'is_pickup_available',
        'price_trend_direction',
        'price_trend_value'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
