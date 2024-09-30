<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Thank You for Your Order!</h1>
    <p>Your order ID is: {{ $order->tracking_id }}</p>
    <p>Total Amount: ${{ $order->total_amount }}</p>
    <p>We appreciate your business!</p>
</body>
</html>
