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
               </div>
            </div>
         </div>
      </div>
     <section class="section-padding">
        <div class="container p-4 mb-5 rounded shadow">
            <div class="row">
                <div class="col-lg-6">
                    <div id="postImageCarousel{{ $post->id }}" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($post->images as $key => $image)
                                <div class="carousel-item @if($key == 0) active @endif">
                                    <img class="d-block w-100" src="{{ asset($image->url) }}" alt="Post Image" 
                                         style="height: 250px; object-fit: scale-down;">
                                </div>
                            @endforeach
                        </div>
                        @if($post->images->count() > 1)
                            <a class="carousel-control-prev" href="#postImageCarousel{{ $post->id }}" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#postImageCarousel{{ $post->id }}" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        @endif
                    </div>
                    <div class="blog_details">
                        <a class="d-inline-block" href="#">
                            <h2>{{ $post->name }}</h2>
                        </a>
                        
                        <ul class="blog-info-link">
                            <li><a><i class="fa fa-folder text-muted"></i> {{ $post->category->name }}</a></li>
                            <li><a><i class="fa fa-paw text-muted"></i> {{ $post->breed->name }}</a></li>
                            <li><a><i class="fa fa-clock text-muted"></i> {{ $post->age }}</a></li>
                            <li><a><i class="fa fa-comments"></i> {{ $post->gender }}</a></li>
                        </ul>
                        <p>{{ $post->description }}</p>
                    </div>
                </div>
    
                <div class="col-lg-4 d-flex align-items-center justify-content-center">
                    @php
    $phoneNumber = "+923158230935";
    $message = "Hello, I am interested in this post. Could you please provide more information about?\n\n"
             . "Id: {$post->id}\n"
             . "Name: {$post->name}\n"
             . "Age: {$post->age}\n"
             ."Gender: {$post->gender}\n"
             . "Breed: {$post->breed->name}\n"
             . "Category: {$post->category->name}\n"
             . "Description: {$post->description}";
@endphp
<a href="https://wa.me/{{ str_replace('+', '', $phoneNumber) }}?text={{ urlencode($message) }}"
   target="_blank">
    <h4 class="widget_title" style="color: #25D366;">
        Contact on WhatsApp
    </h4>
</a>

                 </div>
            </div>
        </div>
    </section>
</div>  
@endsection