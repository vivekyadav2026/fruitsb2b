<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->where('stock_status', '!=', 'SOLD_OUT')->orderBy('category_id')->get();
        return view('home', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        
        // Fetch related products from the same category (excluding the current one)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(4)
            ->get();
            
        return view('products.show', compact('product', 'relatedProducts'));
    }
}
