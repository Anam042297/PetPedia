@extends('userside.master')
@section('content')
{{-- @include('dashboard.includes.css') --}}


<div class="slider_area">
   <div class="single_slider  d-flex align-items-center " style="max-height: 200px">
       <div class="container" style="background: linear-gradient(135deg, #ff99b6, #af99ff);border-radius: 15px;box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);padding: 20px;margin-top: 50px;">
           <div class="row">
               <div class="col-lg-5 col-md-6">
                   <div class="slider_text">
                       <h3>Blog<br> <span>Details</h3>
                     </div>
                  </div>
                  <div class="dog_thumb d-none d-lg-block">
                   <img src="{{ asset('userside/img/team/3.png') }}" alt="" style="height: 250px; ">
                  </div>
               </div>
            </div>
         </div>
      </div>
      <section class="section-padding">
        <div class="container" style="border-radius: 15px;box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);padding: 20px;margin-bottom: 50px;">
            <div class="col-lg-10">
                <div class="textmonial_active owl-carousel">
                    <div class="single_testmonial d-flex align-items-center">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div id="imageCarousel{{ $post->id }}" class="carousel slide" data-ride="carousel">
                                        <?php $carouselId = 'postImagesCarousel' . $post->id; ?>
                                        <div id="{{ $carouselId }}" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                @foreach ($post->images as $index => $image)
                                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                        <img src="{{ $image->url }}" class="d-block w-100" alt="Image">
                                                    </div>
                                                @endforeach
                                            </div>
                                            @if ($post->images->count() > 1)
                                                <a class="carousel-control-prev" href="#{{ $carouselId }}" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#{{ $carouselId }}" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
    
                                    <div class="blog_details">
                                        <h2>{{ $post->name }}</h2>
                                        <ul class="blog-info-link mt-3 mb-4">
                                            <li><a><i class="fa fa-folder text-muted"></i> {{ $post->category->name }}</a></li>
                                            <li><a><i class="fa fa-paw text-muted"></i> {{ $post->breed->name }}</a></li>
                                            <li><a><i class="fa fa-calendar text-muted"></i> {{ $post->age }}</a></li>
                                            <li><a><i class="fa fa-comments text-muted"></i> {{ $post->gender }}</a></li>
                                        </ul>
                                        <p>{{ $post->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <aside>
                            <ul>
                                <li>
                                    @php
                                        $phoneNumber = "+923158230935";
                                        $postLink = route('single.post', $post->id);
                                        $message = "Hello, I am interested in this post. Could you please provide more information?\n\n"
                                                 . "Here is the link to the post: {$postLink}";
                                    @endphp
    
                                    <a href="https://wa.me/{{ str_replace('+', '', $phoneNumber) }}?text={{ urlencode($message) }}" 
                                       target="_blank">
                                        <h4 class="widget_title" style=" color: #25D366;">
                                            <i class="fa fa-whatsapp mr-2" style="color: #25D366; font-size: 1.5em; margin-right: 8px;"></i>
                                            Contact on WhatsApp
                                        </h4>
                                    </a>
                                </li>
                            </ul>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
   {{-- <div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="account-card">
                <div class="col-lg-8">
                    <div class="d-flex flex-column text-left mb-4">
                        <h4 class="text-secondary mb-3">Blog Detail</h4>
                        <h1 class="mb-3">{{ $post->name }}</h1>
                        <div class="card-body bg-light p-4">
                            <?php $carouselId = 'postImagesCarousel' . $post->id; ?>
                            <div id="{{ $carouselId }}" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($post->images as $index => $image)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <img src="{{ $image->url }}" class="d-block w-100" alt="Image">
                                        </div>
                                    @endforeach
                                </div>
                                @if ($post->images->count() > 1)
                                    <a class="carousel-control-prev" href="#{{ $carouselId }}" role="button"
                                        data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#{{ $carouselId }}" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                @endif
                            </div>
    
                            <!-- Category Section -->
                            <div class="blog_details">
                                <h2>{{ $post->name }}
                                </h2>
                                <ul class="blog-info-link mt-3 mb-4">
                                   <li><a><i class="fa fa-folder text-muted"></i> {{ $post->category->name }}</a></li>
                                   <li><a<i class="fa fa-paw text-muted"></i> {{ $post->breed->name }}</a></li>
                                   <li><a><i class="fa fa-clock text-muted"></i> {{ $post->age }}</a></li>
                                   <li><a><i class="fa fa-comments"></i> {{ $post->gender }}</a></li>
                                </ul>
                                <p class="excert">
                                   {{ $post->description }}
                                </p>
                             </div>
    
    
                        </div>
                    <!-- Back Button -->
                    <a href="" class="btn btn-primary">Back to Posts</a>
                </div>
        </div>
    </div>
</div> --}}
</div>  
@endsection