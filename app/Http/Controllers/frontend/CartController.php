<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        // if (!auth()->check()) {
        //     return redirect()->route('login')->with('error', 'Please register or log in to add items to the cart.');
        // }
    
        // Proceed with adding the product to the cart
    
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'serial_number' => 'required|string',
        ]);

    // Retrieve or create cart
    $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
    
    // Add or update cart item
    $cartItem = CartItem::updateOrCreate(
        [
            'cart_id' => $cart->id,
            'product_id' => $request->product_id,
            'serial_number' => $request->serial_number,
        ],
        ['quantity' => \DB::raw('quantity + ' . ($request->quantity ?? 1))]
    );

    // Calculate updated total
    $cartTotal = $cart->items->sum(fn($item) => $item->product ? $item->quantity * $item->product->price : 0);

    return response()->json([
        'message' => 'Product added to cart successfully!',
        'cartItemCount' => $cart->items->count(),
        'cartTotal' => number_format($cartTotal, 2),
    ]);
}

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

public function removeFromCart($id)
{
    CartItem::findOrFail($id)->delete();

    return redirect()->route('cart.index')->with('success', 'Item removed from cart successfully.');
}

public function clearCart()
{
    Cart::where('user_id', Auth::id())->first()?->items()->delete();

    return response()->json(['message' => 'Cart cleared successfully!']);
}
}
