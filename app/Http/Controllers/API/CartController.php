<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
    
    class CartController extends Controller
    {
        // Get Cart Items
        public function index()
        {
            // dd(123);
            $cart = Cart::where('user_id', Auth::id())->with('items.product.productimages')->first();
            $cartItems = $cart ? $cart->items : collect();
            $cartTotal = $cartItems->reduce(function ($total, $item) {
                return $total + ($item->quantity * $item->product->price);
            }, 0);
    
            return response()->json([
                'cartItems' => $cartItems,
                'cartTotal' => number_format($cartTotal, 2)
            ], 200);
        }
    
        // Add to Cart
        public function addToCart(Request $request)
        {
            $request->validate([
                'product_id' => 'required|integer|exists:products,id',
                'serial_number' => 'required|string',
            ]);
    
            $product = Product::findOrFail($request->input('product_id'));
            if ($request->input('quantity', 1) > $product->stock) {
                return response()->json([
                    'message' => 'Requested quantity exceeds available stock. Available: ' . $product->stock
                ], 400);
            }
    
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
    
            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $request->input('product_id'))
                ->where('serial_number', $request->input('serial_number'))
                ->first();
    
            if ($cartItem) {
                $cartItem->quantity += $request->input('quantity', 1);
            } else {
                $cartItem = CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $request->input('product_id'),
                    'quantity' => $request->input('quantity', 1),
                    'serial_number' => $request->input('serial_number')
                ]);
            }
    
            $cartItem->save();
    
            $cartTotal = $cart->items->reduce(function ($total, $item) {
                return $total + ($item->quantity * $item->product->price);
            }, 0);
    
            return response()->json([
                'message' => 'Product added to cart successfully!',
                'cartItemCount' => $cart->items->count(),
                'cartTotal' => number_format($cartTotal, 2)
            ], 201);
        }
    
        // Update Cart Item
        public function updateCartItem(Request $request, $id)
        {
            $cartItem = CartItem::findOrFail($id);
    
            $request->validate([
                'quantity' => 'required|integer|min:1',
            ]);
    
            $product = $cartItem->product;
            if ($request->input('quantity') > $product->stock) {
                return response()->json([
                    'message' => 'Requested quantity exceeds available stock. Available: ' . $product->stock
                ], 400);
            }
    
            $cartItem->quantity = $request->input('quantity');
            $cartItem->save();
    
            $cartTotal = $cartItem->cart->items->reduce(function ($total, $item) {
                return $total + ($item->quantity * $item->product->price);
            }, 0);
    
            return response()->json([
                'message' => 'Cart item updated successfully!',
                'cartItemCount' => $cartItem->cart->items->count(),
                'cartTotal' => number_format($cartTotal, 2)
            ], 200);
        }
    
        // Remove from Cart
        public function removeFromCart($id)
        {
            $cartItem = CartItem::findOrFail($id);
            $cartItem->delete();
    
            return response()->json([
                'message' => 'Item removed from cart successfully.'
            ], 200);
        }
    
        // Clear Cart
        public function clearCart()
        {
            $cart = Cart::where('user_id', Auth::id())->first();
            if ($cart) {
                $cart->items()->delete();
            }
    
            return response()->json([
                'message' => 'Cart cleared successfully!'
            ], 200);
        }
    }
    
    
