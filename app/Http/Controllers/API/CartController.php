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
//     public function index()
//     {
//         $cart = Cart::where('user_id', Auth::id())
//                     ->with('items.product.productimages')
//                     ->first();
    
//         $cartItems = optional($cart)->items ?? collect();
//         $cartTotal = $cartItems->sum(fn($item) => $item->quantity * $item->product->price);
    
//         return response()->json([
//             'cartItems' => $cartItems,
//             'cartTotal' => number_format($cartTotal, 2)
//         ], 200);
//     }
    
//     public function addToCart(Request $request)
// {
//     // Validate the request to ensure `product_id` is provided and exists in the products table.
//     $request->validate([
//         'product_id' => 'required|integer|exists:products,id',
//         'quantity' => 'integer|min:1'
//     ]);

//     $product = Product::findOrFail($request->input('product_id'));

//     // Check stock availability.
//     $quantity = $request->input('quantity', 1);
//     if ($quantity > $product->stock) {
//         return response()->json(['message' => "Insufficient stock. Available: $product->stock"], 400);
//     }

//     // Retrieve or create a cart for the authenticated user.
//     $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

//     // Check if the product is in the cart and update the quantity.
//     $cartItem = $cart->items()->where('product_id', $product->id)->first();
//     if ($cartItem) {
//         $cartItem->increment('quantity', $quantity);
//     } else {
//         // Add new product to the cart.
//         $cart->items()->create([
//             'product_id' => $product->id,
//             'quantity' => $quantity
//         ]);
//     }

//     // Calculate the total cart value.
//     $cartTotal = $cart->items->sum(fn($item) => $item->quantity * $item->product->price);

//     return response()->json([
//         'message' => 'Product added to cart successfully!',
//         'cartItemCount' => $cart->items->count(),
//         'cartTotal' => number_format($cartTotal, 2)
//     ], 201);
// }


// public function updateCartItem(Request $request, $id)
// {
//     $cartItem = CartItem::findOrFail($id);

//     // Validate the quantity and ensure stock availability.
//     $request->validate(['quantity' => 'required|integer|min:1']);
//     $quantity = $request->input('quantity');

//     if ($quantity > $cartItem->product->stock) {
//         return response()->json(['message' => 'Insufficient stock available.'], 400);
//     }

//     // Update quantity and recalculate cart total.
//     $cartItem->update(['quantity' => $quantity]);
//     $cartTotal = $cartItem->cart->items->sum(fn($item) => $item->quantity * $item->product->price);

//     return response()->json([
//         'message' => 'Cart item updated!',
//         'cartItemCount' => $cartItem->cart->items->count(),
//         'cartTotal' => number_format($cartTotal, 2)
//     ]);
// }
// Retrieve all items in the user's cart
public function index()
{
    $cart = Cart::with('items.product.productimages')->firstOrNew(['user_id' => Auth::id()]);
    $cartItems = $cart->items ?? collect();

    // Calculate total
    $cartTotal = $cartItems->sum(fn($item) => $item->product ? $item->quantity * $item->product->price : 0);

    return response()->json([
        'cartItems' => $cartItems,
        'cartTotal' => $cartTotal,
    ]);
}

// Add a new product to the cart or update existing quantity
public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'serial_number' => 'required|string',
        'quantity' => 'required|integer|min:1',
    ]);

    // Retrieve or create the user's cart
    $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
    
    // Add or update the cart item
    CartItem::updateOrCreate(
        [
            'cart_id' => $cart->id,
            'product_id' => $request->product_id,
            'serial_number' => $request->serial_number,
        ],
        ['quantity' => DB::raw('quantity + ' . $request->quantity)]
    );

    // Return the cart item count and a success message
    $cartItemCount = $cart->items->sum('quantity');

    return response()->json([
        'cartItemCount' => $cartItemCount,
        'message' => 'Product added to cart successfully!',
    ]);
}

// Increase the quantity of a specific cart item
public function increaseQuantity(Request $request, $id)
{
    $cartItem = CartItem::findOrFail($id);

    // Ensure the quantity does not exceed available stock
    if ($cartItem->quantity < $cartItem->product->stock) {
        $cartItem->increment('quantity');
        return response()->json([
            'message' => 'Quantity increased',
            'cartItem' => $cartItem,
        ]);
    } else {
        return response()->json([
            'message' => 'Not enough stock available',
        ], 400);
    }
}

// Decrease the quantity of a specific cart item
public function decreaseQuantity(Request $request, $id)
{
    $cartItem = CartItem::findOrFail($id);

    // Ensure the quantity does not go below 1
    if ($cartItem->quantity > 1) {
        $cartItem->decrement('quantity');
        return response()->json([
            'message' => 'Quantity decreased',
            'cartItem' => $cartItem,
        ]);
    } else {
        return response()->json([
            'message' => 'Minimum quantity reached',
        ], 400);
    }
}

// Remove an item from the cart
public function removeFromCart($id)
{
    CartItem::findOrFail($id)->delete();

    return response()->json([
        'message' => 'Item removed from cart',
    ]);
}

// Clear all items in the cart
public function clearCart()
{
    $cart = Cart::where('user_id', Auth::id())->first();
    if ($cart) {
        $cart->items()->delete();
    }

    return response()->json([
        'message' => 'Cart cleared successfully',
    ]);
}
}