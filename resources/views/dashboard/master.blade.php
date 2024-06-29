<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetPedia</title>
    @include('dashboard.includes.css')
   </head>

<body class="sb-nav-fixed">
    @include('dashboard.includes.header')
    <div id="layoutSidenav">
        @include('dashboard.includes.sidebar')
        <div id="layoutSidenav_content">
            @yield('content')
            @include('dashboard.includes.footer')
        </div>
    </div>
    @include('dashboard.includes.script')
    @yield('script')
</body>

</html>
