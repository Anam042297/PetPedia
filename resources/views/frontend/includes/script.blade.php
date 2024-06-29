 <!-- JavaScript Libraries -->
 <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
 <script src="lib/easing/easing.min.js"></script>
 <script src="lib/owlcarousel/owl.carousel.min.js"></script>
 <script src="lib/tempusdominus/js/moment.min.js"></script>
 <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
 <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

 <!-- Contact Javascript File -->
 <script src="mail/jqBootstrapValidation.min.js"></script>
 <script src="mail/contact.js"></script>

 <!-- Template Javascript -->
 <script src="js/main.js"></script>
 <script>
    // Example JavaScript to update the bookings count and details
    document.getElementById('total-bookings').textContent = '3'; // Update with actual count
    const bookingDetails = [
    { petName: 'Buddy', bookingDate: '2024-06-20', status: 'Pending' },
    { petName: 'Mittens', bookingDate: '2024-06-18', status: 'Approved' },
    { petName: 'Rex', bookingDate: '2024-06-15', status: 'Approved' }
    ];
    const bookingTable = document.getElementById('booking-details');
    bookingDetails.forEach(booking => {
    const row = bookingTable.insertRow();
    const petNameCell = row.insertCell(0);
    const bookingDateCell = row.insertCell(1);
    const statusCell = row.insertCell(2);
    petNameCell.textContent = booking.petName;
    bookingDateCell.textContent = booking.bookingDate;
    statusCell.textContent = booking.status;
    });
    </script>
<script>
    function toggleDropdown() {
      var dropdownContent = document.getElementById("dropdownContent");
      dropdownContent.classList.toggle("show");
    }
    </script>
