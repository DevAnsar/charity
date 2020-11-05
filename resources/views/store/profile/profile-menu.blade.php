<?php

use Illuminate\Support\Facades\Route;
$route_name=Route::currentRouteName();

?>
<ul>
    <li>
        <a href="{{route('site.profile.index')}}" class="{{$route_name=='site.profile.index'?'active':''}}">
            <i class="mdi mdi-account-circle-outline"></i>
            پروفایل
        </a>
    </li>
    <li>
        <a href="{{route('site.profile.orders')}}" class="{{$route_name=='site.profile.orders'?'active':''}}">
            <i class="mdi mdi-basket"></i>
            همه سفارش ها
        </a>
    </li>
    {{--<li>--}}
        {{--<a href="#">--}}
            {{--<i class="mdi mdi-backburger"></i>--}}
            {{--درخواست مرجوعی--}}
        {{--</a>--}}
    {{--</li>--}}
    <li>
        <a href="{{route('site.profile.favorites')}}" class="{{$route_name=='site.profile.favorites'?'active':''}}">
            <i class="mdi mdi-heart-outline"></i>
            لیست علاقمندی ها
        </a>
    </li>
    <li>
        <a href="{{route('site.profile.comments')}}" class="{{$route_name=='site.profile.comments'?'active':''}}" >
            <i class="mdi mdi-glasses"></i>
            نقد و نظرات
        </a>
    </li>
    <li>
        <a href="{{route('site.profile.addresses')}}" class="{{$route_name=='site.profile.addresses'?'active':''}}" >
            <i class="mdi mdi-sign-direction"></i>
            آدرس ها
        </a>
    </li>
    {{--<li>--}}
        {{--<a href="#">--}}
            {{--<i class="mdi mdi-eye-outline"></i>--}}
            {{--بازدیدهای اخیر--}}
        {{--</a>--}}
    {{--</li>--}}
    <li>
        <a href="{{route('site.profile.edit')}}" class="{{$route_name=='site.profile.edit'?'active':''}}" >
            <i class="mdi mdi-account-edit-outline"></i>
            اطلاعات شخصی
        </a>
    </li>
</ul>