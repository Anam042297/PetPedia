<form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Remove</button>
</form>
