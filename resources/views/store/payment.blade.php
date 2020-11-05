@extends('store.master',['show'=>false,'mini'=>true])
@section('css')
    <link rel="stylesheet" href="{{asset('store/assets/css/vendor/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('store/assets/css/vendor/nouislider.min.css')}}">
@endsection
@section('content')
    <!-- Start header-shopping -->
    <div class="shopping-page">
        <header class="header-shopping dt-sl ">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center pt-2">
                        <div class="header-shopping-logo dt-sl">
                            <a href="/">
                                <img src="{{asset('/store/assets/img/logo.png')}}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <ul class="checkout-steps">
                            <li>
                                <a href="#" class="active">
                                    <span>اطلاعات ارسال</span>
                                </a>
                            </li>
                            <li class="active">
                                <a href="#" class="active">
                                    <span>پرداخت</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span>اتمام خرید و ارسال</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <!-- End header-shopping -->

        <!-- Start main-content -->
        <main class="main-content dt-sl mt-4 mb-3">
            <div class="container main-container">

                <payment
                        send_type_price="{{$send_type->price}}"
                        payment_action="{{route('site.get-pay')}}"
                        has_needy="{{session()->has('hasNeedy')?session()->get('hasNeedy'):0}}"
                >
                    <div>
                        <div class="section-title text-sm-title title-wide no-after-title-wide mb-0 px-res-1">
                            <h2>خلاصه سفارش</h2>
                        </div>
                        <div class="dt-sn pt-3 pb-5">
                            <div class="checkout-order-summary">
                                <div class="accordion checkout-order-summary-item" id="accordionExample">
                                    <div class="card pt-sl-res">
                                        <div class="card-header checkout-order-summary-header" id="headingOne">
                                            <h2 class="mb-0">
                                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                                        data-target="#collapseOne" aria-expanded="false"
                                                        aria-controls="collapseOne">
                                                    <div class="checkout-order-summary-row">
                                                        <div
                                                                class="checkout-order-summary-col checkout-order-summary-col-post-time">
                                                            مرسوله
                                                            <span class="fs-sm">({{sizeof($products)}} کالا)</span>
                                                        </div>
                                                        <div
                                                                class="checkout-order-summary-col checkout-order-summary-col-how-to-send">
                                                            <span class="dl-none-sm">نحوه ارسال</span>
                                                            <span class="dl-none-sm">
                                                                {{$send_type->title}}
                                                                </span>
                                                        </div>
                                                        {{--<div--}}
                                                                {{--class="checkout-order-summary-col checkout-order-summary-col-how-to-send">--}}
                                                            {{--<span>ارسال از</span>--}}
                                                            {{--<span class="fs-sm">--}}
                                                                    {{--2 روز کاری--}}
                                                                {{--</span>--}}
                                                        {{--</div>--}}
                                                        <div
                                                                class="checkout-order-summary-col checkout-order-summary-col-shipping-cost">
                                                            <span>هزینه ارسال</span>
                                                            <span class="fs-sm">
                                                                    {{number_format($send_type->price)}}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <i class="mdi mdi-chevron-down icon-down"></i>
                                                </button>
                                            </h2>
                                        </div>

                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                             data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="box">
                                                    <div class="row">
                                                        @foreach($products as $product)
                                                            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                                                <div class="product-box-container">
                                                                    <div class="product-box product-box-compact">
                                                                        <a class="product-box-img"
                                                                           href="{{route('site.product',['slug'=>$product->slug])}}">
                                                                            <img src="{{env('IMG').$product->main_image[0]->url}}">
                                                                        </a>
                                                                        <div class="product-box-title">
                                                                            {{$product->title}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </payment>

            </div>
        </main>
    </div>
@endsection

@section('script')
    <script src="{{asset('store/assets/js/vendor/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('store/assets/js/vendor/nouislider.min.js')}}"></script>
    <script src="{{asset('store/assets/js/vendor/wNumb.js')}}"></script>
    <script src="{{asset('store/assets/js/vendor/ResizeSensor.min.js')}}"></script>
    <script src="{{asset('store/assets/js/vendor/theia-sticky-sidebar.min.js')}}"></script>
@endsection