@extends('dashboard.master')
@section('content')
<div class="login-container" style="background: linear-gradient(to right, #c749c7, #c78fec)">

    <div>
        <h3 style="color:#e242b0; text-align:center;">
        </h3>
    </div>
    <div class="container">
        <h1>Create Product</h1>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" name="name" class="form-control" id="name" required>
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
                    <option value="food">Food</option>
                    <option value="accessory">Accessory</option>
                </select>
                <span class="text-danger">
                    @error('Product Type')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" class="form-control" id="price" required>
                <span class="text-danger">
                    @error('Product price')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <div class="form-group">
                <label for="pet_category_id">Pet Category</label>
                <select name="pet_category_id" class="form-control" id="pet_category_id" required>
                <option value="">Select Pet Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <span class="text-danger">
                    @error('pet_category_id')
                        {{ $message }}
                    @enderror
                </span>
            </div>
   <!-- Weight field, only shown if 'food' is selected -->
   <div class="form-group" id="weight-group" style="display: none;">
    <label for="weight">Weight (in kg)</label>
    <input type="number" name="weight" class="form-control" id="weight" step="0.01">
    <span class="text-danger">
        @error('weight')
            {{ $message }}
        @enderror
    </span>
</div>

            <!-- Company field -->
            <div class="form-group">
                <label for="company">Company</label>
                <input type="text" name="company" class="form-control" id="company">
                <span class="text-danger">
                    @error('company')
                        {{ $message }}
                    @enderror
                </span>
            </div>
                  <!-- Quantity field -->
                  <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" name="quantity" class="form-control" id="quantity" min="0" required>
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
                    @error('images')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            <button type="submit" class="btn btn-primary">Save Product</button>
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
