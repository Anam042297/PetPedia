@extends('frontend.master')
@section('content')
    <div class="container py-5">
        <div class="row pt-5">
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
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <h5 class="font-weight-bold mb-0 mr-2"><i class="fa fa-folder text-muted"></i> Category:
                                </h5>
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

                        <p class="card-text">{{ $post->description }}</p>


                    </div>
                <!-- Back Button -->
                <a href="{{ route('blog') }}" class="btn btn-primary">Back to Blog Page</a>
            </div>
        </div>
    </div>
     <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
@endsection
