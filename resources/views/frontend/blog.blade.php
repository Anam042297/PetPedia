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
                        @if ($post->images->isNotEmpty())
                        <img class="card-img-top" src="{{ asset('storage/app/public/images'.$post->images->first()->path) }}" alt="{{ $post->name }}">
                        @else
                        <img class="card-img-top" src="img/default-image.jpg" alt="No Image Available">
                        @endif
                        <div class="card-body bg-light p-4">
                            <h4 class="card-title text-truncate">{{ $post->name }}</h4>
                            <div class="d-flex mb-3">
                                <small class="mr-2"><i class="fa fa-folder text-muted"></i> {{ $post->catagory ? $post->catagory->name : 'No Category' }}</small>
                                <small class="mr-2"><i class="fa fa-paw text-muted"></i> {{ $post->breed ? $post->breed->name : 'No Breed' }}</small>
                                <small class="mr-2"><i class="fa fa-clock text-muted"></i> {{ $post->age }} months</small>
                            </div>
                            <p class="card-text">{{ $post->description }}</p>
                            <a class="font-weight-bold" href="">Read More</a>
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
            <div class="col-lg-4 mb-4">
                <div class="card border-0 mb-2">
                    <img class="card-img-top" src="img/blog-1.jpg" alt="">
                    <div class="card-body bg-light p-4">
                        <h4 class="card-title text-truncate">Diam amet eos at no eos</h4>
                        <div class="d-flex mb-3">
                            <small class="mr-2"><i class="fa fa-user text-muted"></i> Admin</small>
                            <small class="mr-2"><i class="fa fa-folder text-muted"></i> Web Design</small>
                            <small class="mr-2"><i class="fa fa-comments text-muted"></i> 15</small>
                        </div>
                        <p>Diam amet eos at no eos sit lorem, amet rebum ipsum clita stet, diam sea est diam eos, rebum sit
                            vero stet justo</p>
                        <a class="font-weight-bold" href="">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card border-0 mb-2">
                    <img class="card-img-top" src="img/blog-2.jpg" alt="">
                    <div class="card-body bg-light p-4">
                        <h4 class="card-title text-truncate">Diam amet eos at no eos</h4>
                        <div class="d-flex mb-3">
                            <small class="mr-2"><i class="fa fa-user text-muted"></i> Admin</small>
                            <small class="mr-2"><i class="fa fa-folder text-muted"></i> Web Design</small>
                            <small class="mr-2"><i class="fa fa-comments text-muted"></i> 15</small>
                        </div>
                        <p>Diam amet eos at no eos sit lorem, amet rebum ipsum clita stet, diam sea est diam eos, rebum sit
                            vero stet justo</p>
                        <a class="font-weight-bold" href="">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card border-0 mb-2">
                    <img class="card-img-top" src="img/blog-3.jpg" alt="">
                    <div class="card-body bg-light p-4">
                        <h4 class="card-title text-truncate">Diam amet eos at no eos</h4>
                        <div class="d-flex mb-3">
                            <small class="mr-2"><i class="fa fa-user text-muted"></i> Admin</small>
                            <small class="mr-2"><i class="fa fa-folder text-muted"></i> Web Design</small>
                            <small class="mr-2"><i class="fa fa-comments text-muted"></i> 15</small>
                        </div>
                        <p>Diam amet eos at no eos sit lorem, amet rebum ipsum clita stet, diam sea est diam eos, rebum sit
                            vero stet justo</p>
                        <a class="font-weight-bold" href="">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card border-0 mb-2">
                    <img class="card-img-top" src="img/blog-2.jpg" alt="">
                    <div class="card-body bg-light p-4">
                        <h4 class="card-title text-truncate">Diam amet eos at no eos</h4>
                        <div class="d-flex mb-3">
                            <small class="mr-2"><i class="fa fa-user text-muted"></i> Admin</small>
                            <small class="mr-2"><i class="fa fa-folder text-muted"></i> Web Design</small>
                            <small class="mr-2"><i class="fa fa-comments text-muted"></i> 15</small>
                        </div>
                        <p>Diam amet eos at no eos sit lorem, amet rebum ipsum clita stet, diam sea est diam eos, rebum sit
                            vero stet justo</p>
                        <a class="font-weight-bold" href="">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card border-0 mb-2">
                    <img class="card-img-top" src="img/blog-3.jpg" alt="">
                    <div class="card-body bg-light p-4">
                        <h4 class="card-title text-truncate">Diam amet eos at no eos</h4>
                        <div class="d-flex mb-3">
                            <small class="mr-2"><i class="fa fa-user text-muted"></i> Admin</small>
                            <small class="mr-2"><i class="fa fa-folder text-muted"></i> Web Design</small>
                            <small class="mr-2"><i class="fa fa-comments text-muted"></i> 15</small>
                        </div>
                        <p>Diam amet eos at no eos sit lorem, amet rebum ipsum clita stet, diam sea est diam eos, rebum sit
                            vero stet justo</p>
                        <a class="font-weight-bold" href="">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card border-0 mb-2">
                    <img class="card-img-top" src="img/blog-1.jpg" alt="">
                    <div class="card-body bg-light p-4">
                        <h4 class="card-title text-truncate">Diam amet eos at no eos</h4>
                        <div class="d-flex mb-3">
                            <small class="mr-2"><i class="fa fa-user text-muted"></i> Admin</small>
                            <small class="mr-2"><i class="fa fa-folder text-muted"></i> Web Design</small>
                            <small class="mr-2"><i class="fa fa-comments text-muted"></i> 15</small>
                        </div>
                        <p>Diam amet eos at no eos sit lorem, amet rebum ipsum clita stet, diam sea est diam eos, rebum sit
                            vero stet justo</p>
                        <a class="font-weight-bold" href="">Read More</a>
                    </div>
                </div>
            </div>
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
