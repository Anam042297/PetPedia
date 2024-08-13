@extends('dashboard.master')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="account-card">
                <div class="account-card-header">
                    <h3>{{ isset($category) ? 'Edit Category' : 'Create Category' }}</h3>
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

                    <form id="contactForm" action="{{ isset($category) ? route('Catagory.update', $category->id) : route('Catagory.store') }}" method="POST" enctype="multipart/form-data">
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

                        <button type="submit" class="custom-btn">
                            {{ isset($category) ? 'Update' : 'Submit' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
