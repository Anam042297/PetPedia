@extends('frontend.master')
@section('content')
<div class="container">
    <h1>{{ $category->name }} Posts</h1>
 <!-- Display Posts -->
    <div class="row pb-3">
        @foreach ($posts as $post)
            <div class="col-lg-4 mb-4">
                <div class="card border-0 mb-2">
                    <?php $carouselId = 'postImagesCarousel' . $post->id; ?>
                    <div id="{{ $carouselId }}" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($post->images as $index => $image)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" style="width: 100%;height: 200px;object-fit: cover;">
                                    <img src="{{ $image->url }}" class="d-block w-100" alt="Image">
                                </div>
                            @endforeach
                        </div>
                        @if ($post->images->count() > 1)
                            <a class="carousel-control-prev" href="#{{ $carouselId }}" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#{{ $carouselId }}" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        @endif
                    </div>
                    <div class="card-body bg-light p-4">
                        <h4 class="card-title text-truncate">{{ $post->name }}</h4>

                        <!-- Category Section -->
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <h5 class="font-weight-bold mb-0 mr-2"><i class="fa fa-folder text-muted"></i> Category:</h5>
                                <span>{{ $post->catagory ? $post->catagory->name : 'No Category' }}</span>
                            </div>
                        </div>

                        <!-- Breed Section -->
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <h5 class="font-weight-bold mb-0 mr-2"><i class="fa fa-paw text-muted"></i> Breed:</h5>
                                <span>{{ $post->breed ? $post->breed->name : 'No Breed' }}</span>
                            </div>
                        </div>

                        <!-- Age Section -->
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <h5 class="font-weight-bold mb-0 mr-2"><i class="fa fa-clock text-muted"></i> Age:</h5>
                                <span>{{ $post->age }} months</span>
                            </div>
                        </div>
                        <a class="font-weight-bold" href="{{ route('blog.readmore', $post->id) }}">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection