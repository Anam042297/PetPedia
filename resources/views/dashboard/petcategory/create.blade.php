@extends('dashboard.master')
@section('content')
<div class="container mt-5">
        <div class="col-md-8 offset-md-2">
            <div class="account-card">
                <div class="account-card-header d-flex align-items-center justify-content-center">
                    <img src="\backend\edit.jpg" alt="Edit Photo" style="width: 80px; height: 80px; margin-right: 20px;">
                    <h3 style="color: #fcfcfc; margin: 0;">
                        <h3>{{ isset($category) ? 'Edit Category' : 'Create Category' }}</h3>
                    </h3>
                </div>
                <div class="account-card-body">
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

                    <form id="contactForm" action="{{ isset($category) ? route('Category.update', $category->id) : route('Category.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($category))
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="name">
                                Category Name
                            </label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ isset($category) ? $category->name : old('name') }}">
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        {{-- {{dd($category->image)}} --}}
                        <div class="form-group">
                            @if (!empty($category->image))
                                {{-- Display existing image and option to change it --}}
                                {{-- <label for="image">Current Image</label>
                                <img src="{{ asset( $category->image) }}" style="max-width: 80px; max-height: 50px" alt="Category Image" class="img-fluid mb-2"> --}}
                                <label for="image">Change Image (optional)</label>
                                <input type="file" class="form-control" name="image" id="image">
                            @else
                                {{-- If no image, provide an option to upload a new one --}}
                                <label for="image">Choose Image</label>
                                <input type="file" class="form-control" name="image" id="image">
                            @endif
                            
                            <span class="text-danger">
                                @error('image')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        
                        

                        <button type="submit" class="custom-btn">
                            {{ isset($category) ? 'Update' : 'Submit' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
</div>


@endsection
