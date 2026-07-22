<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BulkDealController extends Controller
{
    public function index()
    {
        $deals = \App\Models\BulkDeal::with('product')->where('valid_until', '>', now())->get();
        return view('pages.bulk-deals', compact('deals'));
    }
}
