<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TortiCaja</title>
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/owlcarousel/dist/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/slides.css')}}">

    @yield('styles')
</head>
<body>
    @yield('content')


    <script type="text/javascript">
			let APP_URL = {!! json_encode(url('/')) !!};
    </script>
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script  src="{{asset('plugins/owlcarousel/dist/owl.carousel.min.js')}}"></script>
    <script  src="{{asset('js/classes/Slide.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    @yield('scripts')
</body>
</html>