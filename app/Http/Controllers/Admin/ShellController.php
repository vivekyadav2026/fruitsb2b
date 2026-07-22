<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShellController extends Controller
{
    public function view($page)
    {
        return view('admin.shell', compact('page'));
    }
}
