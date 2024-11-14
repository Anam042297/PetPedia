@extends('userside.master')
@section('content')

<!-- slider_area_start -->
<div class="slider_area">
    <div class="single_slider slider_bg_1 d-flex align-items-center">
        <div class="container" >
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="slider_text">
                        <h3>Find Your <br> <span>Furry Friend</span></h3>
                        <p>Dedicated to a community that cares, <br> Petpedia is your one-stop destination for pet care, adoption, and trusted guidance.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="dog_thumb d-none d-lg-block">
            <img src="{{ asset('userside/img/banner/dog.png') }}" alt="Dog Banner">
        </div>
    </div>
</div>
<!-- slider_area_end -->

<!-- team_area -->
<div class="team_area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-10 text-center">
                <div class="section_title mb-5">
                    <h3>Pet Category</h3>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach($categories as $category)
            <div class="col-lg-2 col-md-4">
                <div class="single_team">
                    <div class="thumb">
                        <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" class="category-image">
                    </div>
                    <div class="member_name text-center">
                        <div class="mamber_inner">
                           <a href="{{ route('category.posts', $category->id) }}"> 
                               <h4>{{ $category->name }}</h4>
                           </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- product categories -->



<div class="service_area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="text-center">
                <div class="section_title mb-5">
                    <h3>Product Categories</h3>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach($productcategories as $productCategory)
                <div class="col-lg-3 col-md-4 mb-4 d-flex">
                    <div class="single_service card h-80 w-80">
                        <div class="service_thumb d-flex align-items-center justify-content-center">
                            <div class="service_icon">
                                <img src="{{ asset('storage/icons/' . basename($productCategory->icon)) }}" 
                                     alt="{{ $productCategory->name }}" 
                                     style="width: 150px; height: 120px; object-fit: cover; border-radius: 50%;"> 
                           </div>
                        </div>
                        <div class="service_content text-center">
                            <a href="{{ route('productcategories.products', $productCategory->id) }}"> 
                            <h3>{{ $productCategory->name }}</h3>
                            </a>
                        </div>
                    
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


@endsection
