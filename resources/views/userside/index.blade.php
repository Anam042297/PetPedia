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
                        <p>Lorem ipsum dolor sit amet, consectetur <br> adipiscing elit, sed do eiusmod.</p>
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
            <div class=" text-center">
                <div class="section_title mb-5">
                    <h3>Product Categories</h3>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-4">
                <div class="single_service" >
                    <div class="service_thumb d-flex align-items-center justify-content-center">
                        <div class="service_icon">
                            <img src="" alt="Food Icon" style="height: 100px;">
                        </div>
                    </div>
                    <div class="service_content text-center">
                        <h3>Food</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
