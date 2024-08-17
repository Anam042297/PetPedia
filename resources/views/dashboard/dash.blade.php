@extends('dashboard.master')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            {{-- <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Primary Card</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Warning Card</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Success Card</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Danger Card</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="#">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Area Chart Example
                        </div>
                        <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-bar me-1"></i>
                            Bar Chart Example
                        </div>
                        <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                    </div>
                </div>
            </div> --}}
            <img src="\backend\dash.png" alt="Profile Photo"  style="width: 150px; height: 150px;">
            <div class="container mt-4">
                <div class="row">
                    <!-- Summary Cards -->
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card bg-primary text-white mb-3">
                                    <div class="card-header d-flex align-items-center">
                                        <i class="fas fa-file-alt card-icon mr-2"></i>
                                        <span>Total Posts</span>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $totalPosts }}</h5>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="card bg-success text-white mb-3">
                                    <div class="card-header d-flex align-items-center">
                                        <i class="fas fa-canned-food card-icon mr-2"></i>
                                        <span>Total Food Items</span>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $totalPosts }}</h5>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="card bg-warning text-white mb-3">
                                    <div class="card-header d-flex align-items-center">
                                        <i class="fas fa-box card-icon mr-2"></i>
                                        <span>Total Accessories</span>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $totalPosts }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-danger text-white mb-3">
                                    <div class="card-header d-flex align-items-center">
                                        <i class="fas fa-users card-icon mr-2"></i>
                                        <span>Active Users</span>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $activeUsers }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Recent Posts -->
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
                </div>
                <!-- Recent Food Items and Accessories -->
                <div class="row mt-4">
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
