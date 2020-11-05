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
                                <img src="{{env('IMG').\App\Models\Config::where('key','app_logo')->first()->value}}" alt="">
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
                            <li>
                                <a href="#">
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


                <shopping :addresses="{{$addresses}}"
                          :default_address="{{$default_address?$default_address:'0'}}"
                          :send_types="{{$send_types}}"
                          :default_send_type="{{$send_type}}"

                >
                    {{--<div class="products-compact-slider carousel-md owl-carousel owl-theme">--}}
                        {{--@foreach($products as $product)--}}
                            {{--<div class="item">--}}
                                {{--<div class="product-card mb-3">--}}
                                    {{--<a class="product-thumb" href="{{route('site.product',['slug'=>$product->slug])}}">--}}
                                        {{--<img src="{{env('IMG').$product->main_image[0]->url}}"--}}
                                             {{--alt="Product Thumbnail">--}}
                                    {{--</a>--}}
                                    {{--<div class="product-card-body">--}}
                                        {{--<h5 class="product-title">--}}
                                            {{--<a href="{{route('site.product',['product'])}}">--}}
                                                {{--{{$product->title}}--}}
                                            {{--</a>--}}
                                        {{--</h5>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@endforeach--}}
                    {{--</div>--}}
                </shopping>

            <!-- Start Modal location edit -->
            {{--@include('store.address_actions.edit')--}}
                <!-- End Modal location edit -->


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

    {{--<script>--}}
        {{--$('#modal-location-edit').on('show.bs.modal', function (event) {--}}
            {{--let button = $(event.relatedTarget);--}}
            {{--let address_id = button.data('address_id');--}}
            {{--let receiver = button.data('receiver');--}}
            {{--let mobile = button.data('mobile');--}}
            {{--let postal_code = button.data('postal_code');--}}
            {{--let address = button.data('address');--}}
            {{--let state_id = button.data('state_id');--}}
            {{--let city_id = button.data('city_id');--}}

            {{--// console.log(city_id);--}}
            {{--let modal = $(this);--}}

            {{--modal.find('form').attr('action',"/profile/address/"+address_id+"/update");--}}
            {{--modal.find('input[name=receiver]').val(receiver);--}}
            {{--modal.find('input[name=mobile]').val(mobile);--}}
            {{--modal.find('input[name=postal_code]').val(postal_code);--}}
            {{--modal.find('textarea[name=address]').text(address);--}}

            {{--modal.find('city-selection').attr('city_id',city_id);--}}
            {{--modal.find('#CitySelection').attr('state_id',state_id);--}}

        {{--})--}}
    {{--</script>--}}
@endsection