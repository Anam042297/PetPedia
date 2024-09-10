<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Toastr for notifications (Optional) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
$(document).ready(function() {
    $('.add-to-cart').on('click', function(e) {
        e.preventDefault();
        
        var button = $(this);
        var productId = button.data('product-id');
        var quantity = button.siblings('.quantity-input').val() || 1;

        $.ajax({
            url: '{{ route('cart.add') }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                product_id: productId,
                quantity: quantity
            },
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message); // Show success message
                } else {
                    toastr.error(response.message); // Handle error message
                }
            },
            error: function(xhr) {
                toastr.error('An error occurred while adding the product to the cart.');
            }
        });
    });
});
</script>
@foreach($products as $product)
    <div class="product">
        <h3>{{ $product->name }}</h3>
        <input type="number" class="quantity-input" value="1" min="1">
        <button class="add-to-cart" data-product-id="{{ $product->id }}">Add to Cart</button>
    </div>
@endforeach
