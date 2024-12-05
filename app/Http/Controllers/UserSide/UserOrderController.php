<?php

namespace App\Http\Controllers\UserSide;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Mail\sendmail;
use Illuminate\Support\Facades\Mail;
class UserOrderController extends Controller
{
    public function checkoutForm()
    {
     $totalAmount = $this->calculateTotalAmount(); 
     return view('userside.orders.checkout', compact('totalAmount')); 
 
    }
 
    public function checkout(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_no' => [
                'required',
                'string',
                'max:15',
                'regex:/^(03[0-9]{2})[0-9]{7}$/', 
            ],
            'payment_method' => 'required|in:cash',
        ], [
            'phone_no.regex' => 'The phone number must be a valid Pakistani number starting with 03 and followed by 9 digits.',
        ]);
        
 
        $order = Order::create([
            'tracking_id'=> Str::random(10),
            'user_id' => auth()->id(),
            'name' => $request->name,
            'city' => $request->city,
            'address' => $request->address,
            'phone_no' => $request->phone_no,
            'payment_method' => $request->payment_method,
            'total_amount' => $this->calculateTotalAmount(), 
            'status' => 'pending',
        ]);
        $cart = Cart::where('user_id', Auth::id())->first();
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty!');
        }
     
        $cart = Cart::where('user_id', Auth::id())->first();

if ($cart) {
    foreach ($cart->items as $cartItem) {
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $cartItem->product_id,
            'price' => $cartItem->product->price,
            'quantity' => $cartItem->quantity,
        ]);
        
        $product = Product::find($cartItem->product_id);
        if ($product) {
            $product->stock -= $cartItem->quantity; 
            $product->save(); 
        }
    }

    // Clear the cart items
    $cart->items()->delete();
}

        Mail::to($request->user()->email)->send(new sendmail($order));
 
        return redirect()->route('order.success', ['order' => $order->id]);
    }
 
    protected function calculateTotalAmount()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        $total = 0;
 
        if ($cart) {
            foreach ($cart->items as $cartitem) {
                $total += $cartitem->quantity * $cartitem->product->price;
            }
        }
 
        return $total;
    }
 
    public function success()
    {
        return view('userside.orders.success'); 
    }
}
