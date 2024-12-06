<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())
                    ->with('items.product.productimages')
                    ->first();
    
        $cartItems = optional($cart)->items ?? collect();
        $cartTotal = $cartItems->sum(fn($item) => $item->quantity * $item->product->price);
    
        return response()->json([
            'cartItems' => $cartItems,
            'cartTotal' => number_format($cartTotal, 2)
        ], 200);
    }
    
    public function addToCart(Request $request)
{
    // Validate the request to ensure `product_id` is provided and exists in the products table.
    $request->validate([
        'product_id' => 'required|integer|exists:products,id',
        'quantity' => 'integer|min:1'
    ]);

    $product = Product::findOrFail($request->input('product_id'));

    // Check stock availability.
    $quantity = $request->input('quantity', 1);
    if ($quantity > $product->stock) {
        return response()->json(['message' => "Insufficient stock. Available: $product->stock"], 400);
    }

    // Retrieve or create a cart for the authenticated user.
    $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

    // Check if the product is in the cart and update the quantity.
    $cartItem = $cart->items()->where('product_id', $product->id)->first();
    if ($cartItem) {
        $cartItem->increment('quantity', $quantity);
    } else {
        // Add new product to the cart.
        $cart->items()->create([
            'product_id' => $product->id,
            'quantity' => $quantity
        ]);
    }

    // Calculate the total cart value.
    $cartTotal = $cart->items->sum(fn($item) => $item->quantity * $item->product->price);

    return response()->json([
        'message' => 'Product added to cart successfully!',
        'cartItemCount' => $cart->items->count(),
        'cartTotal' => number_format($cartTotal, 2)
    ], 201);
}


public function updateCartItem(Request $request, $id)
{
    $cartItem = CartItem::findOrFail($id);

    
    $request->validate(['quantity' => 'required|integer|min:1']);
    $quantity = $request->input('quantity');

    if ($quantity > $cartItem->product->stock) {
        return response()->json(['message' => 'Insufficient stock available.'], 400);
    }


    $cartItem->update(['quantity' => $quantity]);
    $cartTotal = $cartItem->cart->items->sum(fn($item) => $item->quantity * $item->product->price);

    return response()->json([
        'message' => 'Cart item updated!',
        'cartItemCount' => $cartItem->cart->items->count(),
        'cartTotal' => number_format($cartTotal, 2)
    ]);
}

    
    public function removeFromCart($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();

        return response()->json([
            'message' => 'Item removed from cart successfully.'
        ], 200);
    }
    public function decreaseQuantity($id)
    {
        $cartItem = CartItem::findOrFail($id);
    
        if ($cartItem->quantity > 1) {
            $cartItem->decrement('quantity');
        }
    
        $cartTotal = $cartItem->cart->items->sum(fn($item) => $item->quantity * $item->product->price);
    
        return response()->json([
            'message' => 'Cart item quantity updated successfully.',
            'cartItemCount' => $cartItem->cart->items->count(),
            'cartTotal' => number_format($cartTotal, 2),
        ]);
    }
    
    
    
}
