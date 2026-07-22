<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class BuyerController extends Controller
{
    public function index()
    {
        $buyers = User::where('role', 'BUYER')->with('ledgerEntries')->orderBy('created_at', 'desc')->get();
        return view('admin.buyers.index', compact('buyers'));
    }
}
