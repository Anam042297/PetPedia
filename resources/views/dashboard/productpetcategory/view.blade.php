@extends('dashboard.master')
@section('content')

    <div class="container"  style="margin-top: 20px;">

        <div class="card">
            <div class="card">
                <div class="card-header py-5">
                    <div class="row">
                        <div class="col">
                            <h4 class="text-center" style="color: #4B49AC;"><b>Pet_Category Table</b></h4>
                        </div>
                        <div class="col-auto d-flex justify-content-end">
                            <a href="{{ route('PetCategory.create') }}" class="btn"
                                style="background-color: #4B49AC; border-color: #413f99; color: #ffffff;">
                                <i class="fa fa-plus"></i>
                                Add Pet_Category
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="petcategory_table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
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
    $(function() {
        var petcategory_table = $('#petcategory_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/admin/indexpetcategories",
            },
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
        $(document).on('click', 'button.delete_button', function() {
                swal({
                    title: 'Sure',
                    text: 'Confirm Delete Post',
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
                                    petcategory_table.ajax.reload();
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

