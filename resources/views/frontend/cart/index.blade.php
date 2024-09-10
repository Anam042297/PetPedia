@extends('frontend.master')

@section('title', 'Shopping Cart')

@section('content')
<section class="h-100 h-custom" style="background-color: #d2c9ff;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-lg-8">
                                <div class="p-5">
                                    <div class="d-flex justify-content-between align-items-center mb-5">
                                        <h1 class="fw-bold mb-0">Cart Items</h1>
                                        <h6 class="mb-0 text-muted">{{ count($cartItems) }} item(s)</h6>
                                    </div>
                                    <hr class="my-4">

                                    @foreach ($cartItems as $item)
                                    <div class="row mb-4 d-flex justify-content-between align-items-center">
                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                            <img src="{{ asset($item->product->images->first()->image_path ?? 'images/placeholder.png') }}" class="img-fluid rounded-3" alt="{{ $item->product->name }}">
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <h5 class="fw-bold mb-0">Pet Category</h5>
                                            <h6 class="text-muted">{{ $item->product->category->name }}</h6>
                                            <h6 class="mb-0">{{ $item->product->name }}</h6>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                <i class="fas fa-minus"></i>
                                            </button>

                                            <input id="form1" min="1" name="quantity" value="{{ $item->quantity }}" type="number" class="form-control form-control-sm" />

                                            <button data-mdb-button-init data-mdb-ripple-init class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                            <h6 class="mb-0">${{ number_format($item->product->price, 2) }}</h6>
                                        </div>
                                        <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                            <a href="{{ route('cart.remove', $item->id) }}" class="text-muted"><i class="fas fa-times"></i></a>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    @endforeach

                                    <div class="pt-5">
                                        <h6 class="mb-0"><a href="{{ route('mart') }}" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 bg-body-tertiary">
                                <div class="p-5">
                                
                                    <hr class="my-4">
                                        <h5 class="text-uppercase">Items {{ count($cartItems) }}</h5>
                                        <h5>${{ number_format($cartTotal, 2) }}</h5>
                                    </div>
                                    <form method="POST" action="{{ route('checkout') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="address">Shipping Address</label>
                                            <input type="text" class="form-control" id="address" name="address" required>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-dark btn-block btn-lg">Checkout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
