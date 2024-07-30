@extends('frontend.master')
@section('content')
    <div class="search-container">
        <input type="text" class="search-input" placeholder="Search...">
        <button type="submit" class="search-button">Search</button>
    </div>

    <!-- Blog Start -->
    <div class="container">
        <h1 style="text-align: center; margin: 20px 0;">Blog Posts</h1>
        <div class="row pb-3">
            @foreach ($posts as $post)
                <div class="col-lg-4 mb-4">
                    <div class="card border-0 mb-2">
                        <?php $carouselId = 'postImagesCarousel' . $post->id; ?>
                        <div id="{{ $carouselId }}" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($post->images as $index => $image)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" style=" width: 100%;height: 200px;object-fit: cover;">
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

                            {{-- <p class="card-text">{{ $post->description }}</p> --}}

                            <a class="font-weight-bold" href="{{ route('blog.readmore', $post->id) }}">View Details</a>
                        </div>



                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="container pt-5">
        {{-- <div class="d-flex flex-column text-center mb-5 pt-5">
            <h4 class="text-secondary mb-3">Pet Blog</h4>
            <h1 class="display-4 m-0"><span class="text-primary">Updates</span> From Blog</h1>
        </div>
        <h1>Community Discussions</h1>

        <form action="/threads" method="POST">
            @csrf
            <button type="submit">Create Thread</button>
        </form>

        @foreach ($threads as $thread)
            <div>
                <h2>{{ $thread->title }}</h2>
                <small>Started by {{ $thread->user->name }}</small>

                <form action="{{ route('threads.destroy', $thread) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete Thread</button>
                </form>

                <form action="{{ route('communityposts.store', $thread) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <textarea name="message" placeholder="Share something..." required></textarea>
                    </div>
                    <div>
                        <input type="file" name="image" accept="image/*">
                    </div>
                    <button type="submit">Post</button>
                </form>

                @foreach ($thread->posts as $post)
                    <div>
                        <p>{{ $post->message }}</p>
                        @if ($post->image_path)
                            <img src="{{ asset('storage/' . $post->image_path) }}" alt="Post Image">
                        @endif
                        <small>Posted by {{ $post->user->name }}</small>

                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete Post</button>
                        </form>

                        <form action="{{ route('replies.store', $post) }}" method="POST">
                            @csrf
                            <div>
                                <textarea name="message" placeholder="Reply..." required></textarea>
                            </div>
                            <button type="submit">Reply</button>
                        </form>

                        @foreach ($post->replies as $reply)
                            <div>
                                <p>{{ $reply->message }}</p>
                                <small>Replied by {{ $reply->user->name }}</small>

                                <form action="{{ route('replies.destroy', $reply) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete Reply</button>
                                </form>
                            </div>
                        @endforeach

                        <form action="{{ route('reactions.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <button type="submit" name="type" value="like">Like</button>
                        </form>

                        @foreach ($post->reactions as $reaction)
                            <small>{{ $reaction->user->name }} reacted with {{ $reaction->type }}</small>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @endforeach

        {{ $threads->links() }} --}}

        <div class="row pb-3">
            <div class="col-lg-12">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center mb-4">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo; Previous</span>
                            </a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">Next &raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- Blog End -->
@endsection
