@extends('store.master')
@section('content')
    <main class="main-content dt-sl mt-4 mb-3">
        <div class="container main-container">
            <div class="row">

                <!-- Start Sidebar -->
                <div class="col-xl-3 col-lg-4 col-md-4 col-sm-12 sticky-sidebar">
                    <div class="profile-sidebar dt-sl">
                        <div class="dt-sl dt-sn mb-3">
                            <div class="profile-sidebar-header dt-sl">
                                <div class="profile-avatar float-right">

                                    @if($user->avatar)
                                        <img src="{{env('IMG').$user->avatar->url}}" alt="">
                                    @else
                                        @if($user->image)
                                            <img src="{{env('IMG').$user->image->url}}" alt="">
                                        @else
                                            <img src="{{asset('store/assets/img/theme/avatar.png')}}" alt="">
                                        @endif
                                    @endif
                                </div>
                                <div class="profile-header-content mr-3 mt-2 float-right">
                                    <span class="d-block profile-username">
                                        {{$user->name}}
                                    </span>
                                    <span class="d-block profile-phone">
                                        {{$user->mobile}}
                                    </span>
                                </div>
                                <div class="profile-point mt-3 mb-2 dt-sl">
                                    {{--<span class="float-right label-profile-point">امتیاز شما:</span>--}}
                                    {{--<span class="float-left value-profile-point">120</span>--}}
                                </div>
                                <div class="profile-link mt-2 dt-sl">
                                    <div class="row">
                                        <div class="col-6 text-center">
                                            {{--<a href="#">--}}
                                            {{--<i class="mdi mdi-lock-reset"></i>--}}
                                            {{--<span class="d-block">تغییر رمز</span>--}}
                                            {{--</a>--}}
                                        </div>
                                        <div class="col-6 text-center">
                                            {{--<a href="#">--}}
                                            {{--<i class="mdi mdi-logout-variant"></i>--}}
                                            {{--<span class="d-block">خروج از حساب</span>--}}
                                            {{--</a>--}}
                                            <log-out-btn title="خروج از حساب" action="{{route('site.logout')}}"
                                                         csrf="{{csrf_token()}}"></log-out-btn>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="dt-sl dt-sn mb-3">
                            <div class="profile-menu-section dt-sl">
                                <div class="label-profile-menu mt-2 mb-2">
                                    <span>حساب کاربری شما</span>
                                </div>
                                <div class="profile-menu">
                                    @include('store.profile.profile-menu')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Sidebar -->

                <!-- Start Content -->
            @yield('profile-content')
            <!-- End Content -->

            </div>
            <!-- Start Product-Slider -->
        {{--<section class="slider-section dt-sl mt-5 mb-5">--}}
        {{--<div class="row mb-3">--}}
        {{--<div class="col-12">--}}
        {{--<div class="section-title text-sm-title title-wide no-after-title-wide">--}}
        {{--<h2>محصولات پیشنهادی برای شما</h2>--}}
        {{--<a href="#">مشاهده همه</a>--}}
        {{--</div>--}}
        {{--</div>--}}

        {{--<!-- Start Product-Slider -->--}}
        {{--<div class="col-12 px-res-0">--}}
        {{--<div class="product-carousel carousel-lg owl-carousel owl-theme">--}}
        {{--<div class="item">--}}
        {{--<div class="product-card mb-3">--}}
        {{--<div class="product-head">--}}
        {{--<div class="rating-stars">--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--</div>--}}
        {{--<div class="discount">--}}
        {{--<span>20%</span>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<a class="product-thumb" href="shop-single.html">--}}
        {{--<img src="./assets/img/products/07.jpg" alt="Product Thumbnail">--}}
        {{--</a>--}}
        {{--<div class="product-card-body">--}}
        {{--<h5 class="product-title">--}}
        {{--<a href="shop-single.html">مانتو زنانه</a>--}}
        {{--</h5>--}}
        {{--<a class="product-meta" href="shop-categories.html">لباس زنانه</a>--}}
        {{--<span class="product-price">157,000 تومان</span>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="item">--}}
        {{--<div class="product-card mb-3">--}}
        {{--<div class="product-head">--}}
        {{--<div class="rating-stars">--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<a class="product-thumb" href="shop-single.html">--}}
        {{--<img src="./assets/img/products/017.jpg" alt="Product Thumbnail">--}}
        {{--</a>--}}
        {{--<div class="product-card-body">--}}
        {{--<h5 class="product-title">--}}
        {{--<a href="shop-single.html">کت مردانه</a>--}}
        {{--</h5>--}}
        {{--<a class="product-meta" href="shop-categories.html">لباس مردانه</a>--}}
        {{--<span class="product-price">199,000 تومان</span>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="item">--}}
        {{--<div class="product-card mb-3">--}}
        {{--<div class="product-head">--}}
        {{--<div class="rating-stars">--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star"></i>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<a class="product-thumb" href="shop-single.html">--}}
        {{--<img src="./assets/img/products/013.jpg" alt="Product Thumbnail">--}}
        {{--</a>--}}
        {{--<div class="product-card-body">--}}
        {{--<h5 class="product-title">--}}
        {{--<a href="shop-single.html">مانتو زنانه مدل هودی تیک تین</a>--}}
        {{--</h5>--}}
        {{--<a class="product-meta" href="shop-categories.html">لباس زنانه</a>--}}
        {{--<span class="product-price">135,000 تومان</span>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="item">--}}
        {{--<div class="product-card mb-3">--}}
        {{--<div class="product-head">--}}
        {{--<div class="rating-stars">--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star"></i>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<a class="product-thumb" href="shop-single.html">--}}
        {{--<img src="./assets/img/products/09.jpg" alt="Product Thumbnail">--}}
        {{--</a>--}}
        {{--<div class="product-card-body">--}}
        {{--<h5 class="product-title">--}}
        {{--<a href="shop-single.html">مانتو زنانه</a>--}}
        {{--</h5>--}}
        {{--<a class="product-meta" href="shop-categories.html">لباس زنانه</a>--}}
        {{--<span class="product-price">145,000 تومان</span>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="item">--}}
        {{--<div class="product-card mb-3">--}}
        {{--<div class="product-head">--}}
        {{--<div class="rating-stars">--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<a class="product-thumb" href="shop-single.html">--}}
        {{--<img src="./assets/img/products/010.jpg" alt="Product Thumbnail">--}}
        {{--</a>--}}
        {{--<div class="product-card-body">--}}
        {{--<h5 class="product-title">--}}
        {{--<a href="shop-single.html">مانتو زنانه</a>--}}
        {{--</h5>--}}
        {{--<a class="product-meta" href="shop-categories.html">لباس زنانه</a>--}}
        {{--<span class="product-price">170,000 تومان</span>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="item">--}}
        {{--<div class="product-card mb-3">--}}
        {{--<div class="product-head">--}}
        {{--<div class="rating-stars">--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star"></i>--}}
        {{--</div>--}}
        {{--<div class="discount">--}}
        {{--<span>20%</span>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<a class="product-thumb" href="shop-single.html">--}}
        {{--<img src="./assets/img/products/011.jpg" alt="Product Thumbnail">--}}
        {{--</a>--}}
        {{--<div class="product-card-body">--}}
        {{--<h5 class="product-title">--}}
        {{--<a href="shop-single.html">مانتو زنانه</a>--}}
        {{--</h5>--}}
        {{--<a class="product-meta" href="shop-categories.html">لباس زنانه</a>--}}
        {{--<span class="product-price">185,000 تومان</span>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="item">--}}
        {{--<div class="product-card mb-3">--}}
        {{--<div class="product-head">--}}
        {{--<div class="rating-stars">--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star"></i>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<a class="product-thumb" href="shop-single.html">--}}
        {{--<img src="./assets/img/products/019.jpg" alt="Product Thumbnail">--}}
        {{--</a>--}}
        {{--<div class="product-card-body">--}}
        {{--<h5 class="product-title">--}}
        {{--<a href="shop-single.html">تیشرت مردانه</a>--}}
        {{--</h5>--}}
        {{--<a class="product-meta" href="shop-categories.html">لباس مردانه</a>--}}
        {{--<span class="product-price">54,000 تومان</span>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<!-- End Product-Slider -->--}}

        {{--</div>--}}
        {{--</section>--}}
        <!-- End Product-Slider -->
        </div>
    </main>
@endsection