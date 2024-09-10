@extends('frontend.master')

@section('title', 'Checkout')

@section('content')
<div class="container mt-4">
    <h1>Checkout</h1>
    @if($cart && $cart->cartItems->count() > 0)
        <form action="{{ route('order.create') }}" method="POST">
            @csrf
            <!-- Checkout form fields here -->
            <div class="form-group">
                <label for="address">Shipping Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <button type="submit" class="btn btn-success">Place Order</button>
        </form>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection
