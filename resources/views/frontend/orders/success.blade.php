
@extends('frontend.master')

@section('title', 'Order Success')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-body text-center">
                    <h1>Thank you for your order!</h1>
                    <p>Your order has been placed successfully.</p>
                    <a href="{{ route('mart') }}" class="btn btn-primary">Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
