@extends('dashboard.master')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            background: linear-gradient(to right, #ffb5ca, #ffc2e2);
            font-family: Arial, sans-serif;
            height: 100%;
            background-position: right;
            background-repeat: no-repeat;
            background-size: 900px 500px auto;

        }

        .login-container {
            background: linear-gradient(to right,  #ffffff,#ffffff);
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
            background: #ff99b6;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;

        }

        .login-container button:hover {
            background: #ffb8cc;
        }

    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <div class="login-container" >

        <div>
            <h3 style="color:#af99ff ;text-align:center">Create Post</h3>
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
        <form id="contactForm" action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="catagory">Select Catagory</label>
                <select class="form-control" id="catagory" name="catagory_id">
                    <option value="">Select category</option>
                    @foreach ($categories as $catagory)
                        <option value="{{ $catagory->id }}">{{ $catagory->name }}</option>
                    @endforeach
                </select>
                <span class="text-danger">
                    @error('catagory_id')
                        {{ $message }}
                    @enderror
                    </span>
            </div>
            <div class="form-group">
                <label for="$breeds">Select Breed</label>
                <select class="form-control" id="breed" name="breed_id">
                    {{-- <option value="">Select breed</option> --}}
                    {{-- @foreach ($breeds as $breed)
                    <option value="{{ $breed->id }}">{{ $breed->name }}</option>
                @endforeach --}}
                </select>
                <span class="text-danger">
                    @error('breed_id')
                        {{ $message }}
                    @enderror
                    </span>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Pet Name</label>
                <input type="text" class="form-control" id="pet_name" name="name" placeholder="Pet Name">
                <span class="text-danger">
                    @error('pet_name')
                        {{ $message }}
                    @enderror
                    </span>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">Pet Age (in months)</label>
                <input type="number" id="age" name="age" class="form-control" min="0" required>
                <span class="text-danger">
                    @error('age')
                        {{ $message }}
                    @enderror
                    </span>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Description</label>
                <textarea class="form-control" id="description" name='description' rows="3"></textarea>
                <span class="text-danger">
                    @error('description')
                        {{ $message }}
                    @enderror
                    </span>
            </div>
            <div class="form-group">Choose images</label>
                <input type="file" class="form-control p-4"name="images[]" id="image_id"name="image_id" multiple>
                <span class="text-danger">
                    @error('image')
                        {{ $message }}
                    @enderror
                    </span>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>


    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#catagory').change(function() {
                var categoryId = $(this).val();
                if (categoryId) {
                    $.ajax({
                        // dd(categoryId);
                        url: '/admin/get-breeds/' + categoryId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#breed').empty();
                            $('#breed').append('<option value="">Select Breed</option>');
                            $.each(data, function(key, value) {
                                $('#breed').append('<option value="' + value.id + '">' +
                                    value.name + '</option>');
                            });
                        }
                    });
                } else {
                    $('#breed').empty();
                    $('#breed').append('<option value="">Select Breed</option>');
                }
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</body>

</html>
@endsection
