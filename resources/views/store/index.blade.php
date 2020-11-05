@extends('store.master')
@section('content')
    <main class="main-content dt-sl mt-4 mb-3">
        <div class="container main-container">

            <!-- Start Main-Slider -->
            <div class="row mb-5">
                <aside class="sidebar col-xl-2 col-lg-3 col-12 order-2 order-lg-1 pl-0 hidden-md">
                    <!-- Start banner -->
                    <div class="sidebar-inner dt-sl">
                        <div class="sidebar-banner">
                            <a href="#" target="_top">
                                <img src="{{asset('store/assets/img/banner/sidebar-banner-1.gif')}}" width="100%"
                                     height="329"
                                     alt="">
                            </a>
                        </div>
                    </div>
                    <!-- End banner -->
                </aside>

                <div class="col-xl-10 col-lg-9 col-12 order-1 order-lg-2">
                    <!-- Start main-slider -->
                    <section id="main-slider" class="main-slider carousel slide carousel-fade card hidden-sm"
                             data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach($mainSlider as $key=>$item)
                                <li data-target="#main-slider" data-slide-to="{{$key}}"
                                    class="{{$key==0?'active':''}}"></li>
                            @endforeach

                        </ol>
                        <div class="carousel-inner">
                            @foreach($mainSlider as $key=>$item)
                                <div class="carousel-item @if($key==0) active @endif">
                                    <a class="main-slider-slide"
                                       href="{{$item->category ? route('site.getCat',['category_slug'=>$item->category->slug]):'#'}}"
                                       style="background-image: url({{env('IMG').$item->image}}">
                                    </a>
                                </div>
                            @endforeach

                        </div>
                        <a class="carousel-control-prev" href="#main-slider" role="button" data-slide="prev">
                            <i class="mdi mdi-chevron-right"></i>
                        </a>
                        <a class="carousel-control-next" href="#main-slider" data-slide="next">
                            <i class="mdi mdi-chevron-left"></i>
                        </a>
                    </section>
                    <section id="main-slider-res"
                             class="main-slider carousel slide carousel-fade card d-none show-sm" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach($mainSlider as $key=>$item)
                                <li data-target="#main-slider-res" data-slide-to="{{$key}}"
                                    class="{{$key==0?'active':''}}"></li>
                            @endforeach

                        </ol>
                        <div class="carousel-inner">
                            @foreach($mainSlider as $key=>$item)
                                <div class="carousel-item active">
                                    <a class="main-slider-slide"
                                       href="{{$item->category ? route('site.getCat',['category_slug'=>$item->category->slug]):'#'}}">
                                        <img src="{{env('IMG').$item->image_responsive}}" alt=""
                                             class="img-fluid">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#main-slider-res" role="button" data-slide="prev">
                            <i class="mdi mdi-chevron-right"></i>
                        </a>
                        <a class="carousel-control-next" href="#main-slider-res" data-slide="next">
                            <i class="mdi mdi-chevron-left"></i>
                        </a>
                    </section>
                    <!-- End main-slider -->
                </div>
            </div>
            <!-- End Main-Slider -->

            <!-- Start Product-Slider -->
            @if(sizeof($lastSale)>0)
                <div class="row">
                    <?php
                        if ($instant_offer->value == '0'){
                            $lastSaleCol='col-xl-12 col-lg-12';
                        }else{
                            $lastSaleCol='col-xl-10 col-lg-12';
                        }

                    ?>
                    <div class="{{$lastSaleCol}}">
                        <section class="slider-section dt-sl mb-5">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="section-title text-sm-title title-wide no-after-title-wide">
                                        <h2>پر فروش ترینها</h2>
                                        {{--<a href="#">مشاهده همه</a>--}}
                                    </div>
                                </div>

                                <!-- Start Product-Slider -->
                                <div class="col-12 px-res-0">
                                    <div class="product-carousel carousel-md owl-carousel owl-theme">

                                        @foreach($lastSale as $item)
                                            <div class="item">
                                                <div class="product-card">
                                                    <div class="product-head">
                                                        <div class="rating-stars">
                                                            @for($i=1;$i<6;$i++)
                                                                <i class="mdi mdi-star {{$item->rate >= $i ?'active':''}}"></i>
                                                            @endfor
                                                        </div>
                                                        <div class="discount">
                                                            @if($item->discount>0)
                                                                <span>{{$item->discount}}%</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <a class="product-thumb"
                                                       href="{{route('site.product',['slug'=>$item->slug])}}">
                                                        @if($img=$item->images()->where('isMain',true)->first())
                                                            <img src="{{'/storage/'.$img->url}}"
                                                                 alt="Product Thumbnail">
                                                        @else
                                                            <img src="{{asset('/store/assets/product_nullable.png')}}"
                                                                 alt="Product Thumbnail">
                                                        @endif
                                                    </a>
                                                    <div class="product-card-body">
                                                        <h5 class="product-title">
                                                            <a href="{{route('site.product',['slug'=>$item->slug])}}">
                                                                {{$item->title}}
                                                            </a>
                                                        </h5>
                                                        <a class="product-meta" href="shop-categories.html">
                                                            {{$item->category->title}}
                                                        </a>
                                                        <span class="product-price">
                                                        {{number_format($item->price)}}
                                                            تومان
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                                <!-- End Product-Slider -->

                            </div>
                        </section>
                    </div>

                    @if($instant_offer->value != '0')
                        <div class="col-xl-2 col-lg-3 hidden-lg pr-0">
                            <div class="widget-suggestion dt-sn pt-3 mt-3">
                                <div class="widget-suggestion-title">
                                    <img src="{{asset('store/assets/img/theme/suggestion-title.png')}}" alt="">
                                </div>
                                <div id="progressBar">
                                    <div class="slide-progress"></div>
                                </div>
                                <div id="suggestion-slider" class="owl-carousel owl-theme">
                                    @foreach($instant_products as $item)
                                        <div class="item">
                                            <div class="product-card mb-3 shadow-unset">
                                                <div class="product-head">
                                                    <div class="rating-stars">
                                                        @for($i=1;$i<6;$i++)
                                                            <i class="mdi mdi-star {{$item->rate >= $i ?'active':''}}"></i>
                                                        @endfor
                                                    </div>
                                                    <div class="discount">
                                                        @if($item->discount>0)
                                                            <span>{{$item->discount}}%</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <a class="product-thumb"
                                                   href="{{route('site.product',['slug'=>$item->slug])}}">
                                                    @if($img=$item->images()->where('isMain',true)->first())
                                                        <img src="{{'/storage/'.$img->url}}"
                                                             alt="Product Thumbnail">
                                                    @else
                                                        <img src="{{asset('/store/assets/product_nullable.png')}}"
                                                             alt="Product Thumbnail">
                                                    @endif
                                                </a>


                                                <div class="product-card-body">
                                                    <h5 class="product-title">
                                                        <a href="{{route('site.product',['slug'=>$item->slug])}}">
                                                            {{$item->title}}
                                                        </a>
                                                    </h5>
                                                    <a class="product-meta" href="shop-categories.html">
                                                        {{$item->category->title}}
                                                    </a>
                                                    <span class="product-price">
                                                        {{number_format($item->price)}}
                                                        تومان
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        <!-- End Product-Slider -->

            <!-- Start Banner -->

            <div class="row  mb-5">
                @foreach($index_section_one_image_ads as $item)
                    <?php
                    if ($item->col == '12') {
                        $item_col = 'col-12';
                    } elseif ($item->col == '6') {
                        $item_col = 'col-sm-6 col-12';
                    } elseif ($item->col == '3') {
                        $item_col = 'col-sm-3 col-6';
                    }
                    ?>
                    <div class="{{$item_col}} mb-2 mt-3">
                        <div class="widget-banner">
                            <a href="{{$item->category ? route('site.getCat',['category_slug'=>$item->category->slug]):'#'}}">
                                <img title="{{$item->title}}" src="{{env('IMG').$item->image->url}}" alt="">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- End Banner -->

            <!-- End Banner -->

            <!-- Start Category-Section -->
            <div class="row mt-3 mb-5">
                <div class="col-12">
                    <div class="category-section dt-sn dt-sl">
                        <div class="category-section-title dt-sl">
                            <h3>بیش از ۱،۵۰۰،۰۰۰ کالا در دسته‌بندی‌های مختلف</h3>
                        </div>
                        <div class="category-section-slider dt-sl">
                            <div class="category-slider owl-carousel">
                                @foreach($category_ads as $item)
                                    <div class="item">
                                        <a href="#" class="promotion-category">
                                            <img src="{{'/storage/'.$item->image->url}}" alt="">
                                            <h4 class="promotion-category-name">{{$item->title}}</h4>
                                            <h6 class="promotion-category-quantity">{{$item->productCount}} کالا</h6>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Category-Section -->

            @foreach($categoryInAds as $categoryInAd)

                <section class="slider-section dt-sl mb-5">
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="section-title text-sm-title title-wide no-after-title-wide">
                                <h2>{{$categoryInAd->category->title}}</h2>
                                {{--<a href="#">مشاهده همه</a>--}}
                            </div>
                        </div>

                        <!-- Start Product-Slider -->
                        <div class="col-12">
                            <div class="product-carousel carousel-lg owl-carousel owl-theme">
                                @foreach($categoryInAd->category->products as $item)
                                    <div class="item">
                                        <div class="product-card mb-3">
                                            <div class="product-head">
                                                <div class="rating-stars">
                                                    @for($i=1;$i<6;$i++)
                                                        <i class="mdi mdi-star {{$item->rate >= $i ?'active':''}}"></i>
                                                    @endfor
                                                </div>
                                                <div class="discount">
                                                    @if($item->discount>0)
                                                        <span>{{$item->discount}}%</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <a class="product-thumb"
                                               href="{{route('site.product',['slug'=>$item->slug])}}">
                                                @if($img=$item->images()->where('isMain',true)->first())
                                                    <img src="{{'/storage/'.$img->url}}"
                                                         alt="Product Thumbnail">
                                                @else
                                                    <img src="{{asset('/store/assets/product_nullable.png')}}"
                                                         alt="Product Thumbnail">
                                                @endif
                                            </a>
                                            <div class="product-card-body">
                                                <h5 class="product-title">
                                                    <a href="{{route('site.product',['slug'=>$item->slug])}}">
                                                        {{$item->title}}
                                                    </a>
                                                </h5>
                                                <a class="product-meta" href="shop-categories.html">
                                                    {{$item->category->title}}
                                                </a>
                                                <span class="product-price">
                                                 {{number_format($item->price)}}
                                                    تومان
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- End Product-Slider -->

                    </div>
                </section>
                <!-- End Product-Slider -->
        @endforeach

        <!-- Start Banner -->
            <div class="row mt-3 mb-5">
                @foreach($index_section_two_image_ads as $item)

                    <?php
                    if ($item->col == '12') {
                        $item_col = 'col-12';
                    } elseif ($item->col == '6') {
                        $item_col = 'col-sm-6 col-12';
                    } elseif ($item->col == '3') {
                        $item_col = 'col-sm-3 col-6';
                    }
                    ?>

                    <div class="{{$item_col}}">
                        <div class="widget-banner">
                            <a href="{{$item->link}}">
                                <img src="{{env('IMG').$item->image->url}}" alt="">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- End Banner -->

            <!-- Start Product-Slider -->
            <section class="slider-section dt-sl mb-5">
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="section-title text-sm-title title-wide no-after-title-wide">
                            <h2>پر بازدید ترینها</h2>
                            {{--<a href="#">مشاهده همه</a>--}}
                        </div>
                    </div>

                    <!-- Start Product-Slider -->
                    <div class="col-12">
                        <div class="product-carousel carousel-lg owl-carousel owl-theme">
                            @foreach($lastViews as $item)
                                <div class="item">
                                    <div class="product-card mb-3">
                                        <div class="product-head">
                                            <div class="rating-stars">
                                                @for($i=1;$i<6;$i++)
                                                    <i class="mdi mdi-star {{$item->rate >= $i ?'active':''}}"></i>
                                                @endfor
                                            </div>
                                            <div class="discount">
                                                @if($item->discount>0)
                                                    <span>{{$item->discount}}%</span>
                                                @endif
                                            </div>
                                        </div>
                                        <a class="product-thumb" href="{{route('site.product',['slug'=>$item->slug])}}">
                                            @if($img=$item->images()->where('isMain',true)->first())
                                                <img src="{{'/storage/'.$img->url}}"
                                                     alt="Product Thumbnail">
                                            @else
                                                <img src="{{asset('/store/assets/product_nullable.png')}}"
                                                     alt="Product Thumbnail">
                                            @endif
                                        </a>
                                        <div class="product-card-body">
                                            <h5 class="product-title">
                                                <a href="{{route('site.product',['slug'=>$item->slug])}}">
                                                    {{$item->title}}
                                                </a>
                                            </h5>
                                            <a class="product-meta" href="shop-categories.html">
                                                {{$item->category->title}}
                                            </a>
                                            <span class="product-price">
                                                        {{number_format($item->price)}}
                                                تومان
                                                    </span>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                    <!-- End Product-Slider -->

                </div>
            </section>
            <!-- End Product-Slider -->

            <!-- Start Brand-Slider -->
            <section class="slider-section dt-sl mb-5">
                <div class="row">
                    <!-- Start Product-Slider -->
                    <div class="col-12">
                        <div class="brand-slider carousel-lg owl-carousel owl-theme">
                            @foreach($brands as $brand)
                                <div class="item">
                                    <img title="{{$item->title}}" src="{{'/storage/'.$brand->image->url}}"
                                         class="img-fluid" alt="">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- End Product-Slider -->

                </div>
            </section>
            <!-- End Brand-Slider -->


            <!-- Start Feature-Product -->
        {{--<section class="dt-sl dt-sn mb-5">--}}
        {{--<div class="row">--}}
        {{--<div class="col-12">--}}
        {{--<div class="section-title text-sm-title title-wide no-after-title-wide">--}}
        {{--<h2>پیشنهاد ما</h2>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row mb-3">--}}
        {{--<div class="col-lg-4 col-md-6 col-sm-12 col-12 pt-4">--}}
        {{--<div class="row">--}}
        {{--<div class="col-12">--}}
        {{--<div class="card-horizontal-product">--}}
        {{--<div class="card-horizontal-product-thumb">--}}
        {{--<a href="#">--}}
        {{--<img src="{{asset('store/assets/img/products/017.jpg')}}" alt="">--}}
        {{--</a>--}}
        {{--</div>--}}
        {{--<div class="card-horizontal-product-content">--}}
        {{--<div class="card-horizontal-product-title">--}}
        {{--<a href="#">--}}
        {{--<h3>کت مردانه مجلسی مدل k-m-5110</h3>--}}
        {{--</a>--}}
        {{--</div>--}}
        {{--<div class="rating-stars">--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star"></i>--}}
        {{--</div>--}}
        {{--<div class="card-horizontal-product-price">--}}
        {{--<span>199,000 تومان</span>--}}
        {{--</div>--}}
        {{--<div class="card-horizontal-product-buttons">--}}
        {{--<a href="#" class="btn btn-outline-info">جزئیات محصول</a>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-12">--}}
        {{--<div class="card-horizontal-product">--}}
        {{--<div class="card-horizontal-product-thumb">--}}
        {{--<a href="#">--}}
        {{--<img src="{{asset('store/assets/img/products/020.jpg')}}" alt="">--}}
        {{--</a>--}}
        {{--</div>--}}
        {{--<div class="card-horizontal-product-content">--}}
        {{--<div class="card-horizontal-product-title">--}}
        {{--<a href="#">--}}
        {{--<h3>کت مردانه مجلسی مدل k-m-5110</h3>--}}
        {{--</a>--}}
        {{--</div>--}}
        {{--<div class="rating-stars">--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star"></i>--}}
        {{--</div>--}}
        {{--<div class="card-horizontal-product-price">--}}
        {{--<span>199,000 تومان</span>--}}
        {{--</div>--}}
        {{--<div class="card-horizontal-product-buttons">--}}
        {{--<a href="#" class="btn btn-outline-info">جزئیات محصول</a>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-12">--}}
        {{--<div class="card-horizontal-product">--}}
        {{--<div class="card-horizontal-product-thumb">--}}
        {{--<a href="#">--}}
        {{--<img src="{{asset('store/assets/img/products/014.jpg')}}" alt="">--}}
        {{--</a>--}}
        {{--</div>--}}
        {{--<div class="card-horizontal-product-content">--}}
        {{--<div class="card-horizontal-product-title">--}}
        {{--<a href="#">--}}
        {{--<h3>کت مردانه مجلسی مدل k-m-5110</h3>--}}
        {{--</a>--}}
        {{--</div>--}}
        {{--<div class="rating-stars">--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star"></i>--}}
        {{--</div>--}}
        {{--<div class="card-horizontal-product-price">--}}
        {{--<span>199,000 تومان</span>--}}
        {{--</div>--}}
        {{--<div class="card-horizontal-product-buttons">--}}
        {{--<a href="#" class="btn btn-outline-info">جزئیات محصول</a>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-lg-4 col-md-6 col-sm-12 col-12 pt-4">--}}
        {{--<div class="row">--}}
        {{--<div class="col-12">--}}
        {{--<div class="card-horizontal-product">--}}
        {{--<div class="card-horizontal-product-thumb">--}}
        {{--<a href="#">--}}
        {{--<img src="{{asset('store/assets/img/products/016.jpg')}}" alt="">--}}
        {{--</a>--}}
        {{--</div>--}}
        {{--<div class="card-horizontal-product-content">--}}
        {{--<div class="card-horizontal-product-title">--}}
        {{--<a href="#">--}}
        {{--<h3>کت مردانه مجلسی مدل k-m-5110</h3>--}}
        {{--</a>--}}
        {{--</div>--}}
        {{--<div class="rating-stars">--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star"></i>--}}
        {{--</div>--}}
        {{--<div class="card-horizontal-product-price">--}}
        {{--<span>199,000 تومان</span>--}}
        {{--</div>--}}
        {{--<div class="card-horizontal-product-buttons">--}}
        {{--<a href="#" class="btn btn-outline-info">جزئیات محصول</a>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-12">--}}
        {{--<div class="card-horizontal-product">--}}
        {{--<div class="card-horizontal-product-thumb">--}}
        {{--<a href="#">--}}
        {{--<img src="{{asset('store/assets/img/products/018.jpg')}}" alt="">--}}
        {{--</a>--}}
        {{--</div>--}}
        {{--<div class="card-horizontal-product-content">--}}
        {{--<div class="card-horizontal-product-title">--}}
        {{--<a href="#">--}}
        {{--<h3>کت مردانه مجلسی مدل k-m-5110</h3>--}}
        {{--</a>--}}
        {{--</div>--}}
        {{--<div class="rating-stars">--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star"></i>--}}
        {{--</div>--}}
        {{--<div class="card-horizontal-product-price">--}}
        {{--<span>199,000 تومان</span>--}}
        {{--</div>--}}
        {{--<div class="card-horizontal-product-buttons">--}}
        {{--<a href="#" class="btn btn-outline-info">جزئیات محصول</a>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-12">--}}
        {{--<div class="card-horizontal-product">--}}
        {{--<div class="card-horizontal-product-thumb">--}}
        {{--<a href="#">--}}
        {{--<img src="{{asset('store/assets/img/products/015.jpg')}}" alt="">--}}
        {{--</a>--}}
        {{--</div>--}}
        {{--<div class="card-horizontal-product-content">--}}
        {{--<div class="card-horizontal-product-title">--}}
        {{--<a href="#">--}}
        {{--<h3>کت مردانه مجلسی مدل k-m-5110</h3>--}}
        {{--</a>--}}
        {{--</div>--}}
        {{--<div class="rating-stars">--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star"></i>--}}
        {{--</div>--}}
        {{--<div class="card-horizontal-product-price">--}}
        {{--<span>199,000 تومان</span>--}}
        {{--</div>--}}
        {{--<div class="card-horizontal-product-buttons">--}}
        {{--<a href="#" class="btn btn-outline-info">جزئیات محصول</a>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-lg-4 col-md-6 col-sm-12 col-12 pt-4">--}}
        {{--<div class="row">--}}
        {{--<div class="col-12">--}}
        {{--<div class="card-horizontal-product">--}}
        {{--<div class="card-horizontal-product-thumb">--}}
        {{--<a href="#">--}}
        {{--<img src="{{asset('store/assets/img/products/017.jpg')}}" alt="">--}}
        {{--</a>--}}
        {{--</div>--}}
        {{--<div class="card-horizontal-product-content">--}}
        {{--<div class="card-horizontal-product-title">--}}
        {{--<a href="#">--}}
        {{--<h3>کت مردانه مجلسی مدل k-m-5110</h3>--}}
        {{--</a>--}}
        {{--</div>--}}
        {{--<div class="rating-stars">--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star"></i>--}}
        {{--</div>--}}
        {{--<div class="card-horizontal-product-price">--}}
        {{--<span>199,000 تومان</span>--}}
        {{--</div>--}}
        {{--<div class="card-horizontal-product-buttons">--}}
        {{--<a href="#" class="btn btn-outline-info">جزئیات محصول</a>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-12">--}}
        {{--<div class="card-horizontal-product">--}}
        {{--<div class="card-horizontal-product-thumb">--}}
        {{--<a href="#">--}}
        {{--<img src="{{asset('store/assets/img/products/020.jpg')}}" alt="">--}}
        {{--</a>--}}
        {{--</div>--}}
        {{--<div class="card-horizontal-product-content">--}}
        {{--<div class="card-horizontal-product-title">--}}
        {{--<a href="#">--}}
        {{--<h3>کت مردانه مجلسی مدل k-m-5110</h3>--}}
        {{--</a>--}}
        {{--</div>--}}
        {{--<div class="rating-stars">--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star"></i>--}}
        {{--</div>--}}
        {{--<div class="card-horizontal-product-price">--}}
        {{--<span>199,000 تومان</span>--}}
        {{--</div>--}}
        {{--<div class="card-horizontal-product-buttons">--}}
        {{--<a href="#" class="btn btn-outline-info">جزئیات محصول</a>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-12">--}}
        {{--<div class="card-horizontal-product">--}}
        {{--<div class="card-horizontal-product-thumb">--}}
        {{--<a href="#">--}}
        {{--<img src="{{asset('store/assets/img/products/014.jpg')}}" alt="">--}}
        {{--</a>--}}
        {{--</div>--}}
        {{--<div class="card-horizontal-product-content">--}}
        {{--<div class="card-horizontal-product-title">--}}
        {{--<a href="#">--}}
        {{--<h3>کت مردانه مجلسی مدل k-m-5110</h3>--}}
        {{--</a>--}}
        {{--</div>--}}
        {{--<div class="rating-stars">--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star active"></i>--}}
        {{--<i class="mdi mdi-star"></i>--}}
        {{--</div>--}}
        {{--<div class="card-horizontal-product-price">--}}
        {{--<span>199,000 تومان</span>--}}
        {{--</div>--}}
        {{--<div class="card-horizontal-product-buttons">--}}
        {{--<a href="#" class="btn btn-outline-info">جزئیات محصول</a>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</section>--}}
        <!-- End Feature-Product -->
        </div>
    </main>
@endsection