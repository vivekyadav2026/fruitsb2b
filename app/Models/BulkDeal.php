<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BulkDeal extends Model
{
    use HasFactory;
    
    protected $fillable = ['product_id', 'title', 'description', 'moq', 'old_price', 'new_price', 'valid_until'];
    
    protected $casts = [
        'valid_until' => 'datetime',
    ];
    
    public function product() {
        return $this->belongsTo(Product::class);
    }
}
