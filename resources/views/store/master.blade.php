<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#f7858d">
    <meta name="msapplication-navbutton-color" content="#f7858d">
    <meta name="apple-mobile-web-app-status-bar-style" content="#f7858d">
    <meta name="app_url" content="{{ url(('/')) }}">
    <title>بارانا فروشگاه مهربانی</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{asset('store/assets/css/vendor/bootstrap.min.css')}}">
    <!-- Plugins -->
    <link rel="stylesheet" href="{{asset('store/assets/css/vendor/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('store/assets/css/vendor/jquery.horizontalmenu.css')}}">

     @yield('css')


    <!-- Font Icon -->
    <link rel="stylesheet" href="{{asset('store/assets/css/vendor/materialdesignicons.min.css')}}">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{asset('/store/assets/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('/store/assets/css/colors/default.css')}}" id="colorswitch">

    <link href="{{asset('css/admin.css')}}" id="app-style" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/style.css')}}" id="app-style" rel="stylesheet" type="text/css"/>
</head>

<body>

<div class="wrapper" id="app">

    <!-- Start header -->
@include('store.layouts.header',['mini'=>isset($mini)?$mini:false,'show'=>isset($show)?$show:true])
<!-- End header -->

    <!-- Start main-content -->
@yield('content')
<!-- End main-content -->

    <div id="loading_box">
        <div class="loading_div">
            <img src="{{env('IMG').\App\Models\Config::where('key','app_logo')->first()->value}}">
            <div class="spinner">
                <div class="b1"></div>
                <div class="b2"></div>
                <div class="b3"></div>
            </div>
        </div>
    </div>
    <!-- Start footer -->
@include('store.layouts.footer',['mini'=>isset($mini)?$mini:false])
<!-- End footer -->

</div>
<script src="{{ asset('js/store.js') }}"></script>
<!-- colorPanel -->
{{--<div id="colorswitch-option">--}}
{{--<button><i class="mdi mdi-settings"></i></button>--}}
{{--<ul>--}}
{{--<li class="active" data-path="{{asset('store/assets/css/colors/default.css')}}"><span--}}
{{--style="background-color: #f7858d;"></span></li>--}}
{{--<li data-path="{{asset('store/assets/css/colors/amber-color.css')}}"><span--}}
{{--style="background-color: #ffab00;"></span></li>--}}
{{--<li data-path="{{asset('store/assets/css/colors/blue-color.css')}}"><span--}}
{{--style="background-color: #2979ff;"></span></li>--}}
{{--<li data-path="{{asset('store/assets/css/colors/blue-grey-color.css')}}"><span--}}
{{--style="background-color: #607d8b;"></span></li>--}}
{{--<li data-path="{{asset('store/assets/css/colors/brown-color.css')}}"><span--}}
{{--style="background-color: #795548;"></span></li>--}}
{{--<li data-path="{{asset('store/assets/css/colors/cyan-color.css')}}"><span--}}
{{--style="background-color: #00bcd4;"></span></li>--}}
{{--<li data-path="{{asset('store/assets/css/colors/green-color.css')}}"><span--}}
{{--style="background-color: #4caf50;"></span></li>--}}
{{--<li data-path="{{asset('store/assets/css/colors/indigo-color.css')}}"><span--}}
{{--style="background-color: #3f51b5;"></span></li>--}}
{{--<li data-path="{{asset('store/assets/css/colors/lime-color.css')}}"><span--}}
{{--style="background-color: #cddc39;"></span></li>--}}
{{--<li data-path="{{asset('store/assets/css/colors/orange-color.css')}}"><span--}}
{{--style="background-color: #ff9800;"></span></li>--}}
{{--<li data-path="{{asset('store/assets/css/colors/red-color.css')}}"><span--}}
{{--style="background-color: #f44336;"></span></li>--}}
{{--<li data-path="{{asset('store/assets/css/colors/teal-color.css')}}"><span--}}
{{--style="background-color: #009688;"></span></li>--}}
{{--<li data-path="{{asset('store/assets/css/colors/purple-color.css')}}"><span--}}
{{--style="background-color: #9c27b0;"></span></li>--}}
{{--</ul>--}}
{{--</div>--}}
<!-- end colorPanel -->


<!-- Core JS Files -->
<script src="{{asset('store/assets/js/vendor/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('store/assets/js/vendor/popper.min.js')}}"></script>
<script src="{{asset('store/assets/js/vendor/bootstrap.min.js')}}"></script>
<!-- Plugins -->
<script src="{{asset('store/assets/js/vendor/owl.carousel.min.js')}}"></script>
<script src="{{asset('store/assets/js/vendor/jquery.horizontalmenu.js')}}"></script>
@yield('script')
<!-- Main JS File -->
<script src="{{asset('store/assets/js/main.js')}}"></script>
</body>

</html>