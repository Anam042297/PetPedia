@extends('frontend.master')

@section('content')
    <h1>Your Orders</h1>

    @foreach ($orders as $order)
        <div class="order">
            <h2>Order #{{ $order->id }} ({{ $order->status }})</h2>
            <p>Address: {{ $order->address }}</p>
            <ul>
                @foreach ($order->orderItems as $item)
                    <li>{{ $item->petProduct->name }} - Quantity: {{ $item->quantity }} - Serial: {{ $item->serial_number }}</li>
                @endforeach
            </ul>
            
            @if ($order->status == 'pending')
                <form action="{{ route('orders.receive', $order->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Mark as Received</button>
                </form>
                <form action="{{ route('orders.cancel', $order->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Cancel Order</button>
                </form>
            @endif
        </div>
    @endforeach

@endsection
