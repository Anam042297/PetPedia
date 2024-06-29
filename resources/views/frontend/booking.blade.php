@extends('frontend.master')
@section('content')
<!-- Services Start -->

    <div class="container">
        <h1>Your Pet Adoption Bookings</h1>
       <div class="booking-count">
       <h2>Total Bookings: <span id="total-bookings">0</span></h2>
       </div>
       <div class="booking-list">
       <h2>Booking Details</h2>
       <table>
       <thead>
       <tr>
       <th>Pet Name</th>
       <th>Booking Date</th>
       <th>Status</th>
       </tr>
       </thead>
       <tbody id="booking-details">
       <!-- Booking details will be inserted here -->
       </tbody>
       </table>
       </div>
 </div>
    <!-- Services End -->
@endsection
