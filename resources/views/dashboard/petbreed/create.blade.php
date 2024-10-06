
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
                        <h3>{{ isset($breed) ? 'Edit Breeed' : 'Create Breed' }}</h3>
                    </h3>
                </div>
                <div class="account-card-body">
                    
                    <form id="contactForm" action="{{ isset($breed) ? route('breed.update', $breed->id) : route('breed.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($breed))
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="catagory">Select Category</label>
                            <select class="form-control" id="category" name="category_id">
                                <option value="">Select category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ isset($breed) && $breed->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="text-danger">
                                @error('category_id')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="name">Breed Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ isset($breed) ? $breed->name : old('name') }}">
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        @if (empty($breed->id))
                        <div class="form-group">
                            <a href="{{ route('Category.create') }}" style="color: white;">Create Category</a>&nbsp;|&nbsp;
                            <a href="{{ route('post.create') }}" style="color: white;">Create Post</a>
                        </div>
                        @endif

                        <button type="submit" class="custom-btn">
                            {{ isset($breed) ? 'Update' : 'Submit' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
