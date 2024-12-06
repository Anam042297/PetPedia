@extends('dashboard.master')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="account-card">
                <div class="account-card-header d-flex align-items-center justify-content-center">
                    <img src="{{ asset('backend/edit.jpg') }}" alt="Profile Photo" style="width: 80px; height: 80px; margin-right: 20px;">
                    <h3 style="color: #fcfcfc; margin: 0;">
                        {{ isset($productcategory) ? 'Edit Category' : 'Create Category' }}
                    </h3>
                </div>
                <div class="account-card-body">
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form id="contactForm" action="{{ isset($productcategory) ? route('ProductCategory.update',$productcategory->id) : route('ProductCategory.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($productcategory))
                            @method('PUT')
                        @endif
                        <div class="form-group mb-3">
                            <label for="name">Category Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ isset($productcategory) ? $productcategory->name : old('name') }}">
                            <span class="text-danger">
                                @error('name')
                                 {{ $message }}
                                @enderror
                            </span>
                        </div>
            
                        <div class="form-group mb-3">
                            <label for="icon">Choose icon</label>
                            <input type="file" class="form-control" name="icon" id="icon">
                            <span class="text-danger">
                                @error('icon') 
                                {{ $message }} 
                                @enderror
                            </span>
                        </div>

                        {{-- @if (isset($productcategory) && $productcategory->icon)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $productcategory->icon) }}" alt="Current Image" style="width: 100px; height: 100px;">
                            </div>
                        @endif --}}

                        <button type="submit" class="custom-btn">
                            {{ isset($productcategory) ? 'Update' : 'Submit' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
