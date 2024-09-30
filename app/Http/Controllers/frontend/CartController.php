<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index()
    {
        // Fetch the cart for the authenticated user
        $cart = Cart::where('user_id', Auth::id())->with('items.product.productimages')->first();
        
        // If no cart exists, return an empty collection for cart items
        $cartItems = $cart ? $cart->items : collect(); // Ensures it's a collection if no cart is found
    
        // Calculate the total amount of the cart
        $cartTotal = $cartItems->reduce(function ($total, $item) {
            if ($item->product) {
                return $total + ($item->quantity * $item->product->price);
            }
            return $total;
        }, 0);
    
        // Pass the cart items and total to the view
        return view('frontend.cart.index', compact('cartItems', 'cartTotal'));
    }
    
    // Add product to cart
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'serial_number' => 'required|string',
        ]);

        // Retrieve or create the user's cart
        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        // Check if the product is already in the cart with the same serial number
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $request->input('product_id'))
            ->where('serial_number', $request->input('serial_number'))
            ->first();

        if ($cartItem) {
            // Update the quantity if the item already exists
            $cartItem->quantity += $request->input('quantity', 1);
        } else {
            // Create a new cart item if it doesn't exist
            $cartItem = CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $request->input('product_id'),
                'quantity' => $request->input('quantity', 1),
                'serial_number' => $request->input('serial_number')
            ]);
        }

        $cartItem->save();

        // Calculate updated total price
        $cartTotal = $cart->items->reduce(function ($total, $item) {
            if ($item->product) {
                return $total + ($item->quantity * $item->product->price);
            }
            return $total;
        }, 0);

        return response()->json([
            'message' => 'Product added to cart successfully!',
            'cartItemCount' => $cart->items->count(),
            'cartTotal' => number_format($cartTotal, 2)
        ]);
    }

    // Update the quantity of the cart item

    public function updateCartItem(Request $request, $id)
    {
        $cartItem = CartItem::findOrFail($id);

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        $product = $cartItem->product;
        // Check if the requested quantity exceeds the available stock
    if ($request->input('quantity') > $product->stock) {
        return redirect()->route('cart.index')->with('error', 'Requested quantity exceeds available stock. Available: ' . $product->stock);
    }

        $cartItem->quantity = $request->input('quantity');
        $cartItem->save();

        return redirect()->route('cart.index')->with('success', 'Cart item updated successfully.');
}


    // Remove an item from the cart
    public function removeFromCart($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed from cart successfully.');
    }

    // Clear all items from the cart
    public function clearCart()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        if ($cart) {
            $cart->items()->delete();
        }

        return response()->json([
            'message' => 'Cart cleared successfully!'
        ]);
    }
}
