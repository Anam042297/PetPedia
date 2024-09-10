@extends('frontend.master')

@section('title', 'Product Listing')

@section('content')
<div class="container">
    <h1 class="mt-4">Products</h1>
    <div class="row">
        @foreach ($products as $product)
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    @if($product->images->isNotEmpty())
                        <img src="{{ asset('storage/product_images/' . basename($product->images->first()->image_path)) }}" class="card-img-top" alt="{{ $product->name }}">
                    @else
                        <img src="{{ asset('images/placeholder.png') }}" class="card-img-top" alt="No Image Available">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">
                            Category: {{ $product->category->name }} <br>
                            Price: {{ $product->price }} <br>
                            @if($product->type === 'food')
                                Weight: {{ $product->weight }} kg <br>
                            @endif
                            Company: {{ $product->company }} <br>
                            Quantity: {{ $product->quantity }}
                        </p>
                     
                        <form class="add-to-cart-form">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="button" class="btn btn-primary add-to-cart" data-product-id="{{ $product->id }}" data-serial-number="{{ $product->serial_number }}">Add to Cart</button>

                        </form>
                        <a href="{{ route('orders.create', $product->id) }}" class="btn btn-primary">Buy Now</a>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
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


