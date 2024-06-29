
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PetPedia</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
     @include('frontend.includes.css')
</head>

<body>
    @include('frontend.includes.header')
    @yield('content')
    @include('frontend.includes.footer')


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    @include('frontend.includes.script')

</body>

</html>
