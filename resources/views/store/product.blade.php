@extends('store.master')
@section('content')
    <main class="main-content dt-sl mt-4 mb-3">
        <div class="container main-container">
            <!-- Start title - breadcrumb -->
            <div class="title-breadcrumb-special dt-sl mb-3">
                <div class="breadcrumb dt-sl">
                    <nav>
                        @foreach($category_line as $line)
                            <a href="#">{{$line->title}}</a>
                        @endforeach
                        <a href="{{route('site.product',['slug'=>$product->slug])}}">
                            {{$product->title}}
                        </a>
                    </nav>
                </div>
            </div>
            <!-- End title - breadcrumb -->

            <!-- Start Product -->
            <div class="dt-sn mb-5 dt-sl">
                <div class="row">
                    <!-- Product Gallery-->
                    <div class="col-lg-4 col-md-6 pb-5 ps-relative">
                        <!-- Product Options-->
                        <ul class="gallery-options">
                            <product-favorite-btn
                                    product_id="{{$product->id}}"
                                    auth="{{auth()->check()}}"
                                    is_favorite="{{$is_favorite}}"
                            ></product-favorite-btn>
                        </ul>
                        <div class="product-timeout position-relative pt-5 mb-3">
                            {{--<div class="promotion-badge">--}}
                            {{--فروش ویژه--}}
                            {{--</div>--}}
                            {{--<div class="countdown-timer" countdown data-date="10 24 2020 20:20:22">--}}
                            {{--<span data-days>0</span>:--}}
                            {{--<span data-hours>0</span>:--}}
                            {{--<span data-minutes>0</span>:--}}
                            {{--<span data-seconds>0</span>--}}
                            {{--</div>--}}
                        </div>
                        <div class="product-gallery">
                            {{--<span class="badge">پر فروش</span>--}}
                            <div class="product-carousel owl-carousel">
                                @foreach($product->images as $key=>$image)
                                    <div class="item">
                                        <a class="gallery-item" href="{{env('IMG').$image->url}}"
                                           data-fancybox="gallery1" data-hash="IMG{{$key}}">
                                            <img src="{{env('IMG').$image->url}}" alt="Product">
                                        </a>
                                    </div>
                                @endforeach

                            </div>
                            <ul class="product-thumbnails">
                                @foreach($product->images as $key=>$image)
                                    <li class="active">
                                        <a href="#IMG{{$key}}" style="display: inline-table;">
                                            <img src="{{env('IMG').$image->url}}" alt="Product">
                                        </a>
                                    </li>
                                @endforeach
                                {{--<li>--}}
                                {{--<a class="navi-link text-sm" href="./assets/video/download.mp4" data-fancybox--}}
                                {{--data-width="960" data-height="640">--}}
                                {{--<i class="mdi mdi-video text-lg d-block mb-1"></i>--}}
                                {{--</a>--}}
                                {{--</li>--}}
                            </ul>
                        </div>
                    </div>
                    <!-- Product Info -->
                    <div class="col-lg-8 col-md-6 pb-5">
                        <div class="product-info dt-sl">
                            <div class="product-title dt-sl">
                                <h1>
                                    {{$product->title}}
                                </h1>
                                <h3>
                                    {{$product->title_en}}
                                </h3>
                            </div>

                            <div class="row">
                                <div class="col-lg-8 col-md-12">
                                    <div class="product-variant dt-sl">
                                        {{--<div class="section-title text-sm-title title-wide no-after-title-wide mb-0">--}}
                                        {{--<h2>انتخاب رنگ:</h2>--}}
                                        {{--</div>--}}
                                        {{--<ul class="product-variants float-right ml-3">--}}
                                        {{--<li class="ui-variant">--}}
                                        {{--<label class="ui-variant ui-variant--color">--}}
                                        {{--<span class="ui-variant-shape" style="background-color: #212121"></span>--}}
                                        {{--<input type="radio" value="1" name="color" class="variant-selector"--}}
                                        {{--checked>--}}
                                        {{--<span class="ui-variant--check">مشکی</span>--}}
                                        {{--</label>--}}
                                        {{--</li>--}}
                                        {{--<li class="ui-variant">--}}
                                        {{--<label class="ui-variant ui-variant--color">--}}
                                        {{--<span class="ui-variant-shape" style="background-color: #f6f6f6"></span>--}}
                                        {{--<input type="radio" value="3" name="color" class="variant-selector">--}}
                                        {{--<span class="ui-variant--check">سفید</span>--}}
                                        {{--</label>--}}
                                        {{--</li>--}}
                                        {{--<li class="ui-variant">--}}
                                        {{--<label class="ui-variant ui-variant--color">--}}
                                        {{--<span class="ui-variant-shape" style="background-color: #2196f3"></span>--}}
                                        {{--<input type="radio" value="4" name="color" class="variant-selector">--}}
                                        {{--<span class="ui-variant--check">آبی</span>--}}
                                        {{--</label>--}}
                                        {{--</li>--}}
                                        {{--</ul>--}}
                                    </div>
                                    <div class="product-params dt-sl">
                                        <ul data-title="ویژگی‌های محصول">
                                            @foreach($property_values as $property_value)
                                                @if($property_value->property->showBanner)
                                                    <li>
                                                        <span>{{$property_value->property->title}}: </span>
                                                        <span>{{$property_value->value}}</span>
                                                    </li>
                                                @endif
                                            @endforeach

                                        </ul>
                                        <div class="sum-more">
                                        <span class="show-more btn-link-border">
                                            + موارد بیشتر
                                        </span>
                                            <span class="show-less btn-link-border">
                                            - بستن
                                        </span>
                                        </div>
                                    </div>

                                    <div class="section-title text-sm-title title-wide no-after-title-wide mb-0 dt-sl">
                                        {{--<h2>کد محصول:225566</h2>--}}
                                    </div>
                                    <div class="section-title text-sm-title title-wide no-after-title-wide mb-0 dt-sl">
                                        <h2>
                                            قیمت :
                                            <span class="price">
                                        {{number_format($product->price*(1-$product->discount/100))}}
                                                تومان
                                    </span>
                                            @if($product->discount > '0')
                                                <span class="" style="text-decoration: line-through">
                                            {{number_format($product->price)}}
                                                    تومان
                                        </span>
                                            @endif
                                        </h2>
                                    </div>
                                    <div class="section-title no-after-title-wide mb-0 needy-product-box mt-4 p-lg-3 dt-sl d-lg-none mb-3">
                                        <span class="text-center d-block">
                                            قیمت محصول برای نیازمندان
                                        </span>
                                        <span class="text-center d-block needy-product-box-price-section">
                                            <span class="needy-product-box-price">
                                            {{number_format($product['needy_price'])}}
                                            </span>
                                            تومان
                                        </span>
                                        <span class="text-center d-block needy-product-box-line"></span>
                                        <span class="text-center d-block helper-price-title mt-lg-2 py-1 py-md-0 py-1">
                                            مجموع مبالغ پرداختی خیّرها
                                            <span class="needy-product-box-price2">
                                            {{number_format($product['helper_price'])}}
                                            </span>
                                             تومان
                                        </span>
                                    </div>
                                    <div class="dt-sl mt-md-4 mt-2">
                                        @if($product->stock > 0)
                                            <add-or-remove-product-in-basket product_id="{{$product->id}}"
                                                                             has_in_basket="{{$has_in_basket}}"
                                                                             @basket-change="BasketChange"
                                            ></add-or-remove-product-in-basket>
                                        @else
                                            <a href="#" class="btn-primary-cm btn-with-icon" style="background-color: #ccc">
                                                <img src="/store/assets/img/theme/shopping-cart.png" alt="">
                                                اتمام موجودی
                                            </a>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-lg-4 d-none d-lg-block">
                                    <div class="no-after-title-wide mb-0 needy-product-box mt-4 p-lg-3">
                                        <span class="text-center d-sm-block">
                                            قیمت محصول برای نیازمندان
                                        </span>
                                        <span class="text-center d-sm-block needy-product-box-price-section">
                                            <span class="needy-product-box-price">
                                            {{number_format($product['needy_price'])}}
                                            </span>
                                            تومان
                                        </span>
                                        <span class="text-center d-sm-block needy-product-box-line"></span>
                                        <span class="text-center d-sm-block helper-price-title mt-lg-2">
                                            مجموع مبالغ پرداختی خیّرها
                                            <span class="needy-product-box-price2">
                                            {{number_format($product['helper_price'])}}
                                            </span>
                                             تومان
                                        </span>
                                    </div>
                                </div>
                            </div>


                        </div>


                    </div>
                </div>
            </div>
            <div class="dt-sn mb-5 px-0 dt-sl pt-0">
                <!-- Start tabs -->
                <section class="tabs-product-info mb-3 dt-sl">
                    <div class="ah-tab-wrapper dt-sl">
                        <div class="ah-tab dt-sl">
                            <a class="ah-tab-item" data-ah-tab-active="true" href="">
                                <i class="mdi mdi-glasses"></i>نقد و بررسی
                            </a>
                            <a class="ah-tab-item" href="">
                                <i class="mdi mdi-format-list-checks"></i>مشخصات
                            </a>
                            <a class="ah-tab-item" href="">
                                <i class="mdi mdi-comment-text-multiple-outline"></i>نظرات کاربران
                            </a>
                            <a class="ah-tab-item" href="">
                                <i class="mdi mdi-comment-question-outline"></i>پرسش و پاسخ
                            </a>
                        </div>
                    </div>
                    <div class="ah-tab-content-wrapper product-info px-4 dt-sl">

                        <div class="ah-tab-content dt-sl" data-ah-tab-active="true">
                            <div class="section-title text-sm-title title-wide no-after-title-wide mb-0 dt-sl">
                                <h2>نقد و بررسی</h2>
                            </div>
                            <div class="product-title dt-sl">
                                <h1>
                                    {{$product->title}}
                                </h1>
                                <h3>
                                    {{$product->title_en}}
                                </h3>
                            </div>
                            <div class="description-product dt-sl mt-3 mb-3">
                                <div class="container">
                                    {{--//--}}
                                </div>
                            </div>
                            <div class="accordion dt-sl accordion-product" id="accordionExample">
                                @foreach($product->productAdminReviews as $key=>$productAdminReview)
                                    <div class="card">
                                        <div class="card-header" id="heading{{$key}}">
                                            <h5 class="mb-0">
                                                <button class="btn {{$key==0?'':'collapsed'}}" type="button"
                                                        data-toggle="collapse"
                                                        data-target="#collapse{{$key}}" aria-expanded="false"
                                                        aria-controls="collapse{{$key}}">
                                                    {{$productAdminReview->title}}
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapse{{$key}}" class="collapse {{$key==0?'show':''}}"
                                             aria-labelledby="heading{{$key}}"
                                             data-parent="#accordionExample">
                                            <div class="card-body">
                                                {!! $productAdminReview->body !!}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="ah-tab-content params dt-sl">
                            <div class="section-title text-sm-title title-wide no-after-title-wide mb-0 dt-sl">
                                <h2>مشخصات فنی</h2>
                            </div>
                            <div class="product-title dt-sl mb-3">
                                <h1>
                                    {{$product->title}}
                                </h1>
                                <h3>
                                    {{$product->title_en}}
                                </h3>
                            </div>
                            <section>
                                {{--<h3 class="params-title">مشخصات کلی</h3>--}}


                                <ul class="params-list">
                                    @foreach($property_values as $property_value)
                                        <li>
                                            <div class="params-list-key">
                                                <span class="d-block">{{$property_value->property->title}}</span>
                                            </div>
                                            <div class="params-list-value">
                                                <span class="d-block">
                                                    {{$property_value->value}}
                                                </span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </section>

                        </div>

                        <div class="ah-tab-content comments-tab dt-sl">
                            <div class="section-title title-wide no-after-title-wide mb-0 dt-sl">
                                <h2>امتیاز کاربران به:</h2>
                            </div>
                            <div class="product-title dt-sl mb-3">
                                <h1>
                                    {{$product->title}}
                                </h1>
                                <h3>
                                    {{$product->title_en}}
                                    <span class="rate-product">
                                        (
                                        {{$product->rate}}
                                        از
                                        5
                                        |
                                        {{number_format($productReviews->count())}}
                                        نفر)
                                    </span>
                                </h3>
                            </div>
                            <div class="dt-sl">
                                <div class="row">
                                    {{--<div class="col-md-6 col-sm-12">--}}
                                    {{--<ul class="content-expert-rating">--}}
                                    {{--<li>--}}
                                    {{--<div class="cell">طراحی</div>--}}
                                    {{--<div class="cell">--}}
                                    {{--<div class="rating rating--general" data-rate-digit="عالی">--}}
                                    {{--<div class="rating-rate" data-rate-value="100%"--}}
                                    {{--style="width: 70%;"></div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                    {{--<div class="cell">ارزش خرید</div>--}}
                                    {{--<div class="cell">--}}
                                    {{--<div class="rating rating--general" data-rate-digit="عالی">--}}
                                    {{--<div class="rating-rate" data-rate-value="100%"--}}
                                    {{--style="width: 20%;"></div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                    {{--<div class="cell">کیفیت ساخت</div>--}}
                                    {{--<div class="cell">--}}
                                    {{--<div class="rating rating--general" data-rate-digit="عالی">--}}
                                    {{--<div class="rating-rate" data-rate-value="100%"--}}
                                    {{--style="width: 100%;"></div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                    {{--<div class="cell">صدای مزاحم</div>--}}
                                    {{--<div class="cell">--}}
                                    {{--<div class="rating rating--general" data-rate-digit="عالی">--}}
                                    {{--<div class="rating-rate" data-rate-value="100%"--}}
                                    {{--style="width: 100%;"></div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                    {{--<div class="cell">مصرف انرژی و آب</div>--}}
                                    {{--<div class="cell">--}}
                                    {{--<div class="rating rating--general" data-rate-digit="عالی">--}}
                                    {{--<div class="rating-rate" data-rate-value="100%"--}}
                                    {{--style="width: 100%;"></div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                    {{--<div class="cell">امکانات و قابلیت ها</div>--}}
                                    {{--<div class="cell">--}}
                                    {{--<div class="rating rating--general" data-rate-digit="عالی">--}}
                                    {{--<div class="rating-rate" data-rate-value="100%"--}}
                                    {{--style="width: 100%;"></div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--</li>--}}
                                    {{--</ul>--}}
                                    {{--</div>--}}
                                    <div class="col-md-6 col-sm-12 mb-4">
                                        <div class="comments-summary-note">
                                            <span>شما هم می‌توانید در مورد این کالا نظر بدهید.</span>
                                            @if(auth()->check())
                                                <div class="dt-sl mt-2">
                                                    <a href="{{route('site.products.reviews.get',['slug'=>$product->slug])}}"
                                                       class="btn-primary-cm btn-with-icon">
                                                        <i class="mdi mdi-comment-text-outline"></i>
                                                        افزودن نظر جدید
                                                    </a>
                                                </div>
                                            @else
                                                <p>
                                                    برای ثبت نظر، لازم است ابتدا وارد حساب کاربری خود شوید.
                                                </p>
                                            @endif


                                        </div>
                                    </div>
                                </div>

                                <div class="comments-area dt-sl">
                                    <div class="section-title text-sm-title title-wide no-after-title-wide mb-0 dt-sl">
                                        <h2>نظرات کاربران</h2>
                                        <p class="count-comment">{{number_format($productReviews->count())}} نظر</p>
                                    </div>
                                    <ol class="comment-list">
                                        <!-- #comment-## -->
                                        @foreach($productReviews as $productReview)
                                            <li>
                                                <div class="comment-body">
                                                    <div class="row">
                                                        <div class="col-md-3 col-sm-12">
                                                            <div class="message-light message-light--purchased">
                                                                {{$productReview->user->name}}
                                                            </div>

                                                        </div>
                                                        <div class="col-md-9 col-sm-12 comment-content">
                                                            <div class="comment-title">
                                                                {{$product->title}}
                                                            </div>
                                                            <div class="comment-author">
                                                                توسط
                                                                {{$productReview->user->name}}
                                                                در تاریخ
                                                                {{\Hekmatinasser\Verta\Verta::instance($productReview->created_at)
                                                                ->format('d  M  Y')}}
                                                            </div>

                                                            <div class="rating-stars">
                                                                @for($i=1;$i<6;$i++)
                                                                    <i class="mdi mdi-star {{$productReview->rate >= $i ?'active':''}}"></i>
                                                                @endfor
                                                            </div>

                                                            <p>
                                                                {{ $productReview->review }}
                                                            </p>

                                                            {{--<div class="footer">--}}
                                                            {{--<div class="comments-likes">--}}
                                                            {{--آیا این نظر برایتان مفید بود؟--}}
                                                            {{--<button class="btn-like" data-counter="۱۱">بله--}}
                                                            {{--</button>--}}
                                                            {{--<button class="btn-like" data-counter="۶">خیر--}}
                                                            {{--</button>--}}
                                                            {{--</div>--}}
                                                            {{--</div>--}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                    @endforeach
                                    <!-- #comment-## -->
                                    {{--<li>--}}
                                    {{--<div class="comment-body">--}}
                                    {{--<div class="row">--}}
                                    {{--<div class="col-md-3 col-sm-12">--}}
                                    {{--<div class="message-light message-light--purchased">--}}
                                    {{--خریدار این محصول--}}
                                    {{--</div>--}}
                                    {{--<ul class="comments-user-shopping">--}}
                                    {{--<li>--}}
                                    {{--<div class="cell">رنگ خریداری--}}
                                    {{--شده:--}}
                                    {{--</div>--}}
                                    {{--<div class="cell color-cell">--}}
                                    {{--<span class="shopping-color-value"--}}
                                    {{--style="background-color: #FFFFFF; border: 1px solid rgba(0, 0, 0, 0.25)"></span>سفید--}}
                                    {{--</div>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                    {{--<div class="cell">خریداری شده--}}
                                    {{--از:--}}
                                    {{--</div>--}}
                                    {{--<div class="cell seller-cell">--}}
                                    {{--<span class="o-text-blue">دیجی‌کالا</span>--}}
                                    {{--</div>--}}
                                    {{--</li>--}}
                                    {{--</ul>--}}
                                    {{--<div class="message-light message-light--opinion-positive">--}}
                                    {{--خرید این محصول را توصیه می‌کنم--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-9 col-sm-12 comment-content">--}}
                                    {{--<div class="comment-title">--}}
                                    {{--لباسشویی سامسونگ--}}
                                    {{--</div>--}}
                                    {{--<div class="comment-author">--}}
                                    {{--توسط مجید سجادی فرد در تاریخ ۵ مهر ۱۳۹۵--}}
                                    {{--</div>--}}
                                    {{--<div class="row">--}}
                                    {{--<div class="col-md-4 col-sm-6 col-12">--}}
                                    {{--<div class="content-expert-evaluation-positive">--}}
                                    {{--<span>نقاط قوت</span>--}}
                                    {{--<ul>--}}
                                    {{--<li>دوربین‌های 4گانه پرقدرت--}}
                                    {{--</li>--}}
                                    {{--<li>باتری باظرفیت بالا</li>--}}
                                    {{--<li>حسگر اثرانگشت زیر قاب--}}
                                    {{--جلویی--}}
                                    {{--</li>--}}
                                    {{--</ul>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-4 col-sm-6 col-12">--}}
                                    {{--<div class="content-expert-evaluation-negative">--}}
                                    {{--<span>نقاط ضعف</span>--}}
                                    {{--<ul>--}}
                                    {{--<li>نرم‌افزار دوربین</li>--}}
                                    {{--<li>نبودن Nano SD در بازار--}}
                                    {{--</li>--}}
                                    {{--</ul>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<p>--}}
                                    {{--بعد از چندین هفته بررسی تصمیم به خرید--}}
                                    {{--این مدل از ماشین لباسشویی گرفتم ولی--}}
                                    {{--متاسفانه نتونست انتظارات منو برآورده کنه--}}
                                    {{--.--}}
                                    {{--دو تا ایراد داره یکی اینکه حدودا تا 20--}}
                                    {{--دقیقه اول شستشو یه صدایی شبیه به صدای--}}
                                    {{--پمپ تخلیه همش به گوش میاد که رو مخه یکی--}}
                                    {{--هم با اینکه خشک کنش تا 1400 دور در دقیقه--}}
                                    {{--میچرخه، ولی اون طوری که دوستان تعریف--}}
                                    {{--میکردن لباسها رو خشک نمیکنه .ضمنا برای--}}
                                    {{--این صدایی که گفتم زنگ زدم نمایندگی اومدن--}}
                                    {{--دیدن، وتعمیرکار گفتش که این صدا طبیعیه و--}}
                                    {{--تا چند دقیقه اول شستشو عادیه.بدجوری خورد--}}
                                    {{--تو ذوقم. اگه بیشتر پول میذاشتم میتونستم--}}
                                    {{--یه مدل میان رده از مارکهای بوش یا آ ا گ--}}
                                    {{--میخریدم که خیلی بهتر از جنس مونتاژی کره--}}
                                    {{--ای هستش.--}}
                                    {{--</p>--}}

                                    {{--<div class="footer">--}}
                                    {{--<div class="comments-likes">--}}
                                    {{--آیا این نظر برایتان مفید بود؟--}}
                                    {{--<button class="btn-like" data-counter="۱۱">بله--}}
                                    {{--</button>--}}
                                    {{--<button class="btn-like" data-counter="۶">خیر--}}
                                    {{--</button>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--</li>--}}
                                    <!-- #comment-## -->

                                    </ol>
                                </div>
                            </div>
                        </div>

                        <div class="ah-tab-content dt-sl">
                            <div class="section-title title-wide no-after-title-wide dt-sl">
                                <h2>پرسش و پاسخ</h2>
                                <p class="count-comment">پرسش خود را در مورد محصول مطرح نمایید</p>
                            </div>
                            <div class="form-question-answer dt-sl mb-3">
                                <form action="{{route('site.products.questions.send',['product'=>$product])}}" method="post">
                                    @csrf
                                    @method('post')
                                    <textarea class="form-control mb-3" rows="5" name="content"></textarea>
                                    <button class="btn btn-dark float-right ml-3"  type="submit">ثبت پرسش</button>
                                    {{--<div class="custom-control custom-checkbox float-right mt-2">--}}
                                        {{--<input type="checkbox" class="custom-control-input" id="customCheck3">--}}
                                        {{--<label class="custom-control-label" for="customCheck3">اولین پاسخی که به--}}
                                            {{--پرسش من داده شد، از طریق ایمیل به من اطلاع دهید.</label>--}}
                                    {{--</div>--}}
                                </form>
                            </div>
                            <div class="comments-area default">
                                <div class="section-title text-sm-title title-wide no-after-title-wide mt-5 mb-0 dt-sl">
                                    <h2>پرسش ها و پاسخ ها</h2>
                                    @if($productQuestions->count() > 0)
                                        <p class="count-comment">{{$productQuestions->count()}} پرسش</p>
                                    @endif
                                </div>
                                <ol class="comment-list">

                                    <!-- #comment-## -->
                                    @foreach($productQuestions as $productQuestion)
                                        <li>
                                            <div class="comment-body">
                                                <div class="comment-author">
                                                    <span class="icon-comment">?</span>
                                                    <cite class="fn">{{$productQuestion->user->name}}</cite>
                                                    <span class="says">گفت:</span>
                                                    <div class="commentmetadata">
                                                        <a href="#">
                                                            {{\Hekmatinasser\Verta\Verta::instance($productQuestion->created_at)
                                                                ->format('d  M  Y')}}
                                                        </a>
                                                    </div>
                                                </div>
                                                <p>
                                                    {!! $productQuestion->content !!}
                                                </p>

                                                <button class="reply comment-reply-link btn btn-info"
                                                        data-toggle="modal"
                                                        data-target="#modal-reply"
                                                        data-question_id="{{$productQuestion->id}}"
                                                        data-question="{{$productQuestion->content}}"
                                                        data-action="{{route('site.products.questions.reply',['product'=>$product,'productQuestion'=>$productQuestion])}}"
                                                >پاسخ</button>
                                            </div>

                                            <ol class="children">
                                                @foreach($productQuestion->children()->whereStatus('1')->oldest()->get() as $child)
                                                    <li>
                                                        <div class="comment-body">
                                                            <div class="comment-author">
                                                            <span
                                                                    class="icon-comment mdi mdi-lightbulb-on-outline"></span>
                                                                <cite class="fn">{{$child->user->name}}</cite> <span
                                                                        class="says">گفت:</span>
                                                                <div class="commentmetadata">
                                                                    <a href="#">
                                                                        {{\Hekmatinasser\Verta\Verta::instance($child->created_at)
                                                                ->format('d  M  Y')}}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <p>
                                                                {!! $child->content !!}
                                                            </p>

                                                        </div>
                                                    </li>
                                            @endforeach
                                            <!-- #comment-## -->
                                            </ol>
                                            <!-- .children -->
                                        </li>
                                    @endforeach
                                </ol>

                                <div class="modal fade" id="modal-reply" role="dialog"
                                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-lg send-info modal-dialog-centered"
                                         role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">
                                                    <i class="now-ui-icons location_pin"></i>
                                                    پاسخ به پرسش
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-ui dt-sl">
                                                            <form class="form-account" method="post" action="" style="max-width: 100%">
                                                                @csrf
                                                                @method('post')
                                                                <div class="row">
                                                                    <div class="col-12 mb-2">
                                                                        <div class="form-row-title">
                                                                            <h4>
                                                                                پرسش
                                                                            </h4>
                                                                        </div>
                                                                        <div class="form-row" id="question_text"></div>
                                                                    </div>
                                                                    <div class="col-12 mb-2">
                                                                        <div class="form-row-title">
                                                                            <h4>
                                                                                پاسخ شما
                                                                            </h4>
                                                                        </div>
                                                                        <div class="form-row">
                                                                            <input type="hidden" name="question_id">
                                                                            <textarea name="reply"
                                                                                    class="input-ui pl-2 text-right"
                                                                                    placeholder=""></textarea>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-12 pr-4 pl-4">
                                                                        <button type="submit"
                                                                                class="btn btn-sm btn-primary btn-submit-form">ثبت
                                                                        </button>
                                                                        <button type="button"
                                                                                class="btn-link-border float-left mt-2">انصراف
                                                                            و بازگشت</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </section>
                <!-- End tabs -->
            </div>
            <!-- End Product -->

            <!-- Start Product-Slider -->
        {{--<section class="slider-section dt-sl mb-5">--}}
        {{--<div class="row mb-3">--}}
        {{--<div class="col-12">--}}
        {{--<div class="section-title text-sm-title title-wide no-after-title-wide">--}}
        {{--<h2>خریداران این محصول، محصولات زیر را هم خریده‌اند</h2>--}}
        {{--<a href="#">مشاهده همه</a>--}}
        {{--</div>--}}
        {{--</div>--}}

        {{--<!-- Start Product-Slider -->--}}
        {{--<div class="col-12">--}}
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
@section('css')
    <link rel="stylesheet" href="{{asset('store/assets/css/vendor/fancybox.min.css')}}">

@endsection
@section('script')
    <script src="{{asset('store/assets/js/vendor/jquery.fancybox.min.js')}}"></script>
    <script src="{{asset('store/assets/js/vendor/countdown.min.js')}}"></script>

    <script>
        $('#modal-reply').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var question_id = button.data('question_id');
            var question = button.data('question');
            var action = button.data('action');
            var modal = $(this);

            modal.find('form').attr('action',action);
            modal.find('input[name=question_id]').val(question_id);
            modal.find('#question_text').text(question)
        })
    </script>
@endsection
