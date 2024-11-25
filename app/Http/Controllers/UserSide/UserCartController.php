<?php

namespace App\Http\Controllers\UserSide;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB; 
class UserCartController extends Controller
{
     // Retrieve all items in the user's cart
     public function index()
     {
         $cart = Cart::with('items.product.productimages')->firstOrNew(['user_id' => Auth::id()]);
         $cartItems = $cart->items ?? collect();
 
         // Calculate total
         $cartTotal = $cartItems->sum(fn($item) => $item->product ? $item->quantity * $item->product->price : 0);
 
         return view('userside.cart.index', compact('cartItems', 'cartTotal'));
     }
     public function store(Request $request)
     {
         $request->validate([
             'product_id' => 'required|exists:products,id',
             'serial_number' => 'required|string',
             'quantity' => 'required|integer|min:1',
         ]);
 
         $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
   
         CartItem::updateOrCreate(
             [
                 'cart_id' => $cart->id,
                 'product_id' => $request->product_id,
                 'serial_number' => $request->serial_number,
             ],
             ['quantity' => DB::raw('quantity + ' . $request->quantity)]
         );
        
     $cartItemCount = $cart->items->sum('quantity');
 
     return response()->json([
         'cartItemCount' => $cartItemCount,
         'message' => 'Product added to cart successfully!',
     ]);
 
     }
 
     public function increaseQuantity(Request $request, $id)
     {
         $cartItem = CartItem::findOrFail($id);
 
         if ($cartItem->quantity < $cartItem->product->stock) {
             $cartItem->increment('quantity');
             return redirect()->route('cart.index')->with('success', 'Quantity increased');
         } else {
             return redirect()->route('cart.index')->with('error', 'Not enough stock available');
         }
     }
 
     public function decreaseQuantity(Request $request, $id)
     {
         $cartItem = CartItem::findOrFail($id);
 
         if ($cartItem->quantity > 1) {
             $cartItem->decrement('quantity');
             return redirect()->route('cart.index')->with('success', 'Quantity decreased');
         } else {
             return redirect()->route('cart.index')->with('error', 'Minimum quantity reached');
         }
     }
 
     public function removeFromCart($id)
     {
         CartItem::findOrFail($id)->delete();
 
         return redirect()->route('cart.index')->with('success', 'Item removed from cart');
     }
 
    //  public function clearCart()
    //  {
    //      $cart = Cart::where('user_id', Auth::id())->first();
    //      if ($cart) {
    //          $cart->items()->delete();
    //      }
 
    //      return redirect()->route('cart.index')->with('success', 'Cart cleared successfully');
    //  }
}
