@extends('userside.master')

@section('content')
<div class="wrapper d-flex justify-content-center py-5">
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

        <div class="card shadow-lg border-0 rounded-3 p-4">
            <form method="POST" action="{{ route('checkout') }}">
                @csrf
                <h2 class="mb-4 text-center text-primary">
                    <i class="fas fa-shipping-fast me-2"></i>Shipping Details
                </h2>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control" required placeholder="Enter your full name">
                    </div>

                    <div class="col-md-6">
                        <label for="city" class="form-label">City</label>
                        <input type="text" id="city" name="city" value="{{ old('city') }}" class="form-control" required placeholder="Enter your city">
                    </div>

                    <div class="col-md-12">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" id="address" name="address" value="{{ old('address') }}" class="form-control" required placeholder="Enter your address">
                    </div>

                    <div class="col-md-12">
                        <label for="phone_no" class="form-label">Phone Number</label>
                        <input type="text" id="phone_no" name="phone_no" value="{{ old('phone_no') }}" class="form-control" required placeholder="Enter your phone number" pattern="[0-9]+" minlength="10" maxlength="15">
                    </div>
                </div>
              

                <div class="mb-3">
                    <label for="payment_method" class="form-label">Payment Method</label>
                    <select id="payment_method" name="payment_method" class="form-select" required>
                    <option value="cash" {{ old('payment_method', 'cash') == 'cash' ? 'selected' : '' }}>Cash on Delivery</option>
                    </select>
                </div>
                

                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary btn-lg px-5">Place Order</button>
                </div>
            </form>
        </div>
  
    </div>
</div>

<style>
    .wrapper {
        background-color: #f7f9fb;
    }
    .card {
        max-width: 600px;
        margin: 0 auto;
        padding: 2rem;
        border-radius: 15px;
    }
    .form-label {
        font-weight: 600;
    }
    .btn-primary {
        background-color: #007bff;
        border: none;
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>
@endsection
