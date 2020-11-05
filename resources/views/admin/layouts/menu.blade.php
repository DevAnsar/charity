<div class="vertical-menu">

    <div class="h-100">

        <div class="user-wid text-center py-4">
            <div class="user-img">
                <img src="{{auth()->user()->image ? env('IMG').auth()->user()->image->url :asset('assets/images/users/avatar-2.jpg')}}"
                     alt=""
                     class="avatar-md mx-auto rounded-circle">
            </div>

            <div class="mt-3">

                <a href="#" class="text-dark font-weight-medium font-size-16">پنل فروشگاه خیریه</a>
                <p class="text-body mt-1 mb-0 font-size-13">
                    {{auth()->user()->name}}
                </p>

            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">


                <li>
                    <a href="{{route('site.index')}}" class=" waves-effect">
                        <i class="mdi mdi-storefront"></i>
                        <span>فروشگاه</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('panel.dashboard')}}" class=" waves-effect">
                        <i class="mdi mdi-calendar-text"></i>
                        <span>داشبورد</span>
                    </a>
                </li>

                {{--<li class="menu-title">بخش فروش</li>--}}

                <li>
                    <a href="javascript: void(0);" class=" has-arrow waves-effect">
                        <i class="mdi mdi-cart-arrow-down"></i>
                        <span>سفارشات</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        @if(auth()->user()->hasRole(['admin','store','helper']) )
                            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('store'))

                                <li><a href="{!! route('panel.orders.index',['list'=>'unpaid']) !!}">در انتظار
                                        پرداخت</a></li>
                            @endif

                            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('store'))
                                <li><a href="{!! route('panel.orders.index',['list'=>'open']) !!}"> سفارشات باز</a></li>
                            @endif

                            <li><a href="{!! route('panel.orders.index',['list'=>'open_needy']) !!}">
                                    سفارشات باز
                                    @if(auth()->user()->hasRole(['admin','store','helper']))
                                        نیازمندان
                                    @endif
                                </a>
                            </li>
                            <li><a href="{!! route('panel.orders.index',['list'=>'processing']) !!}"> سفارشات معلق</a>
                            </li>
                            <li><a href="{!! route('panel.orders.index',['list'=>'posted']) !!}"> سفارشات ارسال شده</a>
                            </li>
                            <li><a href="{!! route('panel.orders.index',['list'=>'delivered']) !!}"> سفارشات تحویل داده
                                    شده</a></li>

                        @endif
                        @if(auth()->user()->hasRole('admin') )
                            <li><a href="{!! route('panel.orders.index',['list'=>'all']) !!}">همه ی سفارشات</a></li>
                        @endif
                        @if(auth()->user()->hasRole('needy'))
                            <li><a href="{!! route('panel.orders.index',['list'=>'all']) !!}">سفارشات من</a></li>
                        @endif

                        @if(auth()->user()->hasRole('admin') )
                            <li><a href="{!! route('panel.orders.index',['list'=>'cancel']) !!}">سفارشات لغو شده</a>
                            </li>
                        @endif

                    </ul>
                </li>

                {{--<li class="menu-title">بخش مدیریت</li>--}}
                @can('panel.categories.index')
                    <li>
                        <a href="javascript: void(0);" class=" has-arrow waves-effect">
                            <i class="mdi mdi-apps"></i>
                            <span>دسته بندی محصولات</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{!! route('panel.categories.index') !!}">لیست دسته ها</a></li>
                            <li><a href="{!! route('panel.categories.create') !!}">ایجاد دسته ی جدید</a></li>
                        </ul>
                    </li>
                @endcan

                @if(auth()->user()->hasRole(['admin','store','needy','helper']))
                    <li>
                        <a href="javascript: void(0);" class=" has-arrow waves-effect">
                            <i class="mdi mdi-dropbox"></i>
                            <span>محصولات</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            @can('panel.products.index')
                                <li><a href="{!! route('panel.products.index') !!}">لیست محصولات</a></li>
                            @endif

                            @can('panel.products.my_products')
                                <li><a href="{!! route('panel.products.my_products') !!}"> محصولات من</a></li>
                            @endcan

                            @can('panel.products.create')
                                <li><a href="{!! route('panel.products.create') !!}">ایجاد محصول جدید</a></li>
                            @endif
                        </ul>
                    </li>
                @endif


                @can('panel.blogs.index')
                    <li>
                        <a href="javascript: void(0);" class=" has-arrow waves-effect">
                            <i class="mdi mdi-blogger"></i>
                            <span>مدیریت وبلاگ</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">

                            @can('panel.blogs.index')
                                <li><a href="{!! route('panel.blogs.index') !!}">بلاگ ها</a></li>
                            @endcan

                            @can('panel.blogCategories.index')
                                <li><a href="{!! route('panel.blogCategories.index') !!}">دسته ها</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('panel.productReviews.index')
                    <li>
                        <a href="javascript: void(0);" class=" has-arrow waves-effect">
                            <i class="mdi mdi-comment-account-outline"></i>
                            <span>مدیریت نظرات</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">

                            <li><a href="{!! route('panel.productReviews.index',['list'=>'all']) !!}">نظرات</a></li>
                            <li><a href="{!! route('panel.productReviews.index',['list'=>'awaiting']) !!}">در انتظار
                                    تایید</a></li>
                            <li><a href="{!! route('panel.productReviews.index',['list'=>'failed']) !!}">رد شده</a></li>

                        </ul>
                    </li>
                @endcan

                @can('panel.collaborators.index')
                    <li>
                        <a href="{{route('panel.collaborators.index')}}" class=" waves-effect">
                            <i class="mdi mdi-face"></i>
                            <span>لیست همیاران</span>
                        </a>
                    </li>
                @endcan

                @can('panel.productQuestions.index')
                    <li>
                        <a href="javascript: void(0);" class=" has-arrow waves-effect">
                            <i class="mdi mdi-comment-question-outline"></i>
                            <span>مدیریت پرسش و پاسخ</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">

                            <li><a href="{!! route('panel.productQuestions.index',['list'=>'all']) !!}">تایید شده ها</a>
                            </li>
                            <li><a href="{!! route('panel.productQuestions.index',['list'=>'awaiting']) !!}">در انتظار
                                    تایید</a></li>
                            <li><a href="{!! route('panel.productQuestions.index',['list'=>'failed']) !!}">رد شده</a>
                            </li>

                        </ul>
                    </li>
                @endcan



                @can('panel.app-settings')

                    @if(auth()->user()->mobile=='09306029572')
                        <li>
                            <a href="javascript: void(0);" class=" has-arrow waves-effect">
                                <i class="mdi mdi-flip-horizontal"></i>
                                <span>مقام ها و دسترسی ها</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">

                                <li><a href="{!! route('panel.permissions.index') !!}">لیست دسترسی ها</a></li>
                                <li><a href="{!! route('panel.permissions.create') !!}">ایجاد دسترسی</a></li>

                                <li><a href="{!! route('panel.roles.index') !!}">لیست مقام ها</a></li>
                                <li><a href="{!! route('panel.roles.create') !!}">ایجاد مقام</a></li>
                            </ul>
                        </li>
                    @endif

                    @can('panel.users.index')
                        <li>

                            <a href="javascript: void(0);" class=" has-arrow waves-effect">
                                <i class="mdi mdi-account-group"></i>
                                <span>کاربران</span>
                            </a>
                            <ul class="sub-menu" aria-expanded="false">

                                <li><a href="{!! route('panel.users.index',['list'=>'all']) !!}">همه ی کاربران</a></li>
                                <li><a href="{{route('panel.users.index',['list'=>'needy'])}}">نیازمندان</a></li>
                                <li><a href="{{route('panel.users.index',['list'=>'helper'])}}">خیران</a></li>
                                <li><a href="{{route('panel.users.index',['list'=>'store'])}}">فروشندگان</a></li>
                                <li><a href="{{route('panel.users.index',['list'=>'admin'])}}">مدیران</a></li>
                                <li><a href="{{route('panel.users.index',['list'=>'unauth_needy'])}}">نیازمندان احراز
                                        نشده</a></li>
                            </ul>

                        </li>
                    @endcan

                    @can('panel.cities.index')
                        <li>
                            <a href="{{route('panel.cities.index')}}" class=" waves-effect">
                                <i class="mdi mdi-city-variant-outline"></i>
                                <span>شهر ها</span>
                            </a>
                        </li>
                    @endcan

                    @can('panel.configs.index')
                        <li>
                            <a href="{{route('panel.configs.index')}}" class=" waves-effect">
                                <i class="mdi mdi-key-outline"></i>
                                <span>متغیر ها</span>
                            </a>
                        </li>
                    @endcan

                @endcan

                {{--<li class="menu-title">بخش مدیریت محتوا</li>--}}
                @can('panel.mainSliders.index')
                    <li>
                        <a href="{{route('panel.mainSliders.index')}}" class=" waves-effect">
                            <i class="mdi mdi-slack"></i>
                            <span>اسلایدر اصلی</span>
                        </a>
                    </li>
                @endcan

                @can('panel.faqCategories.index')
                    <li>
                        <a href="{{route('panel.faqCategories.index')}}" class=" waves-effect">
                            <i class="mdi mdi-crosshairs-question"></i>
                            <span>سوالات متداول</span>
                        </a>
                    </li>
                @endcan

                @can('panel.brands.index')
                    <li>
                        <a href="{{route('panel.brands.index')}}" class=" waves-effect">
                            <i class="mdi mdi-bookmark-outline"></i>
                            <span>برند ها</span>
                        </a>
                    </li>
                @endif

                @can('panel.categoryInAds.index')
                    <li>
                        <a href="{{route('panel.categoryInAds.index')}}" class=" waves-effect">
                            <i class="mdi mdi-antenna"></i>
                            <span>دسته ها در ویترین</span>
                        </a>
                    </li>
                @endif

                @can('panel.imageAds.index')
                    <li>
                        <a href="{{route('panel.imageAds.index')}}" class=" waves-effect">
                            <i class="mdi mdi-picture-in-picture-bottom-right"></i>
                            <span>تبلیغات تصویری</span>
                        </a>
                    </li>
                @endif

                @can('panel.sendTypes.index')
                    <li>
                        <a href="{{route('panel.sendTypes.index')}}" class=" waves-effect">
                            <i class="mdi mdi-send-circle-outline"></i>
                            <span>شیوه های ارسال</span>
                        </a>
                    </li>
                @endif

                @can('panel.pages.index')
                    <li>
                        <a href="{{route('panel.pages.index')}}" class=" waves-effect">
                            <i class="mdi mdi-palette-swatch"></i>
                            <span>صفحات</span>
                        </a>
                    </li>
                @endif


                @if(auth()->user()->hasRole('admin'))
                    <li>
                        <a href="javascript: void(0);" class=" has-arrow waves-effect">
                            <i class="mdi mdi-cart-arrow-down"></i>
                            <span>فوتر</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">

                            <li>
                                <a href="{!! route('panel.footer_details.index') !!}">اطلاعات فوتر</a>
                            </li>
                            <li>
                                <a href="{!! route('panel.footerAds.index') !!}">تبلیغات</a>
                            </li>
                            <li>
                                <a href="{!! route('panel.footerLicenses.index') !!}">مجوزها</a>
                            </li>
                            <li>
                                <a href="{!! route('panel.footerSocials.index') !!}">شبکه های اجتماعی</a>
                            </li>

                        </ul>
                    </li>
                @endif

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>