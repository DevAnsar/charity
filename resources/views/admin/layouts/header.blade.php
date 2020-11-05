<header id="page-topbar">
    <div class="navbar-header">
        <div class="container-fluid">
            <div class="float-right">

                <div class="dropdown d-inline-block d-lg-none ml-2">
                    <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-search-dropdown" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                        <i class="mdi mdi-magnify"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                         aria-labelledby="page-header-search-dropdown">

                        <form class="p-3">
                            <div class="form-group m-0">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search ..."
                                           aria-label="Recipient's username">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="dropdown d-none d-lg-inline-block ml-1">
                    <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                        <i class="mdi mdi-fullscreen"></i>
                    </button>
                </div>


                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user"
                             src="{{auth()->user()->image ? env('IMG').auth()->user()->image->url :asset('assets/images/users/avatar-2.jpg')}}"
                             alt="Header Avatar">
                        <span class="d-none d-xl-inline-block ml-1">
                            {{auth()->user()->name}}
                        </span>
                        <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
                        {{--<a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle mr-1"></i>--}}
                        {{--Profile</a>--}}
                        {{--<a class="dropdown-item" href="#"><i class="bx bx-wallet font-size-16 align-middle mr-1"></i> My--}}
                        {{--Wallet</a>--}}
                        {{--<a class="dropdown-item d-block" href="#"><span--}}
                        {{--class="badge badge-success float-right">11</span><i--}}
                        {{--class="bx bx-wrench font-size-16 align-middle mr-1"></i> Settings</a>--}}
                        {{--<a class="dropdown-item" href="#"><i class="bx bx-lock-open font-size-16 align-middle mr-1"></i>--}}
                        {{--Lock screen</a>--}}
                        {{--<div class="dropdown-divider"></div>--}}

                        <form action="{!! route('site.logout') !!}" method="post">
                            @csrf
                            @method('post')
                            <button type="submit" class="dropdown-item text-danger" href="#">
                                <i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i>
                                Logout
                            </button>
                        </form>

                    </div>
                </div>

                <div class="dropdown d-inline-block">
                    <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                        <i class="mdi mdi-settings-outline"></i>
                    </button>
                </div>

            </div>
            <div>
                <!-- LOGO -->
                <div class="navbar-brand-box">

                    <a href="{{route('panel.dashboard')}}" class="logo logo-light">
                                    <span class="logo-sm">
                                        <img src="{{asset('assets/images/logo-sm.png')}}" alt="" height="20">
                                    </span>
                        <span class="logo-lg">
                                        {{--<img src="{{asset('assets/images/logo-light.png')}}" alt="" height="19">--}}
                                        <img src="{{env('IMG').\App\Models\Config::where('key','app_logo')->first()->value}}" alt="" height="19">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 header-item toggle-btn waves-effect"
                        id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>

            </div>

        </div>
    </div>
</header>