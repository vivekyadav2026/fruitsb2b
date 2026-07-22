<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = \App\Models\Category::withCount('products')->get();
        return view('pages.categories', compact('categories'));
    }
}
