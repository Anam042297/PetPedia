<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    
    public function index()
    {
        // Optionally, you can fetch the cart and pass it to the view
        $cart = Cart::with('cartItems.product')->where('user_id', Auth::id())->first();
        return view('frontend.checkout.index', compact('cart'));
    }
}
