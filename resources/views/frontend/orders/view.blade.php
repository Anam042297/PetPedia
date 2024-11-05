@extends('dashboard.master')

@section('content')
<div class="container mt-5" style="max-width: 900px;">
    <div class="account-card">
        <div class="account-card-header d-flex align-items-center justify-content-center">
            <img src="/backend/tables.jpg" alt="Photo" style="width: 60px; height: 60px; margin-right: 20px;">
            <h3>Order Table</h3>
        </div>
        <div class="account-card-body">
            <table class="table table-bordered" id="order_table">
                <thead>
                    <tr>
                        <th>Tracking ID</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Name</th>
                        <th>City</th>
                        <th>Phone No</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection

@section("script")
<script>
    @if(session('success'))
        toastr.success('{{ session('success') }}');
    @endif
    @if(session('error'))
        toastr.error('{{ session('error') }}');
    @endif
</script>

<script type="text/javascript">
    $(function () {
        var order_table = $('#order_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('orders.index') }}",  // Use Laravel's route helper
            },
            columns: [
                {data: 'tracking_id', name: 'tracking_id'},  // Tracking ID
                {data: 'total_amount', name: 'total_amount'},  // Total Amount
                {data: 'status', name: 'status'},  // Order Status
                {data: 'name', name: 'name'},  // Customer Name
                {data: 'city', name: 'city'},  // City
                {data: 'phone_no', name: 'phone_no'},  // Phone Number
                {data: 'action', name: 'action', orderable: false, searchable: false},  // Action buttons (e.g., view details)
            ],
            // order: [[3, 'desc']]  // Default order by the 'name' column descending
        });
    });
</script>
@endsection
