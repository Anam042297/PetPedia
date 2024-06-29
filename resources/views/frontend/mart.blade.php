@extends('frontend.master')
@section('content')
    <!-- Pricing Plan Start -->
    <div class="container-fluid bg-light pt-5 pb-4">
        <div class="container py-5">
            <div class="d-flex flex-column text-center mb-5">
                <h1 class="text-secondary mb-3">Pet Mart</h1>
                <h6 class="display-4 m-0">Choose <span class="text-primary">Pet Products</span></h6>


            </div>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="card border-0">
                        <div class="card-header position-relative border-0 p-0 mb-4">
                            <img class="card-img-top" src="img/price-1.jpg" alt="">
                            <div class="position-absolute d-flex flex-column align-items-center justify-content-center w-100 h-100" style="top: 0; left: 0; z-index: 1; background: rgba(0, 0, 0, .5);">
                                <h3 class="text-primary mb-3">Foods</h3>

                            </div>
                        </div>

                        <div class="card-footer border-0 p-0">
                            <a href="" class="btn btn-primary btn-block p-9" style="border-radius: 10;">View Items</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card border-0">
                        <div class="card-header position-relative border-0 p-0 mb-4">
                            <img class="card-img-top" src="img/price-2.jpg" alt="">
                            <div class="position-absolute d-flex flex-column align-items-center justify-content-center w-100 h-100" style="top: 0; left: 0; z-index: 1; background: rgba(0, 0, 0, .5);">
                                <h3 class="text-secondary mb-3">Clothes</h3>

                            </div>
                        </div>

                        <div class="card-footer border-0 p-0">
                            <a href="" class="btn btn-secondary btn-block p-9" style="border-radius: 10;">View Items</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card border-0">
                        <div class="card-header position-relative border-0 p-0 mb-4">
                            <img class="card-img-top" src="img/price-3.jpg" alt="">
                            <div class="position-absolute d-flex flex-column align-items-center justify-content-center w-100 h-100" style="top: 0; left: 0; z-index: 1; background: rgba(0, 0, 0, .5);">
                                <h3 class="text-primary mb-3">Assesories</h3>

                            </div>
                        </div>

                        <div class="card-footer border-0 p-0">
                            <a href="" class="btn btn-primary btn-block p-9" style="border-radius: 10;">View Items</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pricing Plan End -->
@endsection
