@extends('userside.master')

@section('content')
<div class="col-lg-4">
    
    
</div>
<div class="container my-4">
    <h2 class="mb-4">Products in Category: {{ $category->name }}</h2> <!-- Display selected category name -->

    <div class="row">
        @forelse($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">            
              <div id="productImageCarousel{{ $product->id }}" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <!-- Loop through product images -->
        @foreach($product->productImages as $key => $image)
            <div class="carousel-item @if($key == 0) active @endif">
                <img class="d-block w-100" src="{{ asset($image->image_path) }}" alt="Product Image" style="height: 250px; object-fit: scale-down;">
            </div>
        @endforeach
    </div>
    <!-- Carousel controls -->
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
                            <strong>Price:</strong> PKR {{ number_format($product->price, 2) }} <br>
                            <strong>Brand:</strong> {{ $product->brand }} <br>
                        </p>
                    </div>

                    <div class="card-footer">
                        <button class="btn btn-success btn-sm">Add to Cart</button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p>No products found in this category.</p>
            </div>
        @endforelse
    
    </div>
</div>
@endsection
