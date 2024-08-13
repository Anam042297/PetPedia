
@extends('dashboard.master')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="account-card">
                <div class="account-card-header">
                    <h3>{{ isset($breed) ? 'Edit Breed' : 'Create Breed' }}</h3>
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

                    <form id="contactForm" action="{{ isset($breed) ? route('breed.update', $breed->id) : route('breed.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($breed))
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="catagory">Select Category</label>
                            <select class="form-control" id="catagory" name="catagory_id">
                                <option value="">Select category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ isset($breed) && $breed->catagory_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="text-danger">
                                @error('catagory_id')
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
