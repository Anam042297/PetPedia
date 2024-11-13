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
        <div class="container p-4 mb-5 rounded shadow">
            <div class="row">
                <div class="col-lg-6">
                    <div id="imageCarousel{{ $post->id }}" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($post->images as $index => $image)
                                <div class="carousel-item @if($index === 0) active @endif">
                                    <img src="{{ $image->url }}" class="d-block w-100" alt="Image">
                                </div>
                            @endforeach
                        </div>
                        @if($post->images->count() > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel{{ $post->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel{{ $post->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        @endif
                    </div>
                    
    
                    <div class="blog_details mt-4">
                        <h2>{{ $post->name }}</h2>
                        <ul class="list-inline text-muted mt-3 mb-4">
                            <li class="list-inline-item"><i class="fa fa-folder"></i> {{ $post->category->name }}</li>
                            <li class="list-inline-item"><i class="fa fa-paw"></i> {{ $post->breed->name }}</li>
                            <li class="list-inline-item"><i class="fa fa-calendar"></i> {{ $post->age }}</li>
                            <li class="list-inline-item"><i class="fa fa-comments"></i> {{ $post->gender }}</li>
                        </ul>
                        <p>{{ $post->description }}</p>
                    </div>
                </div>
    
                <div class="col-lg-4 d-flex align-items-center justify-content-center">
                    @php
                    $phoneNumber = "+923158230935";
                    $postLink = route('single.post', $post->id);
                    $message = "Hello, I am interested in this post. Could you please provide more information?\n\n"
                    . "Here is the link to the post: {$postLink}";
                    @endphp
                    <a href="https://wa.me/{{ str_replace('+', '', $phoneNumber) }}?text={{ urlencode($message) }}"
                        target="_blank">
                        <h4 class="widget_title" style=" color: #25D366;">
                            Contact on WhatsApp
                        </h4>
                    </a>
                 </div>
            </div>
        </div>
    </section>
</div>  
@endsection