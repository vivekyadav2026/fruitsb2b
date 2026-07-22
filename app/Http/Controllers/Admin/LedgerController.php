<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LedgerEntry;

class LedgerController extends Controller
{
    public function index()
    {
        $entries = LedgerEntry::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.ledger.index', compact('entries'));
    }
}
