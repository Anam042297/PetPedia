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
                            Price: ${{ $product->price }} <br>
                            @if($product->type === 'food')
                                Weight: {{ $product->weight }} kg <br>
                            @endif
                            Company: {{ $product->company }} <br>
                            Quantity: {{ $product->quantity }}
                        </p>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                        </form>
                        
                        {{-- <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">Add to Cart</a> --}}
                        {{-- <a href="{{ route('cart.add', $product->id) }}" class="btn btn-secondary">Add to Cart</a> --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
