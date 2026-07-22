<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalOrders = \App\Models\Order::count();
        $pendingOrders = \App\Models\Order::where('status', 'PLACED')->count();
        $totalProducts = \App\Models\Product::count();
        
        return view('admin.dashboard', compact('totalOrders', 'pendingOrders', 'totalProducts'));
    }
}
