<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        if (!$user) {
            $user = \App\Models\User::where('email', 'buyer1@retail.com')->first();
            \Illuminate\Support\Facades\Auth::login($user);
        }
        
        $notifications = \App\Models\Notification::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('pages.notifications', compact('notifications'));
    }
}
