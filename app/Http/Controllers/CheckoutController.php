<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if(count($cart) === 0){
            return redirect()->route('home')->with('error', 'Your cart is empty.');
        }
        return view('checkout.index', compact('cart'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        if(count($cart) === 0){
            return redirect()->route('home');
        }

        $request->validate([
            'delivery_or_pickup' => 'required|in:DELIVERY,PICKUP',
            'preferred_date' => 'required|date|after_or_equal:today',
        ]);

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'delivery_or_pickup' => $request->delivery_or_pickup,
                'preferred_date' => $request->preferred_date,
                'status' => 'PLACED',
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price_at_order_time' => $item['price'],
                ]);
            }

            DB::commit();
            session()->forget('cart');

            return redirect()->route('orders.show', $order->id)->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
