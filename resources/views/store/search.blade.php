@extends('store.master')
@section('content')
    <main class="main-content dt-sl mt-4 mb-3">
        <div class="container main-container">

            <div class="row">

                <!-- Start Sidebar -->
                <div class="col-lg-3 col-md-12 col-sm-12 sticky-sidebar">

                    <div class="dt-sn mb-3"
                         @if(sizeof($_GET)==0 || (sizeof($_GET)==1) && array_key_exists('page',$_GET)) style="display: none" @endif >
                        <div class="col-12">
                            <div class="item_box" id="filter_div">
                                <div class="title_box">
                                    <label>فیلتر های اعمال شده</label>
                                    <span id="remove_all_filter">حذف</span>
                                </div>
                                <div id="selected_filter_box">

                                </div>
                            </div>
                        </div>
                    </div>

                    @if(isset($category) && sizeof($category->children)>0)
                        <div class="dt-sn mb-3">
                            <div class="col-12">

                                <div class="item_box">
                                    <div class="title_box">
                                        <label>دسته بندی</label>
                                    </div>
                                    <ul class="search_category_ul">
                                        <li class="parent">
                                            <i class="mdi mdi-arrow-left"></i>
                                            <a href="{{ route('site.getCat',['category_slug'=>$category->slug]) }}">{{ $category->title }}</a>
                                            <ul>
                                                @foreach($category->children as $cat)
                                                    <li>
                                                        <a href="{{ route('site.getCat',['category_slug'=>$cat->slug]) }}">{{ $cat->title }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    @endif


                    <div class="dt-sn mb-3">
                        {{--<form action="">--}}
                        <div class="col-12">
                            <div class="section-title text-sm-title title-wide mb-1 no-after-title-wide">
                                <h2>جست و جو در نتایج:</h2>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="widget-search">
                                <input type="text" name="s"
                                       @if(array_key_exists('string',$_GET)) value="{{ $_GET['string'] }}" @endif
                                       id="search_input"
                                       placeholder="نام محصول یا برند مورد نظر را بنویسید...">
                                {{--<button class="btn-search-widget" type="button">--}}
                                {{--<img src="/store/assets/img/theme/search.png" alt="">--}}
                                {{--</button>--}}
                            </div>
                        </div>


                        <div class="col-12 mb-3">
                            <div class="parent-switcher">
                                <label class="ui-statusswitcher">
                                    <input type="checkbox" id="switcher-hasProduct">
                                    <span class="ui-statusswitcher-slider">
                                                <span class="ui-statusswitcher-slider-toggle"></span>
                                            </span>
                                </label>
                                <label class="label-switcher" for="switcher-hasProduct">فقط کالاهای موجود</label>
                            </div>
                        </div>

                        {{--</form>--}}
                    </div>


                    @if(isset($filter))
                        <div class="dt-sn mb-3">
                            <form action="">
                                <div class="col-12 filter-product mb-3">
                                    <div class="section-title text-sm-title title-wide no-after-title-wide mb-1">
                                        <h2>فیلتر پیشرفته :</h2>
                                    </div>
                                    <div class="accordion" id="accordionExample">
                                        @foreach($filter as $key=>$value)
                                            <div class="card item_box">
                                                <div class="card-header" id="heading{{$key}}">
                                                    <h2 class="mb-0">
                                                        <button class="btn btn-block text-right collapsed title_box" type="button"
                                                                data-toggle="collapse" data-target="#collapse{{$key}}"
                                                                aria-expanded="false" aria-controls="collapse{{$key}}">
                                                            {{ $value->title }}
                                                            <i class="mdi mdi-chevron-down"></i>
                                                        </button>
                                                    </h2>
                                                </div>
                                                <div id="collapse{{$key}}" class="collapse filter_box"
                                                     aria-labelledby="heading{{$key}}"
                                                     data-parent="#accordionExample">
                                                    <div class="card-body ">
                                                        {{--<div class="custom-control custom-checkbox">--}}
                                                        {{--<input type="checkbox" class="custom-control-input"--}}
                                                        {{--id="{{$value->id}}customCheck">--}}
                                                        {{--<label class="custom-control-label"--}}
                                                        {{--for="{{$value->id}}customCheck">همه</label>--}}
                                                        {{--</div>--}}
                                                        <ul class="list-inline product_cat_ul">
                                                            @foreach($value->defaults as $key2=>$value2)
                                                                <?php
                                                                $filter_key = 'attribute[' . $value->id . ']';
                                                                ?>
                                                                {{--<div class="custom-control custom-checkbox product_filter"--}}
                                                                {{--data="{{ $filter_key }}_param_{{ $value2->id }}">--}}
                                                                {{--<input type="checkbox" class="custom-control-input"--}}
                                                                {{--id="{{$value->id}}customCheck_{{ $value2->id }}">--}}
                                                                {{--<label class="custom-control-label" for="{{$value->id}}customCheck_{{ $value2->id }}">--}}
                                                                {{--{{ $value2->value }}--}}
                                                                {{--</label>--}}
                                                                {{--</div>--}}
                                                                <li data="{{ $filter_key }}_param_{{ $value2->id }}">
                                                                    <span class="check_box"></span>
                                                                    <span class="title">{{ $value2->value }}</span>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif

                    <div class="dt-sn mb-3">
                        {{--<form action="">--}}


                        <div class="col-12 mb-4">
                            <div class="section-title text-sm-title title-wide no-after-title-wide mb-1">
                                <h2>فیلتر براساس قیمت :</h2>
                            </div>
                            <div class="mt-2 mb-2">
                                <div id="slider-non-linear-step"></div>
                            </div>
                            <div class="mt-2 mb-2 text-center pt-2">
                                <span>قیمت: </span>
                                <span class="example-val" id="slider-non-linear-step-value"></span> تومان
                            </div>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-info btn-block" type="button" id="price_filter_btn">
                                اعمال محدوده قیمت
                            </button>
                        </div>

                        {{--</form>--}}
                    </div>
                </div>
                <!-- End Sidebar -->

                <!-- Start Content -->
                <div class="col-lg-9 col-md-12 col-sm-12 search-card-res">
                    <product-box></product-box>
                </div>
                <!-- End Content -->
            </div>

        </div>
    </main>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('store/assets/css/vendor/nouislider.min.css')}}">
