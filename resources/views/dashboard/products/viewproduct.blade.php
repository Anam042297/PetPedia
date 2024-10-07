@extends('dashboard.master')
@section('content')
    <div class="container mt-5">
        <div class="account-card">
            <div class="account-card-header d-flex align-items-center justify-content-center">
                <img src="\backend\tables.jpg" alt="Profile Photo" style="width: 60px; height: 60px; margin-right: 20px;">
                <h3 style="color: #fcfcfc; margin: 0;">Product Table</h3>
            </div>
            <div class="account-card-body">
                <div class="row mb-3">
                    <div class="col text-end">
                        <a href="{{ route('products.create') }}" class="btn custom-btn"
                            style="background-color: #ff99b6; border-color: #ff99b6; width: 15%; padding: 10px; border-radius: 5px; color: white; cursor: pointer; float: right; margin-top: -10px;">
                            <i class="fa fa-plus"></i>
                            Add Product
                        </a>
                    </div>
                </div>
                
                <table class="table table-bordered" id="product_table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>PetCategory</th>
                            <th>Price</th>
                            <th>Product Category</th>
                            <th>Weight</th>
                            <th>Brand</th>
                            <th>Stock</th>
                            <th>Images</th>
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
    <script>
        @if (session('success'))
            toastr.success('{{ session('success') }}');
        @endif
        @if (session('error'))
            toastr.error('{{ session('error') }}');
        @endif
    </script>

    <script type="text/javascript">
        $(function() {
            var product_table = $('#product_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "/admin/indexproduct", // Adjust this URL based on your route
                },
                columns: [
                    // Creator (user who added the product)
                    {
                        data: 'name',
                        name: 'name'
                    }, // Product name
                    {
                        data: 'category',
                        name: 'category',
                        sortable:false
                    }, // Pet type: dog, cat, bird, etc.
                    {
                        data: 'price',
                        name: 'price',
                        sortable:false
                    }, // Product price
                    {
                        data: 'product_category',
                        name: 'product_category',
                        sortable:false
                    }, // Product category: food/accessory
                    {
                        data: 'weight',
                        name: 'weight',
                       sortable:false
                    //     visible: true
                    }, // Visible only for food products
                    {
                        data: 'brand',
                        name: 'brand',
                        sortable: false
                    }, // Product brand
                    {
                        data: 'stock',
                        name: 'stock',
                        sortable: false
                    }, // Product quantity
                    {
                        data: 'images',
                        name: 'images',
                        orderable: false,
                        searchable: false
                    }, // Product images
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    } // Action buttons
                ]
            });

            // Delete product confirmation and AJAX request
            $(document).on('click', 'button.delete_product_button', function() {
                swal({
                    title: 'Are you sure?',
                    text: 'Confirm Delete Product',
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
                                    product_table.ajax.reload(); // Reload the DataTable

                                } else {
                                    toastr.error(result.error);
                                }
                            },
                            error: function(result) {
                                toastr.error(
                                    'An error occurred while deleting the product.');
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
