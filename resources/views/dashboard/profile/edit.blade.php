@extends('dashboard.master')
@section('content')

<div class="container mt-5">
    <div class="row">
        <!-- Image Column -->
        <div class="col-md-3 d-flex align-items-center">
            <img src="\backend\hello.jpg" alt="Edit Photo" style="width: 400px; height: 450px; margin-right: 20px;">
        </div>
        <!-- Form Column -->
        <div class="col-md-9">
            <div class="account-card">
                <div class="account-card-header d-flex align-items-center justify-content-center">
                    <img src="\backend\edit.jpg" alt="Profile Photo" style="width: 80px; height: 80px; margin-right: 20px;">
                    <h3 style="color: #fcfcfc; margin: 0;">
                        Edit Profile
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
                    <form id="adminForm" action="{{ route('admin.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $admin->name) }}" required>
                                <span class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $admin->email) }}" required>
                                <span class="text-danger">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password">Password (If you do not want to change make it empty)</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank if you don't want to change">
                            <span class="text-danger">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">Confirm Password</label>
                            <input id="password-confirm" class="form-control" type="password" placeholder="Confirm Password" name="password_confirmation"/>
                            <span class="text-danger">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <button type="submit" class="custom-btn">
                            Update Profile
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section("script")
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    // Check for success message
    @if (session('success'))
        toastr.success('{{ session('success') }}');
    @endif

    // Check for error message
    @if (session('error'))
        toastr.error('{{ session('error') }}');
    @endif
</script>
    
@endsection