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
                                <label for="name">Name:</label>
                                <p id="name">{{ auth()->user()->name }}</p>
                            </div>
    
                            <div class="account-info">
                               <label for="email">Email:</label>
                               <p id="email">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                        <a href="{{ route('admin.edit') }}" class="btn" style=" background-color:#ff99b6;border-color: #ff99b6;width: 30%; padding: 10px;border-radius: 5px;color: white;cursor: pointer;float: right;margin-top: -10px;">
                            <i class="fas fa-edit"></i>  Update Profile
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection