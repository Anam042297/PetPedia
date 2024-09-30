@extends('frontend.master')

@section('title', 'Product Listing')

@section('content')
<div class="container">
    <h1 class="mt-4">Products</h1>
    <div class="row">
        @foreach ($products as $product)
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    @if($product->productImages && $product->productimages->isNotEmpty())
    <img src="{{ asset('storage/product_images/' . basename($product->productimages->first()->image_path)) }}" class="card-img-top" alt="{{ $product->name }}">
@else
    <img src="{{ asset('images/placeholder.png') }}" class="card-img-top" alt="No Image Available">
@endif

                    {{-- @if($product->product_images->isNotEmpty())
                        <img src="{{ asset('storage/productimages/' . basename($product->product_images->first()->image_path)) }}" class="card-img-top" alt="{{ $product->name }}">
                    @else
                        <img src="{{ asset('images/placeholder.png') }}" class="card-img-top" alt="No Image Available">
                    @endif --}}
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">
                            {{-- Pet Type: {{ ucfirst($product->pet_type) }} <br> <!-- Display the pet type --> --}}
                   
                            Price: {{ number_format($product->price, 2) }} <br> <!-- Format price with 2 decimal places -->
                            @if($product->weight)
                                Weight: {{ $product->weight }} kg <br> <!-- Show weight if available -->
                            @endif
                            Brand: {{ $product->brand ?? 'No Brand' }} <br> <!-- Show brand or "No Brand" if not set -->
                          
                        </p>
                     
                        <form class="add-to-cart-form">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="button" class="btn btn-primary add-to-cart" data-product-id="{{ $product->id }}" data-serial-number="{{ $product->serial_number }}">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>    
$(document).ready(function() {
    $('.add-to-cart').click(function(e) {
        e.preventDefault();

        let productId = $(this).data('product-id');
        let serialNumber = $(this).data('serial-number');
        let quantity = 1;

        $.ajax({
            url: "{{ route('cart.add') }}",
            method: "POST",
            data: {
                product_id: productId,
                serial_number: serialNumber,
                quantity: quantity,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                alert(response.message);
                $('#cart-item-count').text(response.cartItemCount);
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseJSON.message);
            }
        });
    });
});
</script>

@endsection
