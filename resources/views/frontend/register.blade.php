@extends('userside.master')
@include('dashboard.includes.css')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="account-card">
                <div class="account-card-header d-flex align-items-center justify-content-center">
                    <img src="\backend\edit.jpg" alt="Profile Photo" style="width: 80px; height: 80px; margin-right: 20px;">
                    <h3 style="color: #fcfcfc; margin: 0;">
                        Register Now
                    </h3>
                </div>

                <div class="account-card-body">
                    <form name="sentMessage" id="contactForm" action="{{ route('user.store') }}" method="POST" novalidate="novalidate">
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name" style="color: white">Your Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" />
                                <span class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="email" style="color: white">Your Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" />
                                <span class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="pwd" style="color: white">Your Password</label>
                                <input type="password" class="form-control" id="pwd" name="password" placeholder="Your Password" />
                                <span class="text-danger">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="password-confirm" style="color: white">Confirm Password</label>
                                <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="Confirm Password" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label style="color: white">Already Registered </label>
                            <a href="{{route('login')}}" style="color: white"> Login Now</a>
                        </div>
                        <button type="submit" class="custom-btn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
