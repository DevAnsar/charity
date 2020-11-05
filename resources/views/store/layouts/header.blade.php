@if($show)
    @if(!$mini)
        <header class="main-header js-fixed-topbar dt-sl">
            <!-- Start ads -->
        {{--<a href="#" class="ads-header hidden-sm" target="_blank"--}}
        {{--style="background-image: url({{asset('store/assets/img/banner/large-ads.jpg')}})"></a>--}}
        <!-- End ads -->
            <!-- Start topbar -->
            <div class="container main-container">
                <div class="topbar dt-sl">
                    <div class="row">
                        <div class="col-lg-2 col-md-3 col-6">
                            <div class="logo-area float-right">
                                <a href="/">
                                    <img src="{{env('IMG').\App\Models\Config::where('key','app_logo')->first()->value}}"
                                         alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-5  hidden-sm" style="margin-top: 12px;">
                            <div class="search-area mt-0 dt-sl">
                                <form action="{{route('site.search')}}" class="search">
                                    <input type="text" name="string"
                                           placeholder="نام کالا، برند و یا دسته مورد نظر خود را جستجو کنید…">
                                    <button type="submit"><img src="{{asset('store/assets/img/theme/search.png')}}"
                                                               alt="">
                                    </button>
                                    <button class="close-search-result" type="submit"><i class="mdi mdi-close"></i>
                                    </button>
                                    {{--<div class="search-result">--}}
                                        {{--<ul>--}}
                                            {{--<li>--}}
                                                {{--<a href="#">موبایل</a>--}}
                                            {{--</li>--}}
                                            {{--<li>--}}
                                                {{--<a href="#">مد و پوشاک</a>--}}
                                            {{--</li>--}}
                                            {{--<li>--}}
                                                {{--<a href="#">میکروفن</a>--}}
                                            {{--</li>--}}
                                            {{--<li>--}}
                                                {{--<a href="#">میز تلویزیون</a>--}}
                                            {{--</li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                </form>
                            </div>
                        </div>
                        <div class="col-md-4 col-6  topbar-left" style="margin-top: 12px;">
                            <ul class="nav float-left">
                                @if(auth()->check())
                                    <li class="nav-item account dropdown">
                                        <a class="nav-link" href="#" data-toggle="dropdown" aria-haspopup="true"
                                           aria-expanded="false">
                                            <span class="label-dropdown">حساب کاربری</span>
                                            <i class="mdi mdi-account-circle-outline"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-left">
                                            <a class="dropdown-item" href="{{route('site.profile.index')}}">
                                                <i class="mdi mdi-account-card-details-outline"></i>پروفایل
                                            </a>

                                            @if(auth()->user()->hasRole(['admin','helper','store','needy']))
                                                <a class="dropdown-item" href="{{route('panel.dashboard')}}">
                                                    <i class="mdi mdi-comment-text-outline"></i>
                                                    اکانت سیستم خیریه
                                                </a>
                                            @endif

                                            <a class="dropdown-item" href="{{route('site.profile.edit')}}">
                                                <i class="mdi mdi-account-edit-outline"></i>ویرایش حساب کاربری
                                            </a>
                                            <div class="dropdown-divider" role="presentation"></div>

                                            <div class="dropdown-item">
                                                <log-out-btn action="{{route('site.logout')}}"
                                                             csrf="{{csrf_token()}}"
                                                             title="خروج"
                                                ></log-out-btn>
                                            </div>
                                        </div>
                                    </li>
                                @else

                                    <li class="nav-item account dropdown">
                                        <a class="nav-link" href="{{route('site.login')}}"
                                           aria-expanded="false">
                                            <span class="label-dropdown">ورود / ثبت نام</span>
                                            <i class="mdi mdi-account-circle-outline"></i>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End topbar -->

            <!-- Start bottom-header -->
            <div class="bottom-header dt-sl mb-sm-bottom-header">
                <div class="container main-container">
                    <!-- Start Main-Menu -->
                    <nav class="main-menu dt-sl">
                        <ul class="list float-right hidden-sm">
                            <!-- mega menu 2 column -->
                        {{--@foreach($categories as $category)--}}
                        {{--<li class="list-item list-item-has-children mega-menu mega-menu-col-2">--}}
                        {{--<a class="nav-link" href="#">--}}
                        {{--{{$category->title}}--}}
                        {{--</a>--}}
                        {{--<ul class="sub-menu nav">--}}
                        {{--<li class="list-item list-item-has-children">--}}
                        {{--<a class="nav-link" href="#">عنوان دسته</a>--}}
                        {{--<ul class="sub-menu nav">--}}
                        {{--<li class="list-item">--}}
                        {{--<a class="nav-link" href="#">زیر منو یک</a>--}}
                        {{--</li>--}}
                        {{--<li class="list-item">--}}
                        {{--<a class="nav-link" href="#">زیر منو دو</a>--}}
                        {{--</li>--}}
                        {{--<li class="list-item">--}}
                        {{--<a class="nav-link" href="#">زیر منو سه</a>--}}
                        {{--</li>--}}
                        {{--<li class="list-item">--}}
                        {{--<a class="nav-link" href="#">زیر منو چهار</a>--}}
                        {{--</li>--}}
                        {{--<li class="list-item">--}}
                        {{--<a class="nav-link" href="#">زیر منو پنج</a>--}}
                        {{--</li>--}}
                        {{--<li class="list-item">--}}
                        {{--<a class="nav-link" href="#">زیر منو شش</a>--}}
                        {{--</li>--}}
                        {{--</ul>--}}
                        {{--</li>--}}
                        {{--<li class="list-item list-item-has-children">--}}
                        {{--<a class="nav-link" href="#">عنوان دسته</a>--}}
                        {{--<ul class="sub-menu nav">--}}
                        {{--<li class="list-item">--}}
                        {{--<a class="nav-link" href="#">زیر منو یک</a>--}}
                        {{--</li>--}}
                        {{--<li class="list-item">--}}
                        {{--<a class="nav-link" href="#">زیر منو دو</a>--}}
                        {{--</li>--}}
                        {{--<li class="list-item">--}}
                        {{--<a class="nav-link" href="#">زیر منو سه</a>--}}
                        {{--</li>--}}
                        {{--<li class="list-item">--}}
                        {{--<a class="nav-link" href="#">زیر منو چهار</a>--}}
                        {{--</li>--}}
                        {{--<li class="list-item">--}}
                        {{--<a class="nav-link" href="#">زیر منو پنج</a>--}}
                        {{--</li>--}}
                        {{--<li class="list-item">--}}
                        {{--<a class="nav-link" href="#">زیر منو شش</a>--}}
                        {{--</li>--}}
                        {{--<li class="list-item">--}}
                        {{--<a class="nav-link" href="#">زیر منو هفت</a>--}}
                        {{--</li>--}}
                        {{--</ul>--}}
                        {{--</li>--}}
                        {{--</ul>--}}
                        {{--</li>--}}
                        {{--@endforeach--}}

                        <!-- dropdown-menu -->
                            @foreach($categories as $category)
                                <li class="list-item list-item-has-children menu-col-1">
                                    <a class="nav-link" href="#">{{$category->title}}</a>
                                    <ul class="sub-menu nav">
                                        @foreach($category->children as $child)
                                            <li class="list-item list-item-has-children">
                                                <a class="nav-link"
                                                   href="{{route('site.getCat',['category_slug'=>$child->slug])}}">{{$child->title}}</a>
                                                <ul class="sub-menu nav">
                                                    @foreach($child->children as $item)
                                                        <li class="list-item">
                                                            <a class="nav-link"
                                                               href="{{route('site.getCat',['category_slug'=>$item->slug])}}">{{$item->title}}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach

                            <li class="list-item  menu-col-1">
                                <a class="nav-link" href="{{route('site.faq.index')}}">سوالی دارید؟</a>
                            </li>

                            <li class="list-item  menu-col-1">
                                <a class="nav-link" href="{{route('site.blog.index')}}">بلاگ</a>
                            </li>

                            <li class="list-item  menu-col-1">
                                <a class="nav-link" href="{{route('site.collaborator.index')}}">همراه شو</a>
                            </li>

                            {{--<li class="list-item">--}}
                            {{--<a class="nav-link" href="#">ورزش و سفر</a>--}}
                            {{--</li>--}}
                        </ul>
                        <ul class="nav float-left">
                            <li class="nav-item">
                                @if(Route::currentRouteName() != 'site.cart')
                                    <a class="nav-link" data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="false">
                                        <span class="label-dropdown">سبد خرید</span>
                                        <i class="mdi mdi-cart-outline"></i>
                                        <basket-count :basket_count="BasketProducts.length"></basket-count>
                                    </a>


                                    <basket-modal-show
                                            :basket-data="BasketProducts"
                                            img_env="{{env('IMG')}}"
                                            :basket_products_price="BasketProductsPrice"
                                            @delete-product="deleteProductInBasket"
                                    ></basket-modal-show>
                                @endif
                            </li>
                        </ul>
                        <button class="btn-menu">
                            <div class="align align__justify">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </button>
                        <div class="side-menu">
                            <div class="logo-nav-res dt-sl text-center">
                                <a href="#">
                                    <img src="{{asset('assets/img/logo.png')}}" alt="">
                                </a>
                            </div>
                            <div class="search-box-side-menu dt-sl text-center mt-2 mb-3">
                                <form action="">
                                    <input type="text" name="s" placeholder="جستجو کنید...">
                                    <i class="mdi mdi-magnify"></i>
                                </form>
                            </div>


                            <ul class="navbar-nav dt-sl">

                                @foreach($categories as $category)
                                    <li class="sub-menu">
                                        <a href="#">{{$category->title}}</a>
                                        <ul>
                                            @foreach($category->children as $child)
                                                <li class="sub-menu">
                                                    <a href="#">{{$child->title}}</a>
                                                    <ul>
                                                        @foreach($child->children as $item)
                                                            <li>
                                                                <a href="#">{{$item->title}}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                                {{--<li class="sub-menu">--}}
                                {{--<a href="#">کالای دیجیتال</a>--}}
                                {{--<ul>--}}
                                {{--<li class="sub-menu">--}}
                                {{--<a href="#">عنوان دسته</a>--}}
                                {{--<ul>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو یک</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو دو</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو سه</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو چهار</a>--}}
                                {{--</li>--}}
                                {{--</ul>--}}
                                {{--</li>--}}
                                {{--<li class="sub-menu">--}}
                                {{--<a href="#">عنوان دسته</a>--}}
                                {{--<ul>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو یک</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو دو</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو سه</a>--}}
                                {{--</li>--}}
                                {{--</ul>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">عنوان دسته</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">عنوان دسته</a>--}}
                                {{--</li>--}}
                                {{--<li class="sub-menu">--}}
                                {{--<a href="#">عنوان دسته</a>--}}
                                {{--<ul>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو یک</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو دو</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو سه</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو چهار</a>--}}
                                {{--</li>--}}
                                {{--</ul>--}}
                                {{--</li>--}}
                                {{--</ul>--}}
                                {{--</li>--}}
                                {{--<li class="sub-menu">--}}
                                {{--<a href="#">بهداشت و سلامت</a>--}}
                                {{--<ul>--}}
                                {{--<li class="sub-menu">--}}
                                {{--<a href="#">عنوان دسته</a>--}}
                                {{--<ul>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو یک</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو دو</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو سه</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو چهار</a>--}}
                                {{--</li>--}}
                                {{--</ul>--}}
                                {{--</li>--}}
                                {{--<li class="sub-menu">--}}
                                {{--<a href="#">عنوان دسته</a>--}}
                                {{--<ul>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو یک</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو دو</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو سه</a>--}}
                                {{--</li>--}}
                                {{--</ul>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">عنوان دسته</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">عنوان دسته</a>--}}
                                {{--</li>--}}
                                {{--<li class="sub-menu">--}}
                                {{--<a href="#">عنوان دسته</a>--}}
                                {{--<ul>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو یک</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو دو</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو سه</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو چهار</a>--}}
                                {{--</li>--}}
                                {{--</ul>--}}
                                {{--</li>--}}
                                {{--</ul>--}}
                                {{--</li>--}}
                                {{--<li class="sub-menu">--}}
                                {{--<a href="#">ابزار و اداری</a>--}}
                                {{--<ul>--}}
                                {{--<li class="sub-menu">--}}
                                {{--<a href="#">عنوان دسته</a>--}}
                                {{--<ul>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو یک</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو دو</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو سه</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو چهار</a>--}}
                                {{--</li>--}}
                                {{--</ul>--}}
                                {{--</li>--}}
                                {{--<li class="sub-menu">--}}
                                {{--<a href="#">عنوان دسته</a>--}}
                                {{--<ul>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو یک</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو دو</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو سه</a>--}}
                                {{--</li>--}}
                                {{--</ul>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">عنوان دسته</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">عنوان دسته</a>--}}
                                {{--</li>--}}
                                {{--<li class="sub-menu">--}}
                                {{--<a href="#">عنوان دسته</a>--}}
                                {{--<ul>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو یک</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو دو</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو سه</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">زیر منو چهار</a>--}}
                                {{--</li>--}}
                                {{--</ul>--}}
                                {{--</li>--}}
                                {{--</ul>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">مد و پوشاک</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">خانه و آشپزخانه</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                {{--<a href="#">ورزش و سفر</a>--}}
                                {{--</li>--}}
                            </ul>
                        </div>
                        <div class="overlay-side-menu">
                        </div>
                    </nav>
                    <!-- End Main-Menu -->
                </div>
            </div>
            <!-- End bottom-header -->
        </header>
    @else
        <header class="mini-header pt-4 pb-4">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <div class="logo-area-mini-header">
                            <a href="/">
                                <img src="{{env('IMG').\App\Models\Config::where('key','app_logo')->first()->value}}"
                                     alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    @endif
@endif
