<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class PriceUpdateController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('category')->orderBy('name')->get();
        return view('admin.prices.index', compact('products'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'prices' => 'required|array',
            'prices.*' => 'required|numeric|min:0',
            'stock' => 'required|array',
            'stock.*' => 'required|in:IN_STOCK,LIMITED,SOLD_OUT',
        ]);

        foreach ($data['prices'] as $id => $price) {
            Product::where('id', $id)->update([
                'price_per_unit' => $price,
                'stock_status' => $data['stock'][$id] ?? 'IN_STOCK',
            ]);
        }

        return redirect()->back()->with('success', 'Prices and stock updated successfully!');
    }
}
