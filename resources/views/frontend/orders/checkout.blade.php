{{-- @extends('frontend.master')

@section('content')
<div class="wrapper">
    <div class="container">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <form method="POST" action="{{ route('checkout') }}">
            @csrf
            <h1>
                <i class="fas fa-shipping-fast"></i>
                Shipping Details
            </h1>
            <div class="name">
                <div>
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
            
                <div> 
                    <label for="city">City</label>
                    <input type="text" id="city" name="city" required>
                </div>
                <div>
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" required>
                </div>
                <div>
                    <label for="phone_no">Phone Number</label>
                    <input type="text" id="phone_no" name="phone_no" required>
                </div>
               
            <h1>
                <i class="far fa-credit-card"></i>
                Payment Information
            </h1>
            <div class="cc-info">
                <div>
                    <label for="payment_method">Payment Method</label>
                    <select id="payment_method" name="payment_method" required>
                        <option value="cash">Cash on Delivery</option>
                    </select>
                </div>
                <!-- You can add more payment fields here if needed -->
            </div>
            <div class="btns">
                <button type="submit">Place Order</button>
                {{-- <a href="{{ route('cart') }}" class="btn">Back to Cart</a> --}}
            {{-- </div> --}}
        {{-- </form>
    </div>
</div>
@endsection --}} 
@extends('frontend.master')

@section('content')
<div class="wrapper">
    <div class="container">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('checkout') }}">
            @csrf
            <h1>
                <i class="fas fa-shipping-fast"></i>
                Shipping Details
            </h1>

            <div class="name">
                <div>
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Enter your full name">
                </div>

                <div>
                    <label for="city">City</label>
                    <input type="text" id="city" name="city" value="{{ old('city') }}" required placeholder="Enter your city">
                </div>

                <div>
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" value="{{ old('address') }}" required placeholder="Enter your address">
                </div>

                <div>
                    <label for="phone_no">Phone Number</label>
                    <input type="text" id="phone_no" name="phone_no" value="{{ old('phone_no') }}" required placeholder="Enter your phone number" pattern="[0-9]+" minlength="10" maxlength="15">
                </div>
            </div>

            <h1>
                <i class="far fa-credit-card"></i>
                Payment Information
            </h1>

            <div class="cc-info">
                <div>
                    <label for="payment_method">Payment Method</label>
                    <select id="payment_method" name="payment_method" required>
                        <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash on Delivery</option>
                        <!-- You can add more payment options here if necessary -->
                    </select>
                </div>
            </div>

            <div class="btns">
                <button type="submit" class="btn btn-primary">Place Order</button>
                {{-- <a href="{{ route('cart') }}" class="btn btn-secondary">Back to Cart</a> --}}
            </div>
        </form>
    </div>
</div>
@endsection
