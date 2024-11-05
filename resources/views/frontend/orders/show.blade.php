
<form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
    @csrf
    @method('PATCH') <!-- or POST if using POST in route -->
    {{-- <label for="status">Order Status:</label> --}}
    <select name="status" id="status">
        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
        <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
    </select>
    <button type="submit" class="btn btn-primary">Update Status</button>
</form>
