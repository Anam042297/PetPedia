@extends('frontend.master')
@section('content')
<div class="container">
    <h1>Your Cart</h1>

    @if ($cart && $cart->cartItems->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart->cartItems as $cartItem)
                    <tr>
                        <td>{{ $cartItem->product->name ?? 'Unknown Product' }}</td>
                        <td>
                            <form action="{{ route('cart.update', $cartItem->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1" class="form-control" required>
                                <button type="submit" class="btn btn-primary mt-2">Update</button>
                            </form>
                        </td>
                        <td>${{ number_format($cartItem->product->price ?? 0, 2) }}</td>
                        <td>${{ number_format($cartItem->product->price * $cartItem->quantity ?? 0, 2) }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        

        <div class="d-flex justify-content-between mt-3">
            <form action="{{ route('cart.clear') }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-warning">Clear Cart</button>
            </form>
            <a href="{{ route('checkout.index') }}" class="btn btn-success">Proceed to Checkout</a>
        </div>
        
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection
