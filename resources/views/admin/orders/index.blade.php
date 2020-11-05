@extends('admin.master')
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">
                        @if($list=='all')
                            لیست همه ی سفارشات
                        @elseif($list=='open')
                            لیست سفارشات باز
                        @endif

                    </h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">

                <div class="card">

                    @include('admin.orders.navbar')

                    <div class="card-body">

                        <div class="">
                            <table id="datatable" class="table table-hover mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    @if(!auth()->user()->hasRole('needy'))
                                        <th>سفارش دهنده</th>
                                    @endif
                                    <th>مبلغ کل سفارش</th>
                                    <th>مبلغ قابل پرداخت</th>
                                    <th>وضعیت پرداخت</th>
                                    {{--@if($list!='open')--}}
                                    {{--<th>مجموع مبالغ خیر ها</th>--}}

                                    <th>تاریخ سفارش</th>
                                    {{--<th>آخرین ویرایش</th>--}}
                                    <th>وضعیت</th>
                                    <th>تنظیمات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $key=>$order)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        @if(!auth()->user()->hasRole('needy'))
                                            <th>{{$order->user->name}}</th>
                                        @endif
                                        <th>
                                            {{number_format($order->total_price)}}
                                            تومان
                                        </th>
                                        <th>
                                            {{number_format($order->paid_price)}}
                                            تومان
                                        </th>
                                        <th>
                                            @if($order->pay_status=='0')

                                                <span class="badge badge-pill badge-soft-danger">
                                                    پرداخت نشده
                                                </span>

                                            @elseif($order->pay_status=='1')
                                                <span class="badge badge-pill badge-soft-info">
                                                    پرداخت شده
                                                </span>
                                            @endif
                                        </th>
                                        {{--<th>--}}
                                        {{--{{number_format($order->sponsor_total_price)}}--}}
                                        {{--تومان--}}
                                        {{--</th>--}}
                                        <th>
                                            {{\Hekmatinasser\Verta\Verta::instance($order->created_at)->timezone('Asia/Tehran')->format('Y/m/d')}}
                                        </th>
                                        {{--<th>--}}
                                        {{--{{\Hekmatinasser\Verta\Verta::instance($order->updated_at)->timezone('Asia/Tehran')->format('Y/m/d-H:i')}}--}}
                                        {{--</th>--}}
                                        <th>

                                            @if($order->pay_status=='1')
                                                @if($order->status=='0')

                                                    @if($order->has_needy)
                                                        <span class="badge badge-pill badge-soft-danger">
                                                        در حال جمع آوری کمک ها
                                                    </span>
                                                    @else

                                                        <span class="badge badge-pill badge-soft-info">
                                                        در انتظار تایید
                                                    </span>

                                                    @endif
                                                @elseif($order->status=='1')
                                                    <span class="badge badge-pill badge-soft-warning">
                                                    پردازش انبار
                                                </span>
                                                @elseif($order->status=='2')
                                                    <span class="badge badge-pill badge-soft-info">
                                                    ارسال شده
                                                </span>
                                                @elseif($order->status=='3')
                                                    <span class="badge badge-pill badge-soft-success">
                                                    تحویل داده شده
                                                </span>
                                                @endif

                                            @else
                                                @if($order->status >= '0')
                                                    @if(\Carbon\Carbon::now()->subHours(12) < $order->created_at)
                                                        <span class="badge badge-pill badge-soft-danger">
                                                        در انتظار پرداخت
                                                        </span>
                                                    @else
                                                        <form action="{{route('panel.orders.cancel',['order'=>$order])}}"
                                                              method="post">
                                                            @csrf
                                                            @method('patch')
                                                            <button class="btn btn-danger btn-sm" type="submit"
                                                                    onclick="return confirm('از لغو سفارش مطمعن هستید؟')">
                                                                به اتمام رسیده
                                                            </button>
                                                        </form>
                                                    @endif

                                                @else
                                                    <span class="badge badge-pill badge-soft-danger">
                                                        لغو شده
                                                    </span>
                                                @endif

                                            @endif
                                        </th>

                                        <th>
                                            @include('admin.orders.actions',['id'=>$order->id])
                                        </th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <!-- end row -->


    </div>
@endsection