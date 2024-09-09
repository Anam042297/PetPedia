@extends('dashboard.master')
@section('content')
<div class="container mt-5">
    <div class="account-card">
        <div class="account-card-header d-flex align-items-center justify-content-center">
            <img src="\backend\tables.jpg" alt="Photo" style="width: 60px;
             height: 60px; margin-right: 20px;">
            <h3 style="color: #fcfcfc; margin: 0;">
                <h3>Breed Table</h3>
            </h3>
        </div>
        <div class="account-card-body">
            <div class="row mb-3">
                <div>
                    <a href="{{ route('breed.create') }}" class="btn custom-btn"  style="background-color:
                     #ff99b6; border-color: #ff99b6; width: 15%; padding: 10px; border-radius: 5px; color:
                      white; cursor: pointer; float: right; margin-top: -10px;">
                        <i class="fa fa-plus"></i>
                        Add Breed
                    </a>
                </div>
            </div>
            <table class="table table-bordered" id="breed_table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
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
        var breed_table = $('#breed_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/admin/indexbreed",
            },
            columns: [
                { data: 'name', name: 'name' },
                { data: 'category_name', name: 'category_name' }, 
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
        $(document).on('click', 'button.delete_breed_button', function() {
                swal({
                    title: 'Sure',
                    text: 'Confirm Delete',
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var href = $(this).data('href');
                        var data = {
                            _token: '{{ csrf_token() }}' // Ensure the CSRF token is included
                        };

                        $.ajax({
                            method: "DELETE",
                            url: href,
                            dataType: "json",
                            data: data,
                            success: function(result) {
                                if (result.success) {
                                    toastr.success(result.success);
                                    breed_table.ajax.reload();
                                } else {
                                    toastr.error(result.error);
                                }
                            },
                            error: function(result) {
                                toastr.error(
                                    'An error occurred while deleting.');
                            }
                        });
                    }
                });
            });
    });
</script>
@endsection
