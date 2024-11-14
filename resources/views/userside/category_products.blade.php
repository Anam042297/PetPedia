@extends('userside.master')
@section('content')
<div class="col-lg-4">
</div>
<h2 class="mb-4">Products in Category: {{ $category->name }}</h2> 
<div class="row" >
    
    @forelse($products as $product)
            <div class="col-md-3 mb-4">
            <div class="card h-100">            
                <div id="productImageCarousel{{ $product->id }}" class="carousel slide" data-ride="carousel">
                    
                    <div class="carousel-inner">
                        @foreach($product->productImages as $key => $image)
                            <div class="carousel-item @if($key == 0) active @endif">
                                <img class="d-block w-100" src="{{ asset($image->image_path) }}" alt="Product Image" style="height: 250px; object-fit: scale-down;">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#productImageCarousel{{ $product->id }}" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#productImageCarousel{{ $product->id }}" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">
                        <strong>Price:</strong> {{ number_format($product->price, 2) }} <br>
                        <strong>Brand:</strong> {{ $product->brand }} <br>
                    </p>
                </div>

                    <form class="add-to-cart-form">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="button" class="boxed-btn4 add-to-cart" data-product-id="{{ $product->id }}" data-serial-number="{{ $product->serial_number }}">Add to Cart</button>
                    </form>
          
            </div>
        </div>
    @empty
        <div class="col-12">
            <p>No products found in this category.</p>
        </div>
    @endforelse
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let isAuthenticated = {{ Auth::check() ? 'true' : 'false' }};
        
        $('.add-to-cart').click(function(e) {
            e.preventDefault();

            if (!isAuthenticated) {
                alert('You must be logged in to add products to the cart.');
                window.location.href = "{{ route('login') }}"; // Redirect to login
                return;
            }

            let productId = $(this).data('product-id');
            let serialNumber = $(this).data('serial-number');
            let quantity = 1;

            $.ajax({
                url: "{{ route('cart.store') }}", 
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
