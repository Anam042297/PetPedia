<form action="{{ route('cart.update', $cartItem->id) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="number" name="quantity" value="{{ $cartItem->quantity }}" class="form-control" min="1">
    <button type="submit" class="btn btn-primary mt-2">Update</button>
</form>
