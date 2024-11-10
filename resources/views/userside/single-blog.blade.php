@extends('userside.master')
@section('content')

<div class="slider_area">
    <div class="single_slider slider_bg_1 d-flex align-items-center" style="max-height: 200px">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="slider_text">
                        <h3>Blog<br> <span>Details</span></h3>
                    </div>
                </div>
                <div class="dog_thumb d-none d-lg-block">
                    <img src="{{ asset('userside/img/team/3.png') }}" alt="" style="height: 250px;">
                </div>
            </div>
        </div>
    </div>
</div>

<section class="blog_area single-post-area section-padding">
    <div class="testmonial_area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="textmonial_active owl-carousel">
                        <div class="testmonial_wrap">
                            <div class="single_testmonial d-flex align-items-center">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-8 posts-list">
                                            <div class="single-post">
                                                <div class="feature-img">
                                                    <div id="imageCarousel{{ $post->id }}" class="carousel slide" data-ride="carousel">
                                                        <div class="carousel-inner">
                                                            @foreach($post->images as $key => $image)
                                                                <div class="carousel-item @if($key == 0) active @endif">
                                                                    <img class="d-block w-100" src="{{ asset($image->url) }}" alt="pet image" style="height: 250px; object-fit: scale-down;">
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <a class="carousel-control-prev" href="#imageCarousel{{ $post->id }}" role="button" data-slide="prev">
                                                            <span class="carousel-control-prev-icon"></span>
                                                        </a>
                                                        <a class="carousel-control-next" href="#imageCarousel{{ $post->id }}" role="button" data-slide="next">
                                                            <span class="carousel-control-next-icon"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="blog_details">
                                                    <h2>{{ $post->name }}</h2>
                                                    <ul class="blog-info-link mt-3 mb-4">
                                                        <li><a><i class="fa fa-folder text-muted"></i> {{ $post->category->name }}</a></li>
                                                        <li><a><i class="fa fa-paw text-muted"></i> {{ $post->breed->name }}</a></li>
                                                        <li><a><i class="fa fa-clock text-muted"></i> {{ $post->age }}</a></li>
                                                        <li><a><i class="fa fa-comments"></i> {{ $post->gender }}</a></li>
                                                    </ul>
                                                    <p class="excert">
                                                        {{ $post->description }}
                                                    </p>
                                                </div>
                                            </div>
                                            <a href="{{ route('previous.page') }}">Go Back</a>
                                        </div>
                                    </div>
                                </div>
                                <aside class="single_sidebar_widget post_category_widget">
                                    <ul>
                                        <li>
                                            @php
                                                $phoneNumber = "+923158230935"; // Your WhatsApp number
                                                $postLink = route('single.post', $post->id); // Link to the specific post
                                                $message = "Hello, I am interested in this post. Could you please provide more information?\n\nHere is the link to the post: {$postLink}";
                                            @endphp
                                            
                                            <a href="https://wa.me/{{ str_replace('+', '', $phoneNumber) }}?text={{ urlencode($message) }}" 
                                               target="_blank" 
                                               class="d-flex align-items-center" 
                                               style="text-decoration: none;">
                                                <h2 class="widget_title" style="margin: 0; color: #25D366;">
                                                    <i class="fab fa-whatsapp mr-2" style="color: #25D366; font-size: 1.5em; margin-right: 8px;"></i>
                                                    Contact on WhatsApp
                                                </h2>
                                            </a>
                                        </li>
                                    </ul>
                                </aside>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
