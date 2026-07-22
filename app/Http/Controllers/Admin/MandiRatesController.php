<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class MandiRatesController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('category_id')->get();
        return view('admin.rates.index', compact('products'));
    }

    public function update(Request $request)
    {
        $prices = $request->input('prices');
        $trends = $request->input('trends');
        
        if ($prices && is_array($prices)) {
            foreach ($prices as $id => $price) {
                $product = Product::find($id);
                if ($product) {
                    $product->price_per_unit = $price;
                    if (isset($trends[$id])) {
                        $product->price_trend_direction = $trends[$id];
                    }
                    $product->save();
                }
            }
        }
        
        return redirect()->route('admin.rates')->with('success', 'Mandi rates updated successfully.');
    }
}
