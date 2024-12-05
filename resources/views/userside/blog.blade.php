
@extends('userside.master')
@section('content')

<!-- bradcam_area_start -->
<div class="slider_area">
    <div class="single_slider slider_bg_1 d-flex align-items-center"  style="max-height: 380px">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="slider_text">
                        <h3>Explore Blogs<br> <span>to find pets</span></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="blog_area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="blog_left_sidebar">
                    @foreach($posts as $post)
                        <article class="blog_item">
                            <div class="blog_item_img">
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
                                {{-- <div id="header-carousel" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($post->images  as $index => $image)
                                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                <img class="d-block w-100" src="{{ asset($image->url) }}" alt="Post Image" 
                                                 style="height: 250px; object-fit: scale-down;">
                                                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                                    <div class="p-3" style="max-width: 900px;">
                                                        <h3 class="text-white mb-3 d-none d-sm-block">{{ $image->subtitle ?? '' }}</h3>
                                                        <h1 class="display-3 text-white mb-3">{{ $image->title }}</h1>
                                                        <h5 class="text-white mb-3 d-none d-sm-block">{{ $image->description ?? '' }}</h5>
                                                        @if ($image->button_one_text && $image->button_one_link)
                                                            <a href="{{ $image->button_one_link }}" class="btn btn-lg btn-primary mt-3 mt-md-4 px-4">{{ $image->button_one_text }}</a>
                                                        @endif
                                                        @if ($image->button_two_text && $image->button_two_link)
                                                            <a href="{{ $image->button_two_link }}" class="btn btn-lg btn-secondary mt-3 mt-md-4 px-4">{{ $image->button_two_text }}</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                
                                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                                        <div class="btn btn-primary rounded" style="width: 45px; height: 45px;">
                                            <span class="carousel-control-prev-icon mb-n2"></span>
                                        </div>
                                    </a>
                                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                                        <div class="btn btn-primary rounded" style="width: 45px; height: 45px;">
                                            <span class="carousel-control-next-icon mb-n2"></span>
                                        </div>
                                    </a>
                                </div> --}}
                                
                                <a class="blog_item_date">
                                    <h3>{{ $post->created_at->format('d') }}</h3>
                                    <p>{{ $post->created_at->format('M') }}</p>
                                </a>
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block" href="">
                                    <h2>{{ $post->name }}</h2>
                                </a>
                                <p>{{ $post->description }}</p>
                                <ul class="blog-info-link">
                                    <li><a><i class="fa fa-folder text-muted"></i> {{ $post->category->name }}</a></li>
                                    <li><a><i class="fa fa-paw text-muted"></i> {{ $post->breed->name }}</a></li>
                                    <li><a><i class="fa fa-calendar text-muted"></i> {{ $post->age }}</a></li>
                                    <li><a><i class="fa fa-comments text-muted"></i> {{ $post->gender }}</a></li>
                                </ul>
                                <a href="{{ route('single.post', $post->id) }}" style="margin-top: 20px" class="boxed-btn4">Read More</a>
                            </div>
                        </article>
                    @endforeach

                    <nav class="blog-pagination justify-content-center d-flex">
                        <ul class="pagination">
                            <li class="page-item {{ $posts->onFirstPage() ? 'disabled' : '' }}">
                                <a href="{{ $posts->previousPageUrl() }}" class="page-link" aria-label="Previous">
                                    <i class="ti-angle-left"></i>
                                </a>
                            </li>
                            @for ($i = 1; $i <= $posts->lastPage(); $i++)
                                <li class="page-item {{ $i == $posts->currentPage() ? 'active' : '' }}">
                                    <a href="{{ $posts->url($i) }}" class="page-link">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="page-item {{ $posts->hasMorePages() ? '' : 'disabled' }}">
                                <a href="{{ $posts->nextPageUrl() }}" class="page-link" aria-label="Next">
                                    <i class="ti-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <aside class="single_sidebar_widget post_category_widget">
                        <h4 class="widget_title">Breeds in {{ $category->name }}</h4>
                        <ul class="list cat-list">
                            @foreach($breeds as $breed)
                                <li>
                                    <a href="{{ route('breed.posts', ['categoryId' => $category->id, 'breedId' => $breed->id]) }}" class="d-flex">
                                        <p>{{ $breed->name }}</p>
                                        <p>({{ $breed->posts_count }})</p>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
