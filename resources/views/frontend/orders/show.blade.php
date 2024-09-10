@extends('frontend.master')

@section('content')
    <h1>Order Details</h1>
    <p>Order ID: {{ $order->id }}</p>
    <p>Date: {{ $order->created_at->format('Y-m-d H:i:s') }}</p>
    <p>Status: {{ $order->status }}</p>
    <p>Address: {{ $order->address }}</p>

    <h2>Items</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Serial Number</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->petProduct->name ?? 'Unknown Product' }}</td>
                    <td>{{ $item->serial_number }}</td>
                    <td>{{ $item->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
