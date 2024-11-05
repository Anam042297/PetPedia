@extends('userside.master')
@section('content')
 <!-- slider_area_start -->
  <div class="slider_area">
    <div class="single_slider slider_bg_1 d-flex align-items-center">
        <div class="container">
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
            <img src="userside/img/banner/dog.png" alt="">
        </div>
    </div>
</div>
<!-- slider_area_end -->
<div class="team_area">
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-lg-6 col-md-10">
                <div class="section_title text-center mb-95">
                    <h3>Pet Category</h3>
                    
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            @foreach($categories as $category)
            <div class="col-lg-2">
                <div class="single_team">
                    <div class="thumb">
                        <img src="{{ asset($category->image) }}" alt="category image" class="category-image" style="height: 150px;">
                    </div>
                    <div class="member_name text-center">
                        <div class="mamber_inner">
                           <a href="{{ route('category.posts', $category->id) }}"> <h4>{{ $category->name }}</h4></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        
</div>
<!-- service_area_start  -->
<div class="service_area">
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-lg-7 col-md-10">
                <div class="section_title text-center mb-95">
                    <h3>Product Categories</h3>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-3">
                <div class="single_service">
                     <div class="service_thumb  d-flex align-items-center justify-content-center">
                         <div class="service_icon">
                             <img src="userside/img/service/service_icon_1.png" alt="" style="height: 100px;">
                         </div>
                     </div>
                     <div class="service_content text-center">
                        <h3>food</h3>
                     </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- service_area_end -->

<!-- pet_care_area_start  -->
<div class="pet_care_area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 col-md-6">
                <div class="pet_thumb">
                    <img src="userside/img/about/pet_care.png" alt="">
                </div>
            </div>
            <div class="col-lg-6 offset-lg-1 col-md-6">
                <div class="pet_info">
                    <div class="section_title">
                        <h3><span>We care your pet </span> <br>
                            As you care</h3>
                        <p>Lorem ipsum dolor sit , consectetur adipiscing elit, sed do <br> iusmod tempor incididunt ut labore et dolore magna aliqua. <br> Quis ipsum suspendisse ultrices gravida. Risus commodo <br>
                            viverra maecenas accumsan.</p>
                        <a href="about.html" class="boxed-btn3">About Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- pet_care_area_end  -->

<!-- testmonial_area_start  -->
<div class="testmonial_area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="textmonial_active owl-carousel">
                    <div class="testmonial_wrap">
                        <div class="single_testmonial d-flex align-items-center">
                            <div class="test_thumb">
                                <img src="userside/img/testmonial/1.png" alt="">
                            </div>
                            <div class="test_content">
                                <h4>Description</h4>
                                <span>Head of web design</span>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exerci.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- testmonial_area_end  -->

<!-- team_area_start  -->

<!-- team_area_start  -->


@endsection