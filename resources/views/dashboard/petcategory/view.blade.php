@extends('dashboard.master')
@section('content')

<div class="container mt-5" style="max-width: 900px;">
    <div class="account-card">
        <div class="account-card-header d-flex align-items-center justify-content-center">
            <img src="\backend\tables.jpg" alt="Photo" style="width: 60px; 
            height: 60px; margin-right: 20px;">
            <h3 style="color: #fcfcfc; margin: 0;">
                <h3>Category Table</h3>
            </h3>
        </div>
        <div class="account-card-body">
            <div class="row mb-3">
                <div>
                    <a href="{{ route('Category.create') }}" style="background-color: #ff99b6;
                     border-color: #ff99b6; width: 20%; padding: 10px; border-radius: 5px; 
                     color: white; cursor: pointer; float: right; margin-top: -10px;" 
                     class="btn custom-btn">
                        <i class="fa fa-plus"></i>
                        Add Category
                    </a>
                </div>
            </div>
            
            
            <table class="table table-bordered" id="category_table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Image</th>
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
    $(function() {
        var category_table = $('#category_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/admin/indexcategory",
            },
            columns: [{
                    data: 'name',
                    name: 'name'
                },
                { data: 'images', 
                  name: 'images', 
                  orderable: false,
                  searchable: false },
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
                                    category_table.ajax.reload();
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

