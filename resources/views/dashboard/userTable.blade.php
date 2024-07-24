@extends('dashboard.master')
@section('content')
    <div class="container" style="margin-top: 20px;">
        <div class="card">
            <div class="card-header py-5">
                <div class="row">
                    <div class="col">
                        <h4 class="text-center" style="color: #4B49AC;"><b>User Table</b></h4>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="user_table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
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
            var table = $('#user_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('usertable') }}",
                },
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
    @endsection



