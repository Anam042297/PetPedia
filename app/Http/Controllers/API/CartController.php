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
    public function index()
    {
        // Fetch the cart for the authenticated user, along with related product data.
        $cart = Cart::where('user_id', Auth::id())->with('items.product.productImages', 'items.product.category', 'items.product.productCategory')->first();

        // Check if the cart has items; if not, return an empty collection.
        $cartItems = $cart ? $cart->items : collect();

        // Calculate the cart total by summing each item's total price.
        $cartTotal = $cartItems->reduce(function ($total, $item) {
            return $total + ($item->quantity * $item->product->price);
        }, 0);

        // Format each cart item to return the desired structure.
        $products = $cartItems->map(function ($item) {
            $product = $item->product;
            return [
                'id' => $product->id,
                'category' => $product->category->name ?? null,
                'product_category' => $product->productCategory->name ?? null,
                'name' => $product->name,
                'price' => $product->price,
                'brand' => $product->brand,
                'weight' => $product->weight,
                'stock' => $product->stock,
                'quantity' => $item->quantity,
                'images' => $product->productImages->pluck('image_path')
            ];
        });

        // Return the JSON response with success flag, product details, and cart total.
        return response()->json([
            'success' => true,
            'data' => [
                'cartItems' => $products,
                'cartTotal' => number_format($cartTotal, 2)
            ]
        ], 200);
    }

    // Add to Cart
    // public function addToCart(Request $request)
    // {
    //     $request->validate([
    //         'product_id' => 'required|integer|exists:products,id',
    //         'serial_number' => 'required|string',
    //     ]);

    //     $product = Product::findOrFail($request->input('product_id'));
    //     if ($request->input('quantity', 1) > $product->stock) {
    //         return response()->json([
    //             'message' => 'Requested quantity exceeds available stock. Available: ' . $product->stock
    //         ], 400);
    //     }

    //     $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

    //     $cartItem = CartItem::where('cart_id', $cart->id)
    //         ->where('product_id', $request->input('product_id'))
    //         ->where('serial_number', $request->input('serial_number'))
    //         ->first();

    //     if ($cartItem) {
    //         $cartItem->quantity += $request->input('quantity', 1);
    //     } else {
    //         $cartItem = CartItem::create([
    //             'cart_id' => $cart->id,
    //             'product_id' => $request->input('product_id'),
    //             'quantity' => $request->input('quantity', 1),
    //             'serial_number' => $request->input('serial_number')
    //         ]);
    //     }

    //     $cartItem->save();

    //     $cartTotal = $cart->items->reduce(function ($total, $item) {
    //         return $total + ($item->quantity * $item->product->price);
    //     }, 0);

    //     return response()->json([
    //         'message' => 'Product added to cart successfully!',
    //         'cartItemCount' => $cart->items->count(),
    //         'cartTotal' => number_format($cartTotal, 2)
    //     ], 201);
    // }

    public function addToCart(Request $request)
    {
        // Validate the request to ensure `product_id` is provided and exists in the products table.
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'integer|min:1'  // Optional: Quantity, defaults to 1 if not provided.
        ]);

        $product = Product::findOrFail($request->input('product_id'));

        // Check stock availability for the requested quantity.
        $requestedQuantity = $request->input('quantity', 1);
        if ($requestedQuantity > $product->stock) {
            return response()->json([
                'message' => 'Requested quantity exceeds available stock. Available: ' . $product->stock
            ], 400);
        }

        // Retrieve or create a cart for the authenticated user.
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        // Check if the product is already in the cart.
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $request->input('product_id'))
            ->first();

        if ($cartItem) {
            // Update the quantity if the item already exists in the cart.
            $cartItem->quantity += $requestedQuantity;
        } else {
            // Create a new cart item if it does not exist.
            $cartItem = CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $request->input('product_id'),
                'quantity' => $requestedQuantity
            ]);
        }

        // Save the cart item.
        $cartItem->save();

        // Calculate the total cart value.
        $cartTotal = $cart->items->reduce(function ($total, $item) {
            return $total + ($item->quantity * $item->product->price);
        }, 0);

        // Return a success response with cart details.
        return response()->json([
            'message' => 'Product added to cart successfully!',
            'cartItemCount' => $cart->items->count(),
            'cartTotal' => number_format($cartTotal, 2)
        ], 201);
    }

    // // Update Cart Item
    // public function updateCartItem(Request $request, $id)
    // {
    //     $cartItem = CartItem::findOrFail($id);

    //     $request->validate([
    //         'quantity' => 'required|integer|min:1',
    //     ]);

    //     $product = $cartItem->product;
    //     if ($request->input('quantity') > $product->stock) {
    //         return response()->json([
    //             'message' => 'Requested quantity exceeds available stock. Available: ' . $product->stock
    //         ], 400);
    //     }

    //     $cartItem->quantity = $request->input('quantity');
    //     $cartItem->save();

    //     $cartTotal = $cartItem->cart->items->reduce(function ($total, $item) {
    //         return $total + ($item->quantity * $item->product->price);
    //     }, 0);

    //     return response()->json([
    //         'message' => 'Cart item updated successfully!',
    //         'cartItemCount' => $cartItem->cart->items->count(),
    //         'cartTotal' => number_format($cartTotal, 2)
    //     ], 200);
    // }
    

    // Remove from Cart
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
    
        // Check if quantity is greater than 1 before decrementing
        if ($cartItem->quantity > 1) {
            $cartItem->quantity -= 1;
            $cartItem->save();
        } 
        $cartTotal = $cartItem->cart->items->reduce(function ($total, $item) {
            return $total + ($item->quantity * $item->product->price);
        }, 0);
    
        return response()->json([
            'message' => 'Cart item quantity updated successfully.',
            'cartItemCount' => $cartItem->cart->items->count(),
            'cartTotal' => number_format($cartTotal, 2),
        ], 200);
    }
    
    
}
