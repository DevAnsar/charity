<div class="card-header">
    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.orders.index')?'active':''}}"
               href="{!! route('panel.orders.index',['list'=>isset($list)?$list:'open']) !!}"><i
                        class="fa fa-list mr-2"></i>
                لیست سفارشات
                @if(isset($list))
                    :

                    @if($list=='unpaid')
                        پرداخت نشده
                    @endif

                    @if($list=='open')
                        باز
                    @endif
                    @if($list=='open_needy')
                        باز نیازمندان
                    @endif

                    @if($list=='processing')
                        معلق
                    @endif
                    @if($list=='posted')
                        ارسال شده
                    @endif
                    @if($list=='delivered')
                        تحویل داده شده
                    @endif
                @endif
            </a>
        </li>
        {{--<li class="nav-item ">--}}
        {{--<a class="nav-link {{url()->current() == route('panel.orders.create')?'active':''}}"--}}
        {{--href="{!! route('panel.orders.create') !!}">--}}
        {{--<i class="fa fa-plus mr-2"></i>--}}
        {{--ایجاد سفارش جدید--}}
        {{----}}
        {{--</a>--}}
        {{--</li>--}}

        @if(Route::currentRouteName()=='panel.orders.show')
            <li class="nav-item ">
                <a class="nav-link active"
                   href="#"><i
                            class="fa fa-plus mr-2"></i>
                    نمایش سفارش
                </a>
            </li>
        @endif
        @if(Route::currentRouteName()=='panel.orders.edit')
            <li class="nav-item ">
                <a class="nav-link active"
                   href="#"><i
                            class="fa fa-pencil-alt mr-2"></i>
                    ویرایش سفارش
                </a>
            </li>
        @endif

    </ul>
</div>