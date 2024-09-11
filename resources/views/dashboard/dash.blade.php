@extends('dashboard.master')
@section('content')
<img src="\backend\dashboard.jpg" alt="Profile Photo" style="width: 1080px; height: 350px;">

<div class="container mt-4">
    <div class="row">
        <div class="d-flex justify-content-between">
           
             <div class="account-card ">
                <div class="account-card-header p-1" style="border-bottom: 1px solid #ddd;">
                    <i class="fas fa-paw"></i>
                        <span>Total Posts</span>
                </div>
                <div class="account-card-body">
                    <h5 class="card-title mb-0">{{ $totalPosts }}</h5>
                </div>
            </div>
            <div class="account-card ">
                <div class="account-card-header p-1" style="border-bottom: 1px solid #ddd;">
                    <i class="fas fa-paw"></i>
                        <span>Total Posts</span>
                </div>
                <div class="account-card-body">
                    <h5 class="card-title mb-0">{{ $totalPosts }}</h5>
                </div>
            </div>
        
            <div class="account-card ">
                <div class="account-card-header p-1" style="border-bottom: 1px solid #ddd;">
                    <i class="fas fa-list-ul "></i>
                        <span>Total Orders</span>
                </div>
                <div class="account-card-body">
                    <h5 class="card-title mb-0">{{  $totalPosts  }}</h5>
                </div>
            </div>
            <div class="account-card ">
                <div class="account-card-header p-1" style="border-bottom: 1px solid #ddd;">
                        <i class="fas fa-drumstick-bite"></i>
                        <span>Total Products</span>
                </div>
                <div class="account-card-body">
                    <h5 class="card-title mb-0">{{  $totalPosts  }}</h5>
                </div>
            </div>
            <div class="account-card ">
                <div class="account-card-header p-1" style="border-bottom: 1px solid #ddd;">
                        <i class="fas fa-users "></i>
                        <span>Total Users</span>
                </div>
                <div class="account-card-body">
                    <h5 class="card-title mb-0">{{ $activeUsers }}</h5>
                </div>
            </div>

        </div>
    </div>
</div>
          
            
                {{-- <!-- Recent Posts -->
                <div class="row mt-4">
                    <div class="col-md-6" >
                        <h3 class="mb-3">Recent Posts</h3>
                        <div class="list-group" >
                            @foreach ($recentPosts as $post)
                                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    {{ $post->name }}
                                    <span class="badge badge-primary badge-pill">{{ $post->created_at->format('d M Y') }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
            
                    <div class="col-md-6">
                        <h3 class="mb-3">Recent Food Items</h3>
                        <div class="list-group">
                            @foreach ($recentPosts as $post)
                                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    {{ $post->name }}
                                    <span class="badge badge-primary badge-pill">{{ $post->created_at->format('d M Y') }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            
                <!-- Recent Accessories -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <h3 class="mb-3">Recent Accessories</h3>
                        <div class="list-group">
                            @foreach ($recentPosts as $post)
                                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    {{ $post->name }}
                                    <span class="badge badge-primary badge-pill">{{ $post->created_at->format('d M Y') }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div> --}}
@endsection
