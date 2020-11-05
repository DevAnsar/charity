@if(!$mini)
    <footer class="main-footer dt-sl">
        <div class="back-to-top">
            <a href="#">
                <span class="icon"><i class="mdi mdi-chevron-up"></i></span>
                <span>
                    بازگشت به بالا
                </span>
            </a>
        </div>
        <div class="container main-container">
            <div class="footer-services">
                <div class="row">
                    @foreach($footer_ads as $footer_ad)
                        <div class="service-item col">
                            <a href="#" target="_blank">
                                <img src="{{env('IMG').$footer_ad->image->url}}">
                            </a>
                            <p>{{$footer_ad->title}}</p>
                        </div>
                    @endforeach
                    {{--<div class="service-item col">--}}
                    {{--<a href="#" target="_blank">--}}
                    {{--<img src="{{asset('store/assets/img/svg/contact-us.svg')}}">--}}
                    {{--</a>--}}
                    {{--<p>پشتیبانی 24 ساعته</p>--}}
                    {{--</div>--}}
                    {{--<div class="service-item col">--}}
                    {{--<a href="#" target="_blank">--}}
                    {{--<img src="{{asset('store/assets/img/svg/payment-terms.svg')}}">--}}
                    {{--</a>--}}
                    {{--<p>پرداخت درمحل</p>--}}
                    {{--</div>--}}
                    {{--<div class="service-item col">--}}
                    {{--<a href="#" target="_blank">--}}
                    {{--<img src="{{asset('store/assets/img/svg/return-policy.svg')}}">--}}
                    {{--</a>--}}
                    {{--<p>۷ روز ضمانت بازگشت</p>--}}
                    {{--</div>--}}
                    {{--<div class="service-item col">--}}
                    {{--<a href="#" target="_blank">--}}
                    {{--<img src="{{asset('store/assets/img/svg/origin-guarantee.svg')}}">--}}
                    {{--</a>--}}
                    {{--<p>ضمانت اصل بودن کالا</p>--}}
                    {{--</div>--}}
                </div>
            </div>
            <div class="footer-widgets">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="widget-menu widget card">
                            {!! $footer_details->column_1 !!}
                            {{--<header class="card-header">--}}
                            {{--<h3 class="card-title">راهنمای خرید از تاپ کالا</h3>--}}
                            {{--</header>--}}
                            {{--<ul class="footer-menu">--}}
                            {{--<li>--}}
                            {{--<a href="#">نحوه ثبت سفارش</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<a href="#">رویه ارسال سفارش</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<a href="#">شیوه‌های پرداخت</a>--}}
                            {{--</li>--}}
                            {{--</ul>--}}

                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="widget-menu widget card">
                            {!! $footer_details->column_2 !!}
                            {{--<header class="card-header">--}}
                            {{--<h3 class="card-title">خدمات مشتریان</h3>--}}
                            {{--</header>--}}
                            {{--<ul class="footer-menu">--}}
                            {{--<li>--}}
                            {{--<a href="#">پاسخ به پرسش‌های متداول</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<a href="#">رویه‌های بازگرداندن کالا</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<a href="#">شرایط استفاده</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<a href="#">حریم خصوصی</a>--}}
                            {{--</li>--}}
                            {{--</ul>--}}
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="widget-menu widget card">
                            {!! $footer_details->column_3 !!}
                            {{--<header class="card-header">--}}
                            {{--<h3 class="card-title">با تاپ کالا</h3>--}}
                            {{--</header>--}}
                            {{--<ul class="footer-menu">--}}
                            {{--<li>--}}
                            {{--<a href="#">فروش در تاپ کالا</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<a href="#">همکاری با سازمان‌ها</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<a href="#">فرصت‌های شغلی</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<a href="#">تماس با تاپ کالا</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<a href="#">درباره تاپ کالا</a>--}}
                            {{--</li>--}}
                            {{--</ul>--}}
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        {{--<div class="newsletter">--}}
                        {{--<p>از تخفیف‌ها و جدیدترین‌های فروشگاه باخبر شوید:--}}
                        {{--</p>--}}
                        {{--<form action="">--}}
                        {{--<input type="email" class="form-control"--}}
                        {{--placeholder="آدرس ایمیل خود را وارد کنید...">--}}
                        {{--<input type="submit" class="btn btn-primary" value="ارسال">--}}
                        {{--</form>--}}
                        {{--</div>--}}
                        <div class="socials">
                            <p>ما را در شبکه های اجتماعی دنبال کنید.</p>
                            <div class="footer-social">
                                <ul class="text-center">

                                    @foreach($footer_socials as $footer_social)
                                    <li><a href="{{$footer_social->link}}" title="{{$footer_social->title}}">
                                            <i class="mdi mdi-{{$footer_social->icon}}"></i>
                                        </a>
                                    </li>
                                    @endforeach
                                    {{--<li><a href="#"><i class="mdi mdi-telegram"></i></a></li>--}}
                                    {{--<li><a href="#"><i class="mdi mdi-facebook"></i></a></li>--}}
                                    {{--<li><a href="#"><i class="mdi mdi-twitter"></i></a></li>--}}

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="info">
                <div class="row">
                    <div class="col-12 text-right">
                        <span>
                            {!! $footer_details->message !!}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="description">
            <div class="container main-container">
                <div class="row">
                    <div class="site-description col-12 col-lg-7">
                        {!! $footer_details->description !!}
                        {{--<h1 class="site-title">فروشگاه اینترنتی تاپ کالا، بررسی، انتخاب و خرید آنلاین</h1>--}}
                        {{--<p>--}}
                        {{--تاپ کالا به عنوان یکی از قدیمی‌ترین فروشگاه های اینترنتی با بیش از یک دهه تجربه، با--}}
                        {{--پایبندی به سه اصل کلیدی، پرداخت در--}}
                        {{--محل، 7 روز ضمانت بازگشت کالا و تضمین اصل‌بودن کالا، موفق شده تا همگام با فروشگاه‌های--}}
                        {{--معتبر جهان، به بزرگ‌ترین فروشگاه--}}
                        {{--اینترنتی ایران تبدیل شود. به محض ورود به تاپ کالا با یک سایت پر از کالا رو به رو--}}
                        {{--می‌شوید! هر آنچه که نیاز دارید و به--}}
                        {{--ذهن شما خطور می‌کند در اینجا پیدا خواهید کرد.--}}
                        {{--</p>--}}
                    </div>
                    <div class="symbol col-12 col-lg-5">
                        @foreach($footer_licenses as $footer_license)
                            <a href="{{$footer_license->link}}" target="_blank">
                                <img src="{{env('IMG').$footer_license->image->url}}" title="{{$footer_license->title}}"
                                                             alt="{{$footer_license->title}}">
                            </a>
                        @endforeach
                        {{--<a href="#" target="_blank"><img src="{{asset('store/assets/img/symbol-02.png')}}" alt=""></a>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container main-container">
                <p>
                    {!! $footer_details->right !!}
                </p>
            </div>
        </div>
    </footer>
@else
    <footer class="mini-footer dt-sl">
        <div class="container main-container">
            <div class="row">
                <div class="col-12">
                    <ul class="mini-footer-menu">
                        {{--<li><a href="#">درباره دیدیکالا</a></li>--}}
                        {{--<li><a href="#">فرصت های شغلی</a></li>--}}
                        {{--<li><a href="#">تماس با ما</a></li>--}}
                        {{--<li><a href="#">همکاری با سازمان ها</a></li>--}}
                        {!! $footer_details->column_3 !!}
                    </ul>
                </div>
                <div class="col-12 mt-2 mb-3">
                    <div class="footer-light-text">
                        {!! $footer_details->right !!}
                    </div>
                </div>
                <div class="col-12 text-center">
                    <div class="copy-right-mini-footer">
                        {{--Copyright © 2019 Didikala--}}
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endif