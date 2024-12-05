@extends('userside.master')
@section('title', 'Order Success')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-body text-center">
                    <h1>Thank you for your order!</h1>
                    <p>A confirmation email with your order details is on its way.</p>
                    <a href="{{ route('home') }}" class="btn btn-primary">Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
