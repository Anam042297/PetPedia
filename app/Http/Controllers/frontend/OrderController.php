<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
        ]);
        
        $cart = Cart::with('cartItems')->where('user_id', Auth::id())->firstOrFail();

        $order = Order::create([
            'user_id' => Auth::id(),
            'address' => $request->input('address'),
            'status' => 'pending',
        ]);

        foreach ($cart->cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'pet_product_id' => $item->pet_product_id,
                'quantity' => $item->quantity,
                'serial_number' => $item->serial_number,
            ]);
        }

        // Clear the cart
        $cart->cartItems()->delete();

        return redirect()->route('orders.index')->with('success', 'Order placed successfully.');
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->with('orderItems.product')->get();
        return view('orders.index', compact('orders'));
    }
}
