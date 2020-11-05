@extends('store.profile.master')
@section('profile-content')
    <div class="col-xl-9 col-lg-8 col-md-8 col-sm-12">
        <div class="row">
            <div class="col-xl-6 col-lg-12">
                <div class="px-3">
                    <div
                            class="section-title text-sm-title title-wide mb-1 no-after-title-wide dt-sl mb-2">
                        <h2>اطلاعات شخصی</h2>
                    </div>
                    <div class="profile-section dt-sl">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="label-info">
                                    <span>نام و نام خانوادگی:</span>
                                </div>
                                <div class="value-info">
                                    <span>{{$user->name}}</span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="label-info">
                                    <span>پست الکترونیک:</span>
                                </div>
                                <div class="value-info">
                                    <span>{{$user->email}}</span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="label-info">
                                    <span>شماره تلفن همراه:</span>
                                </div>
                                <div class="value-info">
                                    <span>{{$user->mobile}}</span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="label-info">
                                    <span>کد ملی:</span>
                                </div>
                                <div class="value-info">
                                    <span>{{$user->code_melli}}</span>
                                </div>
                            </div>
                            {{--<div class="col-md-6 col-sm-12">--}}
                                {{--<div class="label-info">--}}
                                    {{--<span>دریافت خبرنامه:</span>--}}
                                {{--</div>--}}
                                {{--<div class="value-info">--}}
                                    {{--<span>خیر</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="col-md-6 col-sm-12">
                                <div class="label-info">
                                    <span>شماره کارت:</span>
                                </div>
                                <div class="value-info">
                                    <span>{{$user->bank_cart}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="profile-section-link">
                            <a href="{{route('site.profile.edit')}}" class="border-bottom-dt">
                                <i class="mdi mdi-account-edit-outline"></i>
                                ویرایش اطلاعات شخصی
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-12">
                <div class="px-3">
                    <div
                            class="section-title text-sm-title title-wide mb-1 no-after-title-wide dt-sl mb-2">
                        <h2>لیست آخرین علاقه‌مندی‌ها</h2>
                    </div>
                    <div class="profile-section dt-sl">
                        <ul class="list-favorites ">
                            @foreach($last_favorites as $favorite)
                                <li class="product-card">
                                    <h1 class="product-title mt-0">
                                        <a href="{{route('site.product',['slug'=>$favorite->product->slug])}}">
                                            <img src="{{env('IMG').$favorite->product->main_image[0]->url}}" alt="">
                                            <span>{{$favorite->product->title}}</span>
                                        </a>
                                    </h1>
                                    <form action="{{route('site.profile.favorites.destroy',['favorite'=>$favorite])}}"
                                          method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit">
                                            <i class="mdi mdi-trash-can-outline"></i>
                                        </button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                        <div class="profile-section-link">
                            <a href="{{route('site.profile.favorites')}}" class="border-bottom-dt">
                                <i class="mdi mdi-square-edit-outline"></i>
                                مشاهده و ویرایش لیست مورد علاقه
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <div
                        class="section-title text-sm-title title-wide mb-1 no-after-title-wide dt-sl mb-2 px-res-1">
                    <h2>آخرین سفارش‌ها</h2>
                </div>
                <div class="dt-sl">
                    <div class="table-responsive">
                        <table class="table table-order">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>شماره سفارش</th>
                                <th>تاریخ ثبت سفارش</th>
                                <th>مبلغ قابل پرداخت</th>
                                <th>مبلغ کل</th>
                                <th>عملیات پرداخت</th>
                                <th>جزییات</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($last_orders as $order)
                                <tr>
                                    <td>1</td>
                                    <td>{{$order->order_number}}</td>

                                    <td>
                                        {{\Hekmatinasser\Verta\Verta::instance($order->created_at)
                                                            ->format('H:i   Y/m/d  ')}}
                                    </td>

                                    <td>{{number_format($order->paid_price)}}
                                        تومان
                                    </td>
                                    <td>{{number_format($order->total_price)}}
                                        تومان
                                    </td>

                                    <td>
                                        @if($order->pay_status)
                                            پرداخت شده
                                        @else
                                            لغو شده
                                        @endif
                                    </td>

                                    <td class="details-link">
                                        <a href="{{route('site.profile.orders.show',['order'=>$order])}}">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
                                    </td>
                                </tr>

                            @endforeach
                            <tr>
                                <td class="link-to-orders" colspan="7">
                                    <a href="{{route('site.profile.orders')}}">
                                        مشاهده لیست سفارش ها
                                    </a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection