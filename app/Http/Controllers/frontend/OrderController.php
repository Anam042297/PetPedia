<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

use App\Mail\sendmail;
use Illuminate\Support\Facades\Mail;
class OrderController extends Controller
{ 
   // Display a list of the user's orders
   public function index(Request $request)
{
    if ($request->ajax()) {
        $orders = Order::where('user_id', Auth::id())
            ->with('orderItems.Product')
            ->get();

        return DataTables::of($orders)
            ->addColumn('tracking_id', function ($row) {
                return $row->tracking_id;
            })
        
            
            ->addColumn('total_amount', function ($row) {
                return number_format($row->total_amount, 2); // Format the total amount
            })
            ->addColumn('status', function ($row) {
                return ucfirst($row->status); // Capitalize first letter
            })
          
            ->addColumn('name', function ($row) {
                return $row->name;
            })
            ->addColumn('city', function ($row) {
                return $row->city;
            })
            ->addColumn('phone_no', function ($row) {
                return $row->phone_no;
            })
            ->removeColumn('id')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }

    return view('frontend.orders.view');
}


   public function checkoutForm()
   {
    $totalAmount = $this->calculateTotalAmount(); // Get total amount from cart
    return view('frontend.orders.checkout', compact('totalAmount')); 
    // Path to your checkout form view
   }
  


   /**
    * Handle the order checkout process.
    */
   public function checkout(Request $request)
   {
       // Validate request
       $request->validate([
           'name' => 'required|string|max:255',
           'city' => 'required|string|max:255',
           'address' => 'required|string|max:255',
           'phone_no' => 'required|string|max:15',
           'payment_method' => 'required|in:cash',
       ]);

       // Create Order
       $order = Order::create([
           'tracking_id'=> Str::random(10),
           'user_id' => auth()->id(),
           'name' => $request->name,
           'city' => $request->city,
           'address' => $request->address,
           'phone_no' => $request->phone_no,
           'payment_method' => $request->payment_method,
           'total_amount' => $this->calculateTotalAmount(), // Calculate total from cart items
           'status' => 'pending',
       ]);
       $cart = Cart::where('user_id', Auth::id())->first();
       if (!$cart || $cart->items->isEmpty()) {
           return redirect()->route('cart')->with('error', 'Your cart is empty!');
       }
       // Add Order Items from Cart
       $cart = Cart::where('user_id', Auth::id())->first();
       if ($cart) {
           foreach ($cart->items as $cartItem) {
               OrderItem::create([
                   'order_id' => $order->id,
                   'product_id' => $cartItem->product_id,
                   'price' => $cartItem->product->price, // Ensure `product` relationship exists
                   'quantity' => $cartItem->quantity,
               ]);
           }
           $product = Product::find($cartItem->product_id);
           if ($product) {
               $product->stock -= $cartItem->quantity; // Subtract the quantity from stock
               $product->save(); // Save the changes to the database
           }
           // Clear the cart
           $cart->items()->delete();
       }
       Mail::to($request->user()->email)->send(new sendmail($order));

       // Redirect to a confirmation page
       return redirect()->route('order.success', ['order' => $order->id]);
   }

   protected function calculateTotalAmount()
   {
       $cart = Cart::where('user_id', Auth::id())->first();
       $total = 0;

       if ($cart) {
           foreach ($cart->items as $cartitem) {
               $total += $cartitem->quantity * $cartitem->product->price; // Ensure `product` relationship exists
           }
       }

       return $total;
   }

   public function success()
   {
       return view('frontend.orders.success');  // Ensure this view exists
   }
}
