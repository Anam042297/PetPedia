@extends('dashboard.master')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="account-card">
                <div class="account-card-header d-flex align-items-center justify-content-center">
                    <img src="{{ asset('backend/edit.jpg') }}" alt="Profile Photo" style="width: 80px; height: 80px; margin-right: 20px;">
                    <h3 style="color: #fcfcfc; margin: 0;">Update Order Status</h3>
                </div>
                <div class="account-card-body mt-4">
                    <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="status" style="color: #fcfcfc;">Order Status:</label>
                            <select name="status" id="status" class="form-control">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="completed" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="canceled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Canceled</option>
                            </select>
                        </div>
                        <div class="form-group text-center mt-3">
                            <button type="submit" class="btn custom-btn">Update Status</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection