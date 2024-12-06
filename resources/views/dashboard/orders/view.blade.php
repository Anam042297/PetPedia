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
                url: "{{ route('orders.index') }}",  
            },
            columns: [
                {data: 'tracking_id', name: 'tracking_id'},  
                {data: 'total_amount', name: 'total_amount'},  
                {data: 'status', name: 'status'},  
                {data: 'name', name: 'name'}, 
                {data: 'city', name: 'city'}, 
                {data: 'phone_no', name: 'phone_no'},  
                {data: 'action', name: 'action', orderable: false, searchable: false},  
            ],
    
        });
    });

@if(session('success'))
            order_table.ajax.reload(null, false); 
        @endif

</script>
@endsection
