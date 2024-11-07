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
                        Login
                    </h3>
                </div>

                <div class="account-card-body">
                    @if (session('error'))
                        <div class="alert alert-danger" style="margin-bottom: 20px;">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success" style="margin-bottom: 20px;">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form id="adminForm" action="{{ route('form.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="email" style="color: white">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                            <span class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="password" style="color: white">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="password">
                            <span class="text-danger">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <label style="color: white">Not Registered yet</label>
                            <a href="{{route('register')}}" style="color: white"> Register Now</a>
                        </div>

                        <button type="submit" class="custom-btn">
                            Login
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

