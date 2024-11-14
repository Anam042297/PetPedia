@extends('userside.master')
@include('dashboard.includes.css')
@section('content')
{{-- <div class="container mt-5">
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
                                <label for="name" style="color: white"><b style="color: white">Name: &nbsp;</b> {{ $user->name }}</label>
                            </div>
    
                            <div class="account-info">
                               <label for="email" style="color: white"><b style="color: white">Email: &nbsp;</b> {{ $user->email }}</label>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="container mt-5">
    <div class="row">
        <!-- Account Information Card -->
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
                                <label for="name" style="color: white"><b style="color: white">Name: &nbsp;</b> {{ $user->name }}</label>
                            </div>
    
                            <div class="account-info">
                               <label for="email" style="color: white"><b style="color: white">Email: &nbsp;</b> {{ $user->email }}</label>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Orders and Cart Cards -->
   
</div>

@endsection