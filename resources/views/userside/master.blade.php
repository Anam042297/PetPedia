<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    {{-- <meta property="og:name" content="{{ $post->name }}" />
    <meta property="og:category" content="{{ $post->category}}" />
    <meta property="og:breed" content="{{ $post->breed }}" />
    <meta property="og:gender" content="{{ $post->gender }}" />
    <meta property="og:age" content="{{ $post->age }}" />
    
    <meta property="og:description" content="{{ $post->description }}" />
    <meta property="og:image" content="{{  $post->images}}" />
    <meta property="og:url" content="{{ route('single.post', $post->id) }}" />
    <meta property="og:type" content="website" /> --}}
    <title>PetPedia</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
         <!-- Toastr CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">


    @include('userside.includes.css')
    @yield('css')
    
</head>

<body>
    @include('userside.includes.header')

  
    @yield('content')
    @include('userside.includes.footer')
     <!-- Back to Top -->
     <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    @include('userside.includes.script')

    
</body>

</html>