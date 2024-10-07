@extends('dashboard.master')
@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="account-card">
                <div class="account-card-header d-flex align-items-center justify-content-center">
                    <img src="\backend\edit.jpg" alt="Profile Photo" style="width: 80px; height: 80px; margin-right: 20px;">
                    <h1 style="color: #fcfcfc; margin: 0;">Edit Product</h1>
                </div>

                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">

                        <!-- Product Name -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ $product->name }}" required>
                                <span class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <!-- Pet Category -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="category_id">Pet Category</label>
                                <select name="category_id" class="form-control" id="category_id" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
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
                        </div>

                        <!-- Price -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" name="price" class="form-control" id="price" value="{{ $product->price }}" required min="0">
                                <span class="text-danger">
                                    @error('price')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <!-- Product Category -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product_category_id">Product Category</label>
                                <select name="product_category_id" class="form-control" id="product_category_id" required>
                                    @foreach ($productcategories as $productCategory)
                                        <option value="{{ $productCategory->id }}" {{ $product->product_category_id == $productCategory->id ? 'selected' : '' }}>
                                            {{ $productCategory->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="text-danger">
                                    @error('product_category_id')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <!-- Weight -->
                        <div class="col-md-6">
                            <div class="form-group" >
                                <label for="weight">Weight (<span id="weight-unit">gram</span>)</label>
                                <input type="number" name="weight" class="form-control" id="weight" step="0.01" min="0" value="{{ old('weight', $product->weight) }}">
                                <span class="text-danger">
                                    @error('weight')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                  

                        <!-- Brand -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="brand">Brand</label>
                                <input type="text" name="brand" class="form-control" id="brand" value="{{ old('brand', $product->brand) }}">
                                <span class="text-danger">
                                    @error('brand')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <!-- Stock -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="quantity">Stock</label>
                                <input type="number" name="stock" class="form-control" id="stock" min="0" value="{{ old('stock', $product->stock) }}" required>
                                <span class="text-danger">
                                    @error('stock')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <!-- Images -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="images">Product Images</label>
                                <input type="file" name="images[]" class="form-control" id="images" multiple>
                                <span class="text-danger">
                                    @error('images.*')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-md-12 text-right">
                            <button type="submit" class="custom-btn"><i class="fas fa-check"></i> Update</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

