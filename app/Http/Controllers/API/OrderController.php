<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\sendmail;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
   

    public function checkoutForm()
    {
        $totalAmount = $this->calculateTotalAmount();
        return response()->json(['total_amount' => $totalAmount]);
    }

  
    public function checkout(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_no' => 'required|string|max:15',
            'payment_method' => 'required|in:cash',
        ]);

        $cart = Cart::where('user_id', Auth::id())->first();
        if (!$cart || $cart->items->isEmpty()) {
            return response()->json(['error' => 'Your cart is empty!'], 400);
        }

       
        DB::transaction(function () use ($request, $cart) {

            $order = Order::create([
                'tracking_id' => Str::random(10),
                'user_id' => auth()->id(),
                'name' => $request->name,
                'city' => $request->city,
                'address' => $request->address,
                'phone_no' => $request->phone_no,
                'payment_method' => $request->payment_method,
                'total_amount' => $this->calculateTotalAmount(),
                'status' => 'pending',
            ]);

            foreach ($cart->items as $cartItem) {
                $product = Product::find($cartItem->product_id);
                if ($product && $product->stock >= $cartItem->quantity) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $cartItem->product_id,
                        'price' => $cartItem->product->price,
                        'quantity' => $cartItem->quantity,
                    ]);

                    $product->stock -= $cartItem->quantity;
                    $product->save();
                }
            }
            $cart->items()->delete();

     
            Mail::to($request->user()->email)->send(new sendmail($order));
        });

        return response()->json(['message' => 'Order created successfully!'], 201);
    }

    protected function calculateTotalAmount()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        $total = 0;

        if ($cart) {
            foreach ($cart->items as $cartItem) {
                $total += $cartItem->quantity * $cartItem->product->price;
            }
        }

        return $total;
    }

    public function success($orderId)
    {
        $order = Order::find($orderId);
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }
        return response()->json(['message' => 'Order successful', 'order' => $order]);
    }
}
