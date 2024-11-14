
@extends('userside.master')
@section('content')

<!-- bradcam_area_start -->
<div class="slider_area">
    <div class="single_slider slider_bg_1 d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="slider_text">
                        <h3>Explore Blogs<br> <span>to find pets</span></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur <br> adipiscing elit, sed do eiusmod.</p>
                    </div>
                </div>
                <div class="dog_thumb d-none d-lg-block">
                    <img src="{{ asset('userside/img/team/3.png') }}" alt="" style="height: 450px;">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Display the name of the selected category -->
<h1>Products in {{ $category->name }} Category</h1>

<!-- Display products within this selected category -->
<ul>
    @foreach($category->products as $product)
        <li>
            <h3>{{ $product->name }}</h3>
            <p>Price: ${{ $product->price }}</p>
            <p>Brand: {{ $product->brand }}</p>
            <p>Weight: {{ $product->weight }} kg</p>
            
            <!-- Display each product's images -->
            @foreach($product->productimages as $image)
                <img src="{{ $image->url }}" alt="{{ $product->name }}" style="width: 100px; height: auto;">
            @endforeach
        </li>
    @endforeach
</ul>

<!-- Pagination (if needed) -->
{{ $category->products->links() }}

<!-- Display other categories with product counts -->
<h2>Other Categories</h2>
<ul>
    @foreach($categories as $cat)
        <li><a href="{{ route('products.byCategory', $cat->id) }}">{{ $cat->name }} ({{ $cat->products_count }} products)</a></li>
    @endforeach
</ul>



@endsection
