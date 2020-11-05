@extends('admin.master')
@push('css_lib')
    {{--dropzone--}}
    {{--<link rel="stylesheet" href="{{asset('plugins/dropzone/bootstrap.min.css')}}">--}}
@endpush
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">مشاهده ی سفارش</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">


                <div class="card">
                    @include('admin.orders.navbar')
                    <div class="card-body">
                        <div class="invoice-title">

                            <div class="mb-4">
                                <h4 class="font-size-16">سفارش با کد :
                                    {{$order->order_number}}
                                </h4>
                                {{--<img src="assets/images/logo-dark.png" alt="logo" height="20" />--}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6">
                                <address>
                                    <strong>سفارش دهنده:</strong>
                                    <a>
                                        {{$order->user->name}}
                                    </a>
                                    -

                                    {{$order->user->email}}
                                    -
                                    {{$order->user->mobile}}

                                </address>
                            </div>
                            <div class="col-6">
                                <address>
                                    <strong>آدرس:</strong><br>
                                    {{$order->address}}
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mt-3">
                                <address>
                                    <strong>نوع پرداخت:</strong>

                                    @if($payment)
                                        @if($payment->type=='bank')
                                            بانک
                                        @else

                                        @endif
                                    @else
                                        پرداخت یافت نشد
                                    @endif
                                </address>
                            </div>
                            <div class="col-6 mt-3 ">
                                <address>
                                    <strong>تاریخ سفارش:</strong>
                                    {{\Hekmatinasser\Verta\Verta::instance($order->created_at)->timezone('Asia/Tehran')->format('Y/m/d-H:i')}}
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mt-2">
                                <address>
                                    <strong>وضعیت سفارش:</strong>
                                    @if($order->pay_status=='1')
                                        @if($order->status=='0')
                                            @if($order->has_needy)
                                                در حال جمع آوری مبالغ
                                            @else
                                                در انتظار تایید
                                            @endif

                                        @elseif($order->status=='1')
                                            پزدازش انبار
                                        @elseif($order->status=='2')
                                            ارسال شده
                                        @elseif($order->status=='3')
                                            تحویل داده شده
                                        @endif

                                    @else

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
                                                لغو شده
                                            </button>
                                        @endif

                                    @endif
                                </address>
                            </div>
                            <div class="col-6 mt-2 ">
                                <address>
                                    <strong></strong>
                                </address>
                            </div>
                        </div>


                        <div class="py-2 mt-3">
                            <h3 class="font-size-15 font-weight-bold">خلاصه سفارش</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-nowrap">
                                <thead>
                                <tr>
                                    <th style="width: 70px;">شماره.</th>
                                    @if(auth()->user()->hasRole('store'))
                                        <th> محصول من</th>
                                    @endif
                                    <th colspan="1">نام محصول</th>
                                    <th class="">قیمت واحد</th>
                                    <th class="">تعداد</th>
                                    <th class="text-right">قیمت کل</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->products_fields as $key=>$item)
                                    <?php
                                    $is_my_product = $item->product->user_id == auth()->user()->id ? true : false;
                                    ?>
                                    <tr>
                                        <td class="{{$is_my_product ? 'text-primary':''}}">{{$key+1}}</td>
                                        @if(auth()->user()->hasRole('store'))
                                            <th>
                                                <div class="custom-control custom-checkbox mb-2">
                                                    <input type="checkbox"
                                                           class="custom-control-input"
                                                            {{$is_my_product ? 'checked':''}}
                                                    >
                                                    <label class="custom-control-label"></label>
                                                </div>
                                            </th>
                                        @endif
                                        <td>
                                            <div style="white-space: initial;"
                                                 class="{{$is_my_product ? 'text-primary':''}}">
                                                {{$item->product ? $item->product->title : $item->title}}
                                            </div>
                                        </td>
                                        <td class="{{$is_my_product ? 'text-primary':''}}">
                                            {{number_format($item->price)}}
                                            تومان
                                        </td>
                                        <td class="{{$is_my_product ? 'text-primary':''}}">
                                            {{number_format($item->quantity)}}

                                        </td>
                                        <td class="{{$is_my_product ? 'text-primary':''}} text-right">
                                            {{number_format($item->total_price)}}
                                            تومان
                                        </td>

                                    </tr>
                                @endforeach
                                <tr class="">
                                    <td colspan="4">#</td>
                                    <td>
                                        جمع فاکتور
                                    </td>

                                    <td class="text-right text-success">
                                        {{number_format($order->total_price)}}
                                        تومان
                                    </td>

                                </tr>
                                <tr>
                                    <td colspan="4">#</td>
                                    <td>
                                        پرداخت شده
                                    </td>

                                    <td class="text-right">
                                        {{number_format($order->paid_price)}}
                                        تومان
                                    </td>

                                </tr>
                                <tr>
                                    <td colspan="4">#</td>
                                    <td>
                                        مجموع پرداخت اسپانسرها
                                    </td>

                                    <td class="text-right">
                                        {{number_format($order->sponsor_total_price)}}
                                        تومان
                                    </td>

                                </tr>
                                <tr>
                                    <td colspan="4">#</td>
                                    <td>
                                        باقی مانده
                                    </td>

                                    <td class="text-right text-danger">
                                        {{number_format( ($order->total_price - $order->paid_price) -$order->sponsor_total_price)}}
                                        تومان
                                    </td>

                                </tr>

                                </tbody>
                            </table>
                        </div>

                        @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('helper') || auth()->user()->hasRole('needy'))
                            <div class="py-2 mt-3">
                                <h3 class="font-size-15 font-weight-bold">اطلاعات اسپانسر ها</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-nowrap">
                                    <thead>
                                    <tr>
                                        <th style="width: 70px;">شماره.</th>
                                        <th>نام</th>
                                        <th class="">مبلغ پرداخت شده</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($order->sponsors()->count() >0)
                                        @foreach($order->sponsors as $key=>$sponsor)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$sponsor->user->name}}</td>
                                                <td class="">
                                                    {{number_format($sponsor->amount)}}
                                                    تومان
                                                </td>
                                            </tr>

                                        @endforeach
                                        <tr>
                                            <td>#</td>
                                            <td>مجموع پرداخت ها</td>
                                            <td class="text-success">
                                                {{number_format($order->sponsors()->sum('amount'))}}
                                                تومان
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>
                                                اسپانسری یافت نشد
                                            </td>
                                        </tr>
                                    @endif

                                    </tbody>
                                </table>
                            </div>

                            @if(auth()->user()->hasRole('helper'))

                                @if($order->status == '0' && $order->pay_status == '1')
                                    @if( ($order->total_price - $order->paid_price) - $order->sponsor_total_price > 0)
                                        <div class="d-print-none">
                                            <div class="float-right">
                                                <button type="button"
                                                        class="btn btn-primary w-md waves-effect waves-light"
                                                        data-toggle="modal" data-target="#sponsorAmountModal"
                                                        data-order_total_price="{{number_format($order->total_price)}}"
                                                        data-order_paid_price="{{number_format($order->paid_price)}}"
                                                        data-order_left_over_price="{{number_format( ($order->total_price - $order->paid_price) -$order->sponsor_total_price)}}"
                                                        data-order_left_over="{{($order->total_price - $order->paid_price) -$order->sponsor_total_price}}"
                                                >
                                                    پرداخت کمک مالی برای سفارش
                                                </button>
                                            </div>
                                        </div>
                                    @else

                                        <div class="d-print-none">
                                            <div class="float-right">
                                                <button type="button"
                                                        class="btn disabled btn-light w-md waves-effect waves-light">
                                                    کل مبلغ باقی مانده پرداخت شده است
                                                </button>
                                            </div>
                                        </div>
                                    @endif
                                @else

                                    {{--//--}}
                                @endif
                            @endif

                        @endif


                        @if(auth()->user()->hasRole('admin') )
                            <div class="py-2 mt-5">
                                <h3 class="font-size-15 font-weight-bold">ویرایش وضعیت سفارش</h3>
                            </div>

                            <div class="py-2  row">
                                <div class="col-12">

                                    <form class="form-group"
                                          action="{{route('panel.orders.update',['order'=>$order,'list'=>$list])}}"
                                          method="post">

                                        @csrf
                                        @method('patch')
                                        <div class="btn-toolbar p-3" role="toolbar">
                                            <div class="btn-group mr-2 mb-2 mb-sm-0">
                                                <select name="status" class="form-control">
                                                    <option @if($order->status=='0' && $order->pay_status=='0') selected
                                                            @endif  disabled>
                                                        پرداخت نشده
                                                    </option>
                                                    <option value="0"
                                                            @if($order->status=='0' && $order->pay_status=='1') selected @endif >
                                                        در انتظار تایید
                                                    </option>
                                                    <option value="1"
                                                            @if($order->status=='1' && $order->pay_status=='1') selected @endif >
                                                        پردازش انبار
                                                    </option>
                                                    <option value="2"
                                                            @if($order->status=='2' && $order->pay_status=='1') selected @endif >
                                                        ارسال شده
                                                    </option>
                                                    <option value="3"
                                                            @if($order->status=='3' && $order->pay_status=='1') selected @endif >
                                                        تحویل داده شده
                                                    </option>
                                                </select>
                                                <button type="submit" class="btn btn-info"> ویرایش</button>
                                            </div>
                                        </div>
                                    </form>


                                </div>
                            </div>

                        @endif

                        @if(auth()->user()->id == $order->user_id )
                            @if($order->status > '1')
                                <div class="py-2 mt-5">
                                    <h3 class="font-size-15 font-weight-bold">ویرایش وضعیت تحویل سفارش</h3>
                                </div>

                                <div class="py-2  row">
                                    <div class="col-12">

                                        <form class="form-group"
                                              action="{{route('panel.orders.send_status.update',['order'=>$order,'list'=>$list])}}"
                                              method="post">

                                            @csrf
                                            @method('patch')
                                            <div class="btn-toolbar p-3" role="toolbar">
                                                <div class="btn-group mr-2 mb-2 mb-sm-0">
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
                                                    <button @if($order->status=='3') disabled @endif type="submit"
                                                            class="btn btn-info"> ویرایش
                                                    </button>
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
        <!-- end row -->

        <div class="modal fade" id="sponsorAmountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{url("/panel/orders/$order->id/sponsor")}}" method="post">
                        @csrf
                        @method('post')
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">کمک مالی برای سفارش</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">


                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">
                                    مبلغ کل سفارش:
                                    <span class="order_total_price"></span>
                                    تومان
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">
                                    مبلغ پرداخت شده از سفارش:
                                    <span class="order_paid_price"></span>
                                    تومان
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">
                                    مبلغ باقی مانده از سفارش:
                                    <span class="order_left_over_price"></span>
                                    تومان
                                </label>
                            </div>
                            <wallet-help order_id="{{$order->id}}"></wallet-help>

                        </div>

                    </form>
                </div>
            </div>
        </div>


    </div>
@endsection
@push('scripts_lib')
    <script>
        $('#sponsorAmountModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);

            var order_total_price = button.data('order_total_price');
            var order_paid_price = button.data('order_paid_price');
            var order_left_over_price = button.data('order_left_over_price');
            var order_left_over = button.data('order_left_over');

            var modal = $(this);

            modal.find('.modal-body input.left_over_price').attr('max', order_left_over);
            modal.find('.modal-body .order_total_price').text(order_total_price);
            modal.find('.modal-body .order_paid_price').text(order_paid_price);
            modal.find('.modal-body .order_left_over_price').text(order_left_over_price);
        })
    </script>

@endpush
