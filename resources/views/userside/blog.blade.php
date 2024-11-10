
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

<section class="blog_area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="blog_left_sidebar">
                    @foreach($posts as $post)
                        <article class="blog_item">
                            <div class="blog_item_img">
                                <div id="imageCarousel{{$post->id}}" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach($post->images as $key => $image)
                                            <div class="carousel-item @if($key == 0) active @endif">
                                                <img class="d-block w-100" src="{{ asset($image->url) }}" alt="pet image" style="height: 250px; object-fit: scale-down;">
                                            </div>
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#imageCarousel{{$post->id}}" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#imageCarousel{{$post->id}}" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                                <a href="#" class="blog_item_date">
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
                                    <li><a><i class="fa fa-clock text-muted"></i> {{ $post->age }}</a></li>
                                    <li><a><i class="fa fa-comments"></i> {{ $post->gender }}</a></li>
                                </ul>
                                <a href="{{ route('single.post', $post->id) }}" class="boxed-btn4">Read More</a>
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
