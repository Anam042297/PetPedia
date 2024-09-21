@extends('frontend.master')

@section('content')
<div class="wrapper">
    <div class="container">
        <form method="POST" action="{{ route('checkout') }}">
            @csrf
            <h1>
                <i class="fas fa-shipping-fast"></i>
                Shipping Details
            </h1>
            <div class="name">
                <div>
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" required>
                </div>
              
            </div>
            <div class="address-info">
            
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
            </div>
        </form>
    </div>
</div>
@endsection
