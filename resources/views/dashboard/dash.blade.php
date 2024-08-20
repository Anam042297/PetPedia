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
                            <div class="account-card mb-3">
                                <div class="account-card-header d-flex align-items-center justify-content-between p-2" style="border-bottom: 1px solid #ddd;">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-file-alt mr-2"></i>
                                        <span>Total Posts</span>
                                    </div>
                                </div>
                                <div class="account-card-body d-flex justify-content-center align-items-center" style="height: calc(100% - 40px);">
                                    <h5 class="card-title mb-0">{{ $totalPosts }}</h5>
                                </div>
                            </div>
                            
                            
                            <div class="account-card mb-3">
                                <div class="account-card-header d-flex align-items-center justify-content-between p-2" style="border-bottom: 1px solid #ddd;">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-file-alt mr-2"></i>
                                        <span>Total Accesories</span>
                                    </div>
                                </div>
                                <div class="account-card-body d-flex justify-content-center align-items-center" style="height: calc(100% - 40px);">
                                    <h5 class="card-title mb-0">{{ $totalPosts }}</h5>
                                </div>
                            </div>

                             <div class="account-card mb-3">
                                <div class="account-card-header d-flex align-items-center justify-content-between p-2" style="border-bottom: 1px solid #ddd;">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-file-alt mr-2"></i>
                                        <span>Total Food</span>
                                    </div>
                                </div>
                                <div class="account-card-body d-flex justify-content-center align-items-center" style="height: calc(100% - 40px);">
                                    <h5 class="card-title mb-0">{{ $totalPosts }}</h5>
                                </div>
                            </div>
                            
                            <div class="account-card mb-3">
                                <div class="account-card-header d-flex align-items-center justify-content-between p-2" style="border-bottom: 1px solid #ddd;">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-file-alt mr-2"></i>
                                        <span>Total Users</span>
                                    </div>
                                </div>
                                <div class="account-card-body d-flex justify-content-center align-items-center" style="height: calc(100% - 40px);">
                                    <h5 class="card-title mb-0">{{ $activeUsers }}</h5>
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
