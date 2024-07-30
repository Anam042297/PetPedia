@extends('dashboard.master')
@section('content')
<div class="container" style="margin-top: 20px;">
        <div class="card">
            <div class="card-header py-5">
                 <div class="row">
                        <div class="col">
                            <h4 class="text-center" style="color: #4B49AC;"><b>Breed Table</b></h4>
                        </div>
                        <div class="col-auto d-flex justify-content-end">
                            <a href="{{ route('breed.create') }}" class="btn" style="background-color: #4B49AC; border-color: #413f99; color: #ffffff;">
                                <i class="fa fa-plus"></i>
                                Add Breed
                            </a>
                        </div>
                    </div>
            </div>
            <!-- Rest of your card content -->

            <div class="card-body">
                <table class="table table-bordered" id="breed_table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
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
@section('script')

<script type="text/javascript">
    $(function () {
        var table = $('#breed_table').DataTable({
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
    });
</script>
@endsection
