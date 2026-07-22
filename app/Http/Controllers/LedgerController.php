<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LedgerController extends Controller
{
    public function index()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        if (!$user) {
            // Default to buyer1 for demonstration if not logged in
            $user = \App\Models\User::where('email', 'buyer1@retail.com')->first();
            \Illuminate\Support\Facades\Auth::login($user);
        }
        
        $entries = \App\Models\LedgerEntry::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        $balance = $entries->where('type', 'DEBIT')->sum('amount') - $entries->where('type', 'CREDIT')->sum('amount');
        $creditLimit = 200000;
        
        return view('pages.ledger', compact('entries', 'balance', 'creditLimit'));
    }
}
