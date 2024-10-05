@extends('dashboard.master')
@section('content')


<div class="container mt-5">
        <div class="col-md-8 offset-md-2">
            <div class="account-card">
                <div class="account-card-header d-flex align-items-center justify-content-center">
                    <img src="\backend\edit.jpg" alt="Edit Photo" style="width: 80px; height: 80px; margin-right: 20px;">
                    <h3 style="color: #fcfcfc; margin: 0;">
                        {{ isset($post) ? 'Edit Post' : 'Create Post' }}
                    </h3>
                </div>
                <div class="account-card-body">
                    <form id="contactForm" action="{{ isset($post) ? route('post.update', $post->id) : route('post.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($post))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">Select Category</label>
                                    <select class="form-control" id="category" name="category_id">
                                        <option value="">Select category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @if(isset($post) && $post->category_id == $category->id)
                                                    selected
                                                @endif>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    
                                    </select>
                                    <span class="text-danger">
                                        @error('category_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="breed">Select Breed</label>
                                    <select class="form-control" id="breed" name="breed_id">
                                        <option value="">Select breed</option>
                                        @foreach ($breeds as $breed)
                                            <option value="{{ $breed->id }}" {{ isset($post) && $post->breed_id == $breed->id ? 'selected' : '' }}>
                                                {{ $breed->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">
                                        @error('breed_id')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender">Select Gender</label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="">Select gender</option>
                                        <option value="male" {{ isset($post) && $post->gender == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ isset($post) && $post->gender == 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="unknown" {{ isset($post) && $post->gender == 'unknown' ? 'selected' : '' }}>Unknown</option>
                                    </select>
                                    <span class="text-danger">
                                        @error('gender')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="pet_name">Pet Name</label>
                                    <input type="text" class="form-control" id="pet_name" name="name" placeholder="Pet Name" value="{{ isset($post) ? $post->name : old('name') }}">
                                    <span class="text-danger">
                                        @error('name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="age">Pet Age (in months)</label>
                                    <input type="number" id="age" name="age" class="form-control" min="0" placeholder="Age" value="{{ isset($post) ? $post->age : old('age') }}">
                                    <span class="text-danger">
                                        @error('age')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                {{-- <div class="form-group">
                                    <label for="images">Choose images</label>
                                    <input type="file" class="form-control" name="images[]" id="images" multiple>
                                    <span class="text-danger">
                                        @error('images')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div> --}}
                                <div class="form-group">
                                    <label for="images">Update Images</label>
                                
                                    {{-- Show existing images --}}
                                    @if ($post->images->isNotEmpty())
                                        <div class="mb-3">
                                            <strong>Current Images:</strong>
                                            <div class="row">
                                                @foreach ($post->images as $image)
                                                    <div class="col-md-3">
                                                        <img src="{{ asset( $post->$image) }}" alt="Post Image" class="img-fluid mb-2">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                
                                    {{-- File input for uploading new images --}}
                                    <input type="file" class="form-control" name="images[]" id="images" multiple>
                                
                                    <span class="text-danger">
                                        @error('images')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Add Description here..." rows="1">{{ isset($post) ? $post->description : old('description') }}</textarea>
                            <span class="text-danger">
                                @error('description')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <button type="submit" class="custom-btn">
                            <i class="fas fa-check"></i> 
                            {{ isset($post) ? 'Update' : 'Create' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
</div>

@endsection
@section("script")
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#category').change(function() {
            var categoryId = $(this).val();
            if (categoryId) {
                $.ajax({
                    // dd(categoryId);
                    url: '/admin/get-breeds/' + categoryId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#breed').empty();
                        $('#breed').append('<option value="">Select Breed</option>');
                        $.each(data, function(key, value) {
                            $('#breed').append('<option value="' + value.id + '">' +
                                value.name + '</option>');
                        });
                    }
                });
            } else {
                $('#breed').empty();
                $('#breed').append('<option value="">Select Breed</option>');
            }
        });
    });
</script>
@endsection