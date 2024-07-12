<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            background: linear-gradient(to right, #F5F7FF, #F5F7FF);
            font-family: Arial, sans-serif;
            background-image: url("Dashboard/images/dashboard/people2.png");
            height: 100%;
            background-position: right;
            background-repeat: no-repeat;
            background-size: 900px 500px auto;

        }

        .login-container {
            width: 700px;
            margin: auto;
            padding: 50px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 20px 0;
        }

        .login-container Label {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: white:
        }

        .login-container button {
            width: 100%;
            padding: 10px;
            background: #4B49AC;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;

        }

        .login-container button:hover {
            background: #7978E9;
        }

        .forgot-password {
            text-align: center;
            display: block;
            margin-top: 20px;
            color: #6D5BBA;
            text-decoration: none;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <div class="login-container">

        <div>
            <h3 style="color:#4B49AC ;text-align:center">Create Category</h3>
        </div>
        @if (session('error'))
            <div class="alert alert-success">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <form  id="contactForm" action="{{ route('Catagory.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="exampleFormControlSelect1">
                    Category Name</label>
                <input type="text" class="form-control" id="name" name="catagory_name">
                <span class="text-danger">
                    @error('catagory_name')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>


    </div>
    <div class="container">
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</body>

</html>
