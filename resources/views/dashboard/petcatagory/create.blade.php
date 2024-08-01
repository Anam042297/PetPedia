@extends('dashboard.master')
@section('content')
    <div class="login-container"  style="background: linear-gradient(to right, #fff3f3, #fff3f3)">
        <div>
            <h3 style="color:#af99ff ;text-align:center">
                {{ isset($category) ? 'Edit Category' : 'Create Category' }}
            </h3>
        </div>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form id="contactForm" action="{{ isset($category) ? route('Catagory.update', $category->id) : route('Catagory.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($category))
                @method('PUT')
            @endif
            <div class="form-group">
                <label for="exampleFormControlSelect1">
                    Category Name
                </label>
                <input type="text" class="form-control" id="name" name="name" value="{{ isset($category) ? $category->name : old('name') }}">
                <span class="text-danger">
                    @error('name')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <button type="submit" class="btn btn-primary">
                {{ isset($category) ? 'Update' : 'Submit' }}
            </button>
        </form>
    </div>
@endsection
