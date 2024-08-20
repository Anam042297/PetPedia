<?php
namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\PetProduct;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::with('cartItems.product')->where('user_id', Auth::id())->first();
        return view('frontend.cart.index', compact('cart'));
    }

    public function addToCart(Request $request, $productId)
    { // dd('addToCart');
        $product = PetProduct::findOrFail($productId);
       // dd($product);
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
       // dd($cart);
        $cartItem = $cart->cartItems()->updateOrCreate(
            ['pet_product_id' => $product->id, 'serial_number' => $product->serial_number],
            ['quantity' => $request->input('quantity', 1)]
        );

        return redirect()->route('cart.index')->with('success', 'Product added to cart.');
    }

    public function updateCartItem(Request $request, $cartItemId)
    {
        $cartItem = CartItem::findOrFail($cartItemId);
        $cartItem->update(['quantity' => $request->input('quantity')]);

        return redirect()->route('cart.index')->with('success', 'Cart item updated.');
    }

    public function removeFromCart($cartItemId)
    {
        $cartItem = CartItem::findOrFail($cartItemId);
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }

    public function clearCart()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        $cart->cartItems()->delete();

        return redirect()->route('cart.index')->with('success', 'Cart cleared.');
    }
}
