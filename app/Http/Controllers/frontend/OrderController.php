<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\PetProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class OrderController extends Controller
{ 
    public function create(PetProduct $product)
    {
        return view('frontend.orders.create', compact('product'));
    }

    // Handle the form submission
    public function store(Request $request, PetProduct $product)
    {
        // Validate the request data
        $request->validate([
            'address' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',

        ]);

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Create the order
            $order = Order::create([
                'user_id' => Auth::id(),
                'address' => $request->input('address'),
                'status' => 'pending',
            ]);

            // Create the order item
            OrderItem::create([
                'order_id' => $order->id,
                'pet_product_id' => $product->id,
                'quantity' => $request->input('quantity'),
               
            ]);

            // Commit the transaction
            DB::commit();

            // Redirect to the orders index page with a success message
            return redirect()->route('orders.index')->with('success', 'Your order has been placed successfully!');
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();

            // Log the error
            Log::error('Order creation failed: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->back()->with('error', 'Failed to place the order.');
        }
    }

    // Display a list of the user's orders
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('orderItems.petProduct')
            ->get();

        return view('frontend.orders.index', compact('orders'));
    }
 
    public function markAsReceived($orderId)
    {
        // Find the order by its ID
        $order = Order::findOrFail($orderId);

        // Check if the user is authorized to update this order
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Update the status to 'received'
        $order->status = 'received';
        $order->save();

        // Redirect back with a success message
        return redirect()->route('orders.index')->with('success', 'Order marked as received.');
    }

    public function cancelOrder($orderId)
    {
        // Find the order by its ID
        $order = Order::findOrFail($orderId);

        // Check if the user is authorized to cancel this order
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Update the status to 'cancelled'
        $order->status = 'cancelled';
        $order->save();

        // Redirect back with a success message
        return redirect()->route('orders.index')->with('success', 'Order cancelled.');
    } 
    public function checkout(Request $request)
{
    // Validate the address input
    $request->validate([
        'address' => 'required|string|max:255',
    ]);

    // Get the user's cart
    $cart = Cart::where('user_id', auth()->id())->first();

    // Check if the cart is empty
    if (!$cart || $cart->items->isEmpty()) {
        return redirect()->route('mart')->with('error', 'Your cart is empty.');
    }

    // Create the order
    $order = Order::create([
        'user_id' => auth()->id(),
        'address' => $request->input('address'),  // Include the address
        'total_amount' => $cart->items->sum(function($item) {
            return $item->quantity * $item->product->price;
        }),
        'status' => 'pending',  // Set the initial order status
    ]);
    
    // Add cart items to the order
    foreach ($cart->items as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'pet_product_id' => $item->pet_product_id, // Correct field name
            'quantity' => $item->quantity,
        ]);
    }

    // Clear the cart after successful order placement
    $cart->items()->delete();  // Clear all items in the cart

    // Optional: Clear the cart itself if you want to delete the cart row
    // $cart->delete();

    // Redirect to a success page or payment page
    return redirect()->route('order.success')->with('success', 'Your order has been placed successfully!');
}
public function success()
{
    return view('frontend.orders.success');  // Ensure this view exists
}
}
