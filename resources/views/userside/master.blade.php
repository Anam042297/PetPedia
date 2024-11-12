<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <title>PetPedia</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('userside.includes.css')
    @yield('css')
    
</head>

<body>
    @include('userside.includes.header')

  
    @yield('content')
    @include('userside.includes.footer')
    @include('userside.includes.script')

    
</body>

</html>