<?php
namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\PetProduct;
use Illuminate\Support\Facades\Log; 
class CartController extends Controller
{
    // Display cart items
    public function index()
{
    $cart = Cart::where('user_id', Auth::id())->first();
    $cartItems = $cart ? $cart->items : collect(); // Use collect() to ensure it's a collection


    // Calculate the total amount
    $cartTotal = 0;
    foreach ($cartItems as $cartItem) {
        $cartTotal += $cartItem->quantity * $cartItem->product->price;
    }

    // Pass the cart items and total to the view
    return view('frontend.cart.index', compact('cartItems', 'cartTotal'));
}

 
    public function addToCart(Request $request)
{
    $request->validate([
        'serial_number' => 'required|string', // Ensure serial_number is validated
    ]);

    $cart = Cart::firstOrCreate([
        'user_id' => Auth::id(),
    ]);

    $cartItem = CartItem::create([
        'cart_id' => $cart->id,
        'pet_product_id' => $request->input('product_id'),
        'quantity' => $request->input('quantity', 1),
        'serial_number' => $request->input('serial_number')
    ]);

    return response()->json([
        'message' => 'Product added to cart successfully!',
        'cartItemCount' => $cart->items->count()
    ]);
}

    // Update cart item quantity
    public function updateCartItem(Request $request)
    {
        $cartItem = CartItem::find($request->input('id'));
    
        if ($cartItem) {
            $cartItem->update(['quantity' => $request->input('quantity')]);
            return response()->json(['message' => 'Cart item updated successfully!']);
        }
    
        return response()->json(['message' => 'Cart item not found!'], 404);
    }
    public function removeFromCart(Request $request)
{dd($request);
    $cartItem = CartItem::find($request->input('id'));

    if ($cartItem) {
        $cartItem->delete();
        return response()->json(['message' => 'Item removed from cart successfully!']);
    }

    return response()->json(['message' => 'Item not found!'], 404);
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