<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $productCount = \App\Models\Product::count();
        return view('admin.dashboard', compact('productCount'));
    }
    
    public function products()
    {
        $products = \App\Models\Product::with('category')->get();
        return view('admin.products', compact('products'));
    }
}
