<!DOCTYPE html>
<html>
<head>
    <title>Breed</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

</head>
<body>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h4 class="text-center text-success mt-5 mb-5"><b>Breed Table</b></h4>
                    </div>
                    <div class="col d-flex justify-content-end align-items-center"> <!-- Adjusted column for button -->
                        <a href="{{ route('breed.create') }}" class="btn btn-success">
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
        var table = $('#breed_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "/indexbreed",
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
