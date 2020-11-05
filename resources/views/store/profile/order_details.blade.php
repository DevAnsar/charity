@extends('store.profile.master')
@section('profile-content')

    <div class="col-xl-9 col-lg-8 col-md-8 col-sm-12">
        <div class="row">
            <div class="col-12">
                <div class="profile-navbar">
                    <a href="{{route('site.profile.orders')}}" class="profile-navbar-btn-back">بازگشت</a>
                    <h4>سفارش <span class="font-en">
                            {{$order->order_number}}
                        </span>
                        <span>
                            ثبت شده در تاریخ
                            {{\Hekmatinasser\Verta\Verta::instance($order->created_at)
                                                          ->format('d  M  Y')}}
                        </span>
                    </h4>


                    <a href="{{route('panel.orders.show',['order'=>$order])}}" class="btn btn-info btn-sm mx-3">جزییات
                        کامل این
                        مرسوله</a>

                </div>
            </div>
            <div class="col-12 mb-4">
                <div class="dt-sl dt-sn">
                    <div class="row table-draught px-3">
                        <div class="col-md-6 col-sm-12">
                            <span class="title">تحویل گیرنده:</span>
                            <span class="value">{{$order->receiver}}</span>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <span class="title">شماره تماس تحویل گیرنده:</span>
                            <span class="value">
                                {{$order->mobile}}
                            </span>
                        </div>

                        <div class="col-md-6 col-sm-12">
                            <span class="title">نحوه ارسال سفارش:</span>
                            <span class="value">
                                {{$order->send_type_title}}
                            </span>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <span class="title">هزینه ارسال:</span>
                            <span class="value">
                                {{number_format($order->send_type_price)}}
                                تومان
                            </span>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <span class="title">مبلغ این مرسوله:</span>
                            <span class="value">
                                {{number_format($order->total_price)}}
                                تومان
                            </span>

                        </div>

                        <div class="col-md-6 col-sm-6">
                            <span class="title">مبلغ قابل پرداخت:</span>
                            <span class="value">
                                {{number_format($order->paid_price)}}
                                تومان

                                @if($order->has_needy)
                                    (طرح نیازمندی)
                                @endif
                            </span>

                        </div>

                        <div class="col-md-6 col-sm-6">
                            <span class="title">وضعیت پرداخت:</span>
                            <span class="value">
                               @if($order->status >= '0')

                                    @if($order->pay_status)
                                        <button class="btn btn-success">
                                            پرداخت شده
                                        </button>
                                    @else

                                        @if(\Carbon\Carbon::now()->subHours(12) < $order->created_at)
                                            پرداخت نشده
                                            <a href="{{route('site.get-pay-again',['order'=>$order,'_type'=>'1'])}}"
                                               class="btn btn-info">
                                            پرداخت کن
                                        </a>
                                        @else
                                            <button class="btn btn-danger btn-sm">
                                                سفارش لغو شده است
                                            </button>
                                        @endif
                                    @endif

                                @else
                                    <button class="btn btn-danger btn-sm">
                                       سفارش لغو شده است
                                   </button>
                                @endif
                            </span>

                        </div>
                        <div class="col-md-12 col-sm-12">

                            @if(auth()->user()->id == $order->user_id )
                                @if($order->status > '1')

                                    <div class="py-2  row">
                                        <div class="col-12">

                                            <span class="title">
                                                ویرایش وضعیت تحویل سفارش
                                            </span>
                                            <form class="form-group"
                                                  action="{{route('site.profile.orders.send_type.update',['order'=>$order])}}"
                                                  method="post">

                                                @csrf
                                                @method('patch')
                                                <div class="btn-toolbar p-3" role="toolbar">
                                                    <div class="btn-group mr-2 mb-2 mb-sm-0" style="direction: ltr">
                                                        <button @if($order->status=='3') disabled @endif type="submit"
                                                                class="btn btn-info"> ویرایش
                                                        </button>
                                                        <select name="send_status" class="form-control"
                                                                @if($order->status=='3') disabled @endif>
                                                            <option value="3" @if($order->status=='3') selected
                                                                    @endif >
                                                                تحویل گرفته
                                                            </option>
                                                            <option value="2"
                                                                    @if($order->status=='2') selected @endif >
                                                                در انتظار تحویل
                                                            </option>

                                                        </select>

                                                    </div>
                                                </div>
                                            </form>


                                        </div>
                                    </div>

                                @endif
                            @endif


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mb-4">
                <section class="slider-section dt-sl mb-5">
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="section-title text-sm-title title-wide no-after-title-wide">
                                <h2> وضعییت مرسوله</h2>
                                {{--<a href="#">لغو دریافت مرسوله</a>--}}
                            </div>
                        </div>

                        <!-- Start Profile-order-step-Slider -->
                        <div class="col-12">
                            <div class="profile-order-steps carousel-lg owl-carousel owl-theme">

                                <div class="item profile-order-steps-item @if($order->status >'-1' &&$order->pay_status=='1') is-active @endif">
                                    <img src="{{asset('store/assets/img/svg/0eab59b0.svg')}}">
                                    <span>ثبت سفارش و پرداخت</span>
                                </div>

                                <div class="item profile-order-steps-item @if($order->status >'0' &&$order->pay_status=='1') is-active @endif">
                                    <img src="{{asset('store/assets/img/svg/d5d5e1d2.svg')}}">
                                    <span>
                                        تایید سفارش

                                    </span>
                                </div>
                                <div class="item profile-order-steps-item @if($order->status >'1') is-active @endif">
                                    <img src="{{asset('store/assets/img/svg/3db3cdeb.svg')}}">
                                    <span>آماده‌سازی سفارش</span>
                                </div>
                                {{--<div class="item profile-order-steps-item">--}}
                                {{--<img src="{{asset('store/assets/img/svg/332b9ff1.svg')}}">--}}
                                {{--<span>خروج از مرکز پردازش</span>--}}
                                {{--</div>--}}
                                <div class="item profile-order-steps-item @if($order->status >'1') is-active @endif">
                                    <img src="{{asset('store/assets/img/svg/07a0808a.svg')}}">
                                    <span>تحویل به پست</span>
                                </div>
                                {{--<div class="item profile-order-steps-item">--}}
                                {{--<img src="{{asset('store/assets/img/svg/dbab74ce.svg')}}">--}}
                                {{--<span>مرکز مبادلات پست</span>--}}
                                {{--</div>--}}
                                <div class="item profile-order-steps-item @if($order->status >'2') is-active @endif">
                                    <img src="{{asset('store/assets/img/svg/50450a73.svg')}}">
                                    <span>تحویل به مشتری</span>
                                </div>
                            </div>
                        </div>
                        <!-- End Profile-order-step-Slider -->

                    </div>
                </section>
            </div>
            <div class="col-12">
                <div
                        class="section-title text-sm-title title-wide mb-1 no-after-title-wide dt-sl mb-2 px-res-1">
                    <h2>همه سفارش‌ها</h2>
                </div>
                <div class="dt-sl">
                    <div class="table-responsive">
                        <table class="table table-order table-order-details">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>نام محصول</th>
                                <th>تعداد</th>
                                <th>قیمت واحد</th>
                                <th>قیمت نهایی</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->products_fields as $key=>$product_field)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        <div class="details-product-area">
                                            <img src="{{env('IMG').$product_field->image}}"
                                                 class="thumbnail-product" alt="">
                                            <h5 class="details-product">

                                                <span>
                                                    {{$product_field->title}}
                                                </span>
                                                <span>فروشنده :
                                                    {{$product_field->product->user->name}}
                                                </span>
                                                {{--<span>رنگ : سفید</span>--}}
                                            </h5>
                                        </div>
                                    </td>
                                    <td>
                                        {{$product_field->quantity}}
                                    </td>
                                    <td>
                                        {{number_format($product_field->price)}}
                                        تومان
                                    </td>
                                    <td>
                                        {{number_format($product_field->total_price)}}
                                        تومان
                                    </td>

                                    <td>
                                        <a href="{{route('site.product',['slug'=>$product_field->product->slug])}}"
                                           class="btn btn-info d-block w-100 mb-2">
                                            خرید
                                            مجدد
                                        </a>
                                        {{--<button class="btn text-light bg-secondary d-block w-100">ثبت--}}
                                        {{--نظر--}}
                                        {{--</button>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection