<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page with discounted products.
     */
    public function index()
    {
        $discountedProducts = Product::where('in_promo', true)
            ->whereNotNull('promo_price')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('home', ['discountedProducts' => $discountedProducts]);
    }
}
