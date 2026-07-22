<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('name')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price_per_unit' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
            'min_order_qty' => 'required|numeric|min:1',
            'stock_status' => 'required|in:IN_STOCK,LIMITED,SOLD_OUT',
            'grade' => 'required|string|max:50',
            'origin' => 'required|string|max:100',
            'is_gst_available' => 'boolean',
            'is_delivery_available' => 'boolean',
            'is_pickup_available' => 'boolean',
        ]);

        $data['is_gst_available'] = $request->has('is_gst_available');
        $data['is_delivery_available'] = $request->has('is_delivery_available');
        $data['is_pickup_available'] = $request->has('is_pickup_available');
        
        $data['price_trend_direction'] = 'STABLE';
        $data['price_trend_value'] = 0.0;
        
        // Use a default image if none provided (simplified upload handling for now)
        $data['image_url'] = '/images/tomatoes.png';

        Product::create($data);
        return redirect()->route('admin.products')->with('success', 'Commodity created successfully!');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'price_per_unit' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
            'min_order_qty' => 'required|numeric|min:1',
            'stock_status' => 'required|in:IN_STOCK,LIMITED,SOLD_OUT',
            'grade' => 'required|string|max:50',
            'origin' => 'required|string|max:100',
        ]);

        $data['is_gst_available'] = $request->has('is_gst_available');
        $data['is_delivery_available'] = $request->has('is_delivery_available');
        $data['is_pickup_available'] = $request->has('is_pickup_available');

        $product->update($data);
        return redirect()->route('admin.products')->with('success', 'Commodity updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Commodity deleted successfully!');
    }
}
