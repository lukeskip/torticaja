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
    <div class="loader-wrapper">
        <div class="animation-wrapper">
            <lottie-player src="{{asset('animations/loading.json')}}"  background="transparent"  speed="1" loop  style="width: 300px; height: 300px;"  autoplay></lottie-player>
        </div>
    </div>
    @yield('content')

    <!-- STARTS: PRELOAD IMAGES-->
    <lottie-player class="hidden" src="{{asset('animations/success.json')}}"  background="transparent"  speed="1"  style="width: 300px; height: 300px;"  autoplay></lottie-player>
    <!-- ENDS: PRELOAD IMAGES-->
    <script type="text/javascript">
			const APP_URL = {!! json_encode(url('/')) !!};
    </script>
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script  src="{{asset('plugins/owlcarousel/dist/owl.carousel.min.js')}}"></script>
    <script  src="{{asset('js/classes/Slide.js')}}"></script>
    <script  src="{{asset('js/classes/Message.js')}}"></script>
    <script  src="{{asset('js/classes/BooleanButton.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    @yield('scripts')
</body>
</html>