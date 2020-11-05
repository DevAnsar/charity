@extends('store.profile.master')
@section('profile-content')

    <div class="col-xl-9 col-lg-8 col-md-8 col-sm-12">
        <div class="row">
            <div class="col-12">
                <div
                        class="section-title text-sm-title title-wide mb-1 no-after-title-wide dt-sl mb-2 px-res-1">
                    <h2>همه سفارش‌ها</h2>
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
                            @foreach($orders as $key=>$order)
                                <tr>
                                    <td>{{$key+1}}</td>
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
                                        @if($order->status >= '0')
                                            @if($order->pay_status)
                                                پرداخت شده
                                            @else
                                                @if(\Carbon\Carbon::now()->subHours(12) < $order->created_at)
                                                    در انتظار پرداخت
                                                @else
                                                    <button class="btn btn-danger btn-sm">
                                                        لغو شده
                                                    </button>
                                                @endif

                                            @endif
                                        @else
                                            <button class="btn btn-danger btn-sm">
                                                لغو شده
                                            </button>
                                        @endif
                                    </td>

                                    <td class="details-link">
                                        <a href="{{route('site.profile.orders.show',['order'=>$order])}}">
                                            <i class="mdi mdi-chevron-left"></i>
                                        </a>
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