@extends('dashboard.master')

@section('content')

<div class="login-container" style="background: linear-gradient(to right, #dd85dd, #c78fec)">
    <div>
        <h3 style="color:#ff99e4; text-align:center;">
        </h3>
    </div>
    <div class="container">
        <h1>Edit Product</h1>

            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" class="form-control" id="name" value="{{ $product->name }}" required>
                <span class="text-danger">
                    @error('Product name')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div class="form-group">
                <label for="type">Product Type</label>
                <select name="type" class="form-control" id="type" required>
                    <option value="">Select Product Type</option>
                    <option value="food" {{ $product->type === 'food' ? 'selected' : '' }}>Food</option>
                    <option value="accessory" {{ $product->type === 'accessory' ? 'selected' : '' }}>Accessory</option>
                </select>
                <span class="text-danger">
                    @error('Product Type')
                        {{ $message }}
                    @enderror
                </span>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" class="form-control" id="price" value="{{ $product->price }}" required>
                <span class="text-danger">
                    @error('Product Price')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div class="form-group">
                <label for="pet_category_id">Pet Category</label>
                <select name="pet_category_id" class="form-control" id="pet_category_id" required>
                    <option value="">Select Pet Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id === $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <span class="text-danger">
                    @error('Pet category')
                        {{ $message }}
                    @enderror
                </span>
            </div>
  <!-- Weight field, only shown if 'food' is selected -->
  <div class="form-group" id="weight-group" style="display: none;">
    <label for="weight">Weight (in kg)</label>
    <input type="number" name="weight" class="form-control" id="weight" step="0.01" value="{{ old('weight', $product->weight) }}">
    <span class="text-danger">
        @error('weight')
            {{ $message }}
        @enderror
    </span>
</div>
            <!-- Company field -->
            <div class="form-group">
                <label for="company">Company</label>
                <input type="text" name="company" class="form-control" id="company" value="{{ old('company', $product->company) }}">
                <span class="text-danger">
                    @error('company')
                        {{ $message }}
                    @enderror
                </span>
            </div>
                  <!-- Quantity field -->
                  <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" class="form-control" id="quantity" min="0" value="{{ old('quantity', $product->quantity) }}" required>
                    <span class="text-danger">
                        @error('quantity')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

            <div class="form-group">
                <label for="images">Product Images</label>
                <input type="file" name="images[]" class="form-control" id="images" multiple>
                <span class="text-danger">
                    @error('images.*')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </div>
</div>
<!-- JavaScript to conditionally show/hide the weight field -->
<script>
    document.getElementById('type').addEventListener('change', function() {
        var weightGroup = document.getElementById('weight-group');
        if (this.value === 'food') {
            weightGroup.style.display = 'block';
        } else {
            weightGroup.style.display = 'none';
        }
    });
</script>
@endsection
