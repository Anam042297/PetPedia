@extends('frontend.master')

@section('title', $product->name)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <!-- Carousel for product images -->
            <?php $carouselId = 'productImagesCarousel' . $product->id; ?>
            <div id="{{ $carouselId }}" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @if ($product->images->isEmpty())
                        <div class="carousel-item active">
                            <img src="{{ asset('images/placeholder.png') }}" class="d-block w-100" alt="No Image Available">
                        </div>
                    @else
                        @foreach ($product->images as $index => $image)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/product_images/' . basename($image->image_path)) }}" class="d-block w-100" alt="Product Image">
                            </div>
                        @endforeach
                    @endif
                </div>
                @if ($product->images->count() > 1)
                    <a class="carousel-control-prev" href="#{{ $carouselId }}" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#{{ $carouselId }}" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <h1>{{ $product->name }}</h1>
            <p>{{ $product->description }}</p>
            <p><strong>Price:</strong> ${{ $product->price }}</p>
            <p><strong>Category:</strong> {{ $product->category->name }}</p>
            @if ($product->type === 'food')
                <p><strong>Weight:</strong> {{ $product->weight }} kg</p>
            @endif
            <p><strong>Company:</strong> {{ $product->company }}</p>
            <p><strong>Quantity:</strong> {{ $product->quantity }}</p>
            {{-- <a href="{{ route('cart.add', $product->id) }}" class="btn btn-primary">Add to Cart</a> --}}
        </div>
    </div>
</div>
@endsection
