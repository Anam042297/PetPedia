@extends('frontend.master')

@section('content')
<div class="container">
    <h1>My Orders</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Address</th>
                <th>Status</th>
                <th>Items</th>
                <th>Total Quantity</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>
                        <ul>
                            @foreach ($order->orderItems as $item)
                                <li>
                                    Product: {{ $item->product->name }}<br>
                                    Quantity: {{ $item->quantity }}<br>
                                    Serial Number: {{ $item->serial_number }}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $order->orderItems->sum('quantity') }}</td>
                    <td>${{ $order->orderItems->sum(function($item) {
                        return $item->quantity * $item->product->price;
                    }) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">You have no orders.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
