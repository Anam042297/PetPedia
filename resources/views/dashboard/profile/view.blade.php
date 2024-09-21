@extends('dashboard.master')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="account-card">
                <div class="account-card-header text-center">
                    <img src="\backend\viewprofile.jpg" alt="Profile Photo" class="img-fluid rounded-circle" style="width: 150px; height: 150px;">
                    <h3 style="color: #fcfcfc;">
                        Account Information
                    </h3>
                </div>

                <div class="account-card-body">
                    <form id="adminForm">
                        <div class="card-body account-card-body">
                            <div class="account-info">
                                <label for="name"><b>Name: &nbsp </b> {{ auth()->user()->name }}</label>
                            </div>
    
                            <div class="account-info">
                               <label for="email"><b>Email: &nbsp </b> {{ auth()->user()->email }}</label>
                            </div>
                        </div>
                        <a href="{{ route('admin.edit') }}" class="custom-btn">
                            <i class="fas fa-edit"></i>  Update Profile
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection