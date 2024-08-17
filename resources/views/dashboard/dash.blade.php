@extends('dashboard.master')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <img src="\backend\dashboard.jpg" alt="Profile Photo"  style="width: 1080px; height: 350px;">
            <div class="container mt-4">
                <div class="container mt-4">
                    <div class="row">
                        <!-- Summary Cards -->
                        <div class="col-md-12 d-flex justify-content-between">
                            <div class="account-card mb-3" style="width: 23%; height: 200px;">
                                <div class="account-card-header d-flex align-items-center">
                                    <i class="fas fa-file-alt mr-2"></i>
                                    <span>Total Posts</span>
                                </div>
                                <div class="account-card-body">
                                    <h5 class="card-title">{{ $totalPosts }}</h5>
                                </div>
                            </div>
                            
                            <div class="account-card mb-3" style="width: 23%; height: 200px;">
                                <div class="account-card-header d-flex align-items-center">
                                    <i class="fas fa-box mr-2"></i>
                                    <span>Total Accessories</span>
                                </div>
                                <div class="account-card-body">
                                    <h5 class="card-title">{{ $totalPosts }}</h5>
                                </div>
                            </div>
                            <div class="account-card mb-3" style="width: 23%; height: 200px;">
                                <div class="account-card-header d-flex align-items-center">
                                    <i class="fas fa-box mr-2"></i>
                                    <span>Total Accessories</span>
                                </div>
                                <div class="account-card-body">
                                    <h5 class="card-title">{{ $totalPosts }}</h5>
                                </div>
                            </div>
                            
                            <div class="account-card mb-3" style="width: 23%; height: 200px;">
                                <div class="account-card-header d-flex align-items-center">
                                    <i class="fas fa-users mr-2"></i>
                                    <span>Logined Users</span>
                                </div>
                                <div class="account-card-body">
                                    <h5 class="card-title">{{ $activeUsers }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            
                <!-- Recent Posts -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <h3 class="mb-3">Recent Posts</h3>
                        <div class="list-group">
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
                </div>
            </div>
            
            
            
            
    </main>
@endsection
