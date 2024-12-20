@extends('userside.master')
@section('title', 'Shopping Cart')

@section('content')
    <section class="h-100 h-custom" style="background: linear-gradient(to right, #ff99b6, #af99ff);">
        {{-- style=" color:white;background: linear-gradient(135deg, #ff99b6, #af99ff) --}}
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    <div class="card card-registration card-registration-2" style="border-radius: 15px; background-color:#f3e8ff;">
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
                                            <div class="card mb-3">
                                                <div class="row g-0">
                                                    <div class="col-md-4">
                                                        @php
                                                            $image = $item->product->productImages->isNotEmpty()
                                                                ? $item->product->productImages->first()->image_path
                                                                : 'images/placeholder.png';
                                                        @endphp
                                                        <img src="{{ asset($image) }}" class="img-fluid rounded-start"
                                                            alt="{{ $item->product->name }}">
                                                    </div>

                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $item->product->name }}</h5>
                                                        
                                                            <p class="card-text">
                                                                Total Price:
                                                                <span id="total-price-{{ $item->id }}">
                                                                    {{ number_format($item->product->price) }}
                                                                </span>
                                                            </p>

                                                           
                                                            <div class="d-flex align-items-center gap-2">
                                                                <!-- Increase Quantity Form -->
                                                                <form action="{{ route('cart.increase', $item->id) }}" method="POST" class="d-inline-flex">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-sm">
                                                                        <i class="fas fa-plus"></i>
                                                                    </button>
                                                                </form>
                                                            
                                                                <!-- Quantity Display -->
                                                                <input min="1" name="quantity" value="{{ $item->quantity }}" type="number" class="form-control form-control-sm mx-2" disabled />
                                                            
                                                                <!-- Decrease Quantity Form -->
                                                                <form action="{{ route('cart.decrease', $item->id) }}" method="POST" class="d-inline-flex">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-sm">
                                                                        <i class="fas fa-minus"></i>
                                                                    </button>
                                                                </form>
                                                            
                                                                <!-- Remove Item Form -->
                                                            
                                                                <form action="{{ route('cart.remove', $item->id) }}" method="POST" class="d-inline-flex">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-sm mx-2">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                                
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                             
                                <div class="col-lg-4 bg-body-tertiary">
                                    <div class="p-5">
                                        <h5 class="text-uppercase">Items {{ count($cartItems) }}</h5>
                                        <h5>{{ number_format($cartTotal, 2) }}</h5>

                                        <a href="{{ route('checkout.form') }}"
                                            class="btn btn-dark btn-block btn-lg {{ count($cartItems) == 0 ? 'disabled' : '' }}">
                                            Checkout
                                        </a>
                                        <div class="pt-5">
                                            {{-- <h6 class="mb-0">
                                       <a href="{{ route('mart') }}" class="text-body">
                                                    <i class="fas fa-long-arrow-alt-left me-2"></i>Back to Mart </a>
                                            </h6> --}}
                                        </div> 
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
