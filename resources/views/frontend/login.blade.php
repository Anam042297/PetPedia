<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="account-card">
                <div class="account-card-header d-flex align-items-center justify-content-center">
                    <img src="\backend\edit.jpg" alt="Profile Photo" style="width: 80px; height: 80px; margin-right: 20px;">
                    <h3 style="color: #fcfcfc; margin: 0;">
                        Login
                    </h3>
                </div>

                <div class="account-card-body">
                    @if (session('error'))
                        <div class="alert alert-danger" style="margin-bottom: 20px;">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success" style="margin-bottom: 20px;">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form id="adminForm" action="{{ route('form.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                            <span class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="password">
                            <span class="text-danger">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Don't have any account please <a href="{{'register'}}">Register</a> first</label>
                            
                        </div>
                        
                        <button type="submit" class="custom-btn">
                            Login
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom CSS for DataTables Processing Block */
.dataTables_processing {
    color:black;
}

.table {
        border: 2px solid #af99ff;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .table th {
        text-align: center;
    }
    
    .table td {
        border: 1px solid  #af99ff;
        padding: 10px;
        text-align: center;
    }
    
    .table-bordered th, .table-bordered td {
        padding: 10px!important;
        text-align: center!important;
        background-color: #ffcfdd !important;
        border-color: #ff99b6 !important;
    }
    
    .account-card {
        background: linear-gradient(135deg, #ff99b6, #af99ff);
        color: #fff;
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        padding: 20px;
        margin-bottom: 50px;
    }

    .account-card-header {
        text-align: center;
        margin: 0;
        padding: 15px;
        font-size: 1.5rem;
        color: #ffffff;
    }

    .account-card-body {
        padding: 30px;
    }
    
    .custom-btn {
        background-color: #ff99b6;
        border-color: #ff99b6;
        width: 30%;
        padding: 10px;
        border-radius: 5px;
        color: white;
        cursor: pointer;
        float: right; 
        margin-top: -10px;
    }
    body {
        background: linear-gradient(135deg, #ffffff, #ffffff);
        overflow-x: hidden; 
    }


</style>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

