<!DOCTYPE html>
<html>
<head>
    <title>Category</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
</head>
<body>

    <div class="container">

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col col-9">
                        <h4 class="text-center text-success mt-5 mb-5"><b>Category Table</b></h4>
                    </div>
                    <div class="col col-3">
                        <button type="button" class="btn btn-success btn-modal"
                        data-href="{{ route('Catagory.create') }}" data-container_modal=".view_modal">
                        <i class="fa fa-plus"></i>
                        Add Category
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="user_table">
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

    <script type="text/javascript">
    $(function () {
        var table = $('#catagory_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/indexcatagory",
            },
            columns: [
                { data: 'name', name: 'name' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
    });
</script>
</body>
</html>
