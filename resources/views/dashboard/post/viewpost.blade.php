@extends('dashboard.master')
@section('content')

    <div class="container"   style="margin-top: 20px;">

        <div class="card">
            <div class="card">
                <div class="card-header py-5">
                    <div class="row">
                        <div class="col">
                            <h4 class="text-center" style="color: #4B49AC;"><b>Post Table</b></h4>
                        </div>
                        <div class="col-auto d-flex justify-content-end">
                            <a href="{{ route('post.create') }}" class="btn" style="background-color: #4B49AC; border-color: #413f99; color: #ffffff;">
                                <i class="fa fa-plus"></i>
                                Add Post
                            </a>
                        </div>
                    </div>
                </div>
            <div class="card-body">
                <table class="table table-bordered" id="post_table">
                    <thead>
                        <tr>
                            <th>Created By</th>
                            <th>Catrgory</th>
                            <th>Breed</th>
                            <th>Pet Name</th>
                            <th>Age (months)</th>
                            <th>Image</th>
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
<script type="text/javascript">
    $(function () {
        var table = $('#post_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/admin/indexpost",
            },
            columns: [

                { data: 'user.name', name: 'user.name' },
                { data: 'catagory.name', name: 'cataory.name' },
                { data: 'breed.name', name: 'breed.name' },
                { data: 'name', name: 'name' },
                { data: 'age', name: 'age' },
                { data: 'images', name: 'images', orderable: false, searchable: false },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
        $(document).on('click', '.delete', function() {
            var id = $(this).data('id');
            if (confirm("Are you sure you want to delete this post?")) {
                $.ajax({
                    url: '/posts/' + id,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#posts-table').DataTable().ajax.reload();
                    }
                });
            }
        });
    });
</script>
@endsection

