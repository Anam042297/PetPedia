
@extends('userside.master')
{{-- @extends('frontend.master') --}}

@section('title', 'Product Listing')

@section('content')
<div class="col-lg-3">
    {{-- Product Categories --}}
 
</div>

<div class="container">
    <h1 class="mt-4">Products</h1>
    <div class="row">
        @foreach ($products as $product)
            <div class="col-lg-4 mb-4">
                <div class="card h-100">
                    @if($product->productImages && $product->productimages->isNotEmpty())
                        <img src="{{ asset('storage/product_images/' . basename($product->productimages->first()->image_path)) }}" 
                             class="card-img-top" 
                             alt="{{ $product->name }}" 
                             style="width: 100%; height: 200px; object-fit: cover;">  <!-- Fixed size for product images -->
                    @else
                        <img src="{{ asset('images/placeholder.png') }}" 
                             class="card-img-top" 
                             alt="No Image Available" 
                             style="width: 100%; height: 250px; object-fit: cover;">  <!-- Fixed size for placeholder -->
                    @endif

                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">
                            Price: {{ number_format($product->price, 2) }} <br> 
                            @if($product->weight)
                                Weight: {{ $product->weight }} kg <br>
                            @endif
                            Brand: {{ $product->brand ?? 'No Brand' }} <br>
                        </p>
                     
                        <form class="add-to-cart-form">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                          
                            {{-- <a href="about.html" class="boxed-btn3">About Us</a> --}}
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
        let isAuthenticated = {{ Auth::check() ? 'true' : 'false' }};
    
        $('.add-to-cart').click(function(e) {
            e.preventDefault();
    
            if (!isAuthenticated) {
                alert('You must be logged in to add products to the cart.');
                window.location.href = "{{ route('login') }}"; // Redirect to the login page
                return;
            }
    
            let productId = $(this).data('product-id');
            let serialNumber = $(this).data('serial-number');
            let quantity = 1;
    
        //     $.ajax({
        //         url: "{{ route('cart.add') }}", // Add your route here
        //         method: "POST",
        //         data: {
        //             product_id: productId,
        //             serial_number: serialNumber,
        //             quantity: quantity,
        //             _token: "{{ csrf_token() }}"
        //         },
        //         success: function(response) {
        //             $('#cart-item-count').text(response.cartItemCount);
        //         },
        //         error: function(xhr) {
        //             // Handle error
        //         }
        //     });
        // });
        $.ajax({
    url: "{{ route('cart.add') }}", // Add your route here
    method: "POST",
    data: {
        product_id: productId,
        serial_number: serialNumber,
        quantity: quantity,
        _token: "{{ csrf_token() }}"
    },
    success: function(response) {
        $('#cart-item-count').text(response.cartItemCount);
        alert(response.message);
    },
    error: function(xhr) {
        console.error(xhr.responseText);
        alert("There was an error adding the product to the cart.");
    }
});
        });
    });

    </script>

@endsection
