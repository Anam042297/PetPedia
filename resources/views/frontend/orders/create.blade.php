@extends('frontend.master')
@section('content')
<div class="container">
    <h1>Order Product</h1>
    <form action="{{ route('orders.store', $product->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}" required>
        </div>
        
        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity', 1) }}" min="1" required>
        </div>
        
    
        <button type="submit" class="btn btn-primary">Place Order</button>
    </form>
</div>
@endsection
