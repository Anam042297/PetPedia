<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Thank You for Your Order!</h1>
    <p>Your order ID is: {{ $order->tracking_id }}</p>
    <p>Total Amount:PKR{{ $order->total_amount }}</p>
    <p>We appreciate your business!Keep in touch us for more enjoyable experience.If you have any Query Contact Us
         </p>
         @php
         $phoneNumber = "+923158230935";
     @endphp
     <a href="https://wa.me/{{ str_replace('+', '', $phoneNumber) }}"
        target="_blank">
         <h4 class="widget_title" style="color: #25D366;">
             Contact on WhatsApp
         </h4>
     </a>
     
</body>
</html>
