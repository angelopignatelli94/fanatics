<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout.index');
    }

    public function process(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'postal_code' => 'required|string|max:20',
                'country' => 'required|string|max:255',
            ]);
        } else {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'password' => 'required|string|min:3',
                'address' => 'required|string|max:255',
                'city' => 'required|string|max:255',
                'postal_code' => 'required|string|max:20',
                'country' => 'required|string|max:255',
            ]);
        }

        if (!Session::has('cart') || count(Session::get('cart')) == 0) {
            return redirect()->route('checkout.index')->with('error', 'Your cart is empty. Please add products to proceed.');
        }

        if (Auth::check()) {
            $user = Auth::user();
        } else {
            $user = User::where('email', $request->email)->first();

            if ($user) {
                $user->password = Hash::make($request->password);
                $user->save();
            } else {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
            }
        }

        $totalAmount = 0;
        $items = [];
        foreach (Session::get('cart') as $id => $item) {
            $totalAmount += $item['price'] * $item['quantity'];
            $items[] = [
                'product_id' => $id,
                'name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total' => $item['price'] * $item['quantity'],
            ];
        }

        $order = Order::create([
            'user_id' => $user->id,
            'total' => $totalAmount,
            'items' => json_encode($items),
        ]);

        Session::forget('cart');

        return redirect()->route('checkout.index')->with('success', 'Thank you for your purchase! Your order has been placed successfully. Please log in to view your orders.');
    }
}
