@extends('dashboard.master')
@section('content')


<div class="container">
    <img src="\backend\dashboard.jpg" alt="Profile Photo" style="width: 1080px; height: 375px;">
    <div class="row">
        <div class="d-flex justify-content-between">
           
             <div class="account-card  "role="button">
                <a href="{{ route('post.index') }}"style="color: white;">
                <div class="account-card-header p-1" style="border-bottom: 1px solid #ddd;">
                    <i class="fas fa-paw"></i>
                        <span>Total Posts</span>
                </div>
                <div class="account-card-body">
                    <h5 class="card-title mb-0">{{ $totalPosts }}</h5>
                </div>
            </a>
            </div>
            <div class="account-card "role="button">
                <a href="{{ route('products.index') }}"style="color: white;">
                <div class="account-card-header p-1" style="border-bottom: 1px solid #ddd;">
                        <i class="fas fa-drumstick-bite"></i>
                        <span>Total Products</span>
                </div>
                <div class="account-card-body">
                    <h5 class="card-title mb-0">{{  $totalProducts  }}</h5>
                </div> </a>
            </div>
            <div class="account-card "role="button">
                <a href="{{ route('usertable') }}"style="color: white;">
                <div class="account-card-header p-1" style="border-bottom: 1px solid #ddd;">
                    <i class="fas fa-paw"></i>
                        <span>Active Users</span>
                </div>
                <div class="account-card-body">
                    <h5 class="card-title mb-0">{{ $activeUsersCount }}</h5>
                </div> </a>
            </div>
        
            <div class="account-card "role="button">
                <a href="#pending-orders"style="color: white;">
                <div class="account-card-header p-1" style="border-bottom: 1px solid #ddd;">
                    <i class="fas fa-list-ul "></i>
                        <span>Pending Orders</span>
                </div>
                <div class="account-card-body">
                    <h5 class="card-title mb-0">{{  $pendingOrdersCount  }}</h5>
                </div> </a>
            </div>
            <div class="account-card "role="button">
                <a href="{{ route('usertable') }}"style="color: white;">
                    <div class="account-card-header p-1" style="border-bottom: 1px solid #ddd;">
                    <i class="fas fa-users "></i>
                    <span>Total Users</span>
                </div>
                <div class="account-card-body">
                    <h5 class="card-title mb-0">{{ $Users }}</h5>
                </div>
            </a>
                
            </div>

        </div>
    </div>
</div>
                {{-- <div class="container" id="pending-orders">
                    <h2>Pending Orders</h2>
                
                    <div class="table-container">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>User ID</th>
                                    <th>Status</th>
                                    <th>Ordered At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendingOrders as $index => $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->user_id }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> --}}
                <style>
                    .table-container {
    max-height: 200px; /* Set the maximum height for the table */
    overflow-y: auto; /* Enables vertical scrolling for the container */
}



                </style>
               <div class="container" id="pending-orders">
                <h2>Pending Orders</h2>
                <div class="table-container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>User ID</th>
                        <th>Status</th>
                        <th>Ordered At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendingOrders as $index => $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user_id }}</td>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
                </div>
                
            
                
                <div class="container" id="active-users">
                    <h2>Active Users</h2>
                
                    <div class="table-container">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Joined At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activeUsers as $index => $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at->format('Y-m-d H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
              
@endsection