@endsection
@section('script')
    <script src="{{asset('store/assets/js/vendor/nouislider.min.js')}}"></script>
    <script src="{{asset('store/assets/js/vendor/wNumb.js')}}"></script>
    <script src="{{asset('store/assets/js/vendor/ResizeSensor.min.js')}}"></script>
    <script src="{{asset('store/assets/js/vendor/theia-sticky-sidebar.min.js')}}"></script>

    {{--<script>--}}
    {{--$(document).ready(function () {--}}
    {{--var nonLinearStepSlider = document.getElementById('slider-non-linear-step');--}}

    {{--noUiSlider.create(nonLinearStepSlider, {--}}
    {{--start: [0, 20000],--}}
    {{--connect: true,--}}
    {{--direction: 'rtl',--}}
    {{--format: wNumb({--}}
    {{--decimals: 0,--}}
    {{--thousand: ','--}}
    {{--}),--}}
    {{--range: {--}}
    {{--'min': [0],--}}
    {{--'10%': [500, 500],--}}
    {{--'50%': [40000, 1000],--}}
    {{--'max': [1000000]--}}
    {{--}--}}
    {{--});--}}
    {{--var nonLinearStepSliderValueElement = document.getElementById('slider-non-linear-step-value');--}}

    {{--nonLinearStepSlider.noUiSlider.on('update', function (values) {--}}
    {{--nonLinearStepSliderValueElement.innerHTML = values.join(' - ');--}}
    {{--});--}}
    {{--});--}}
    {{--</script>--}}
@endsection
