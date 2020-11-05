<div class="card-header">
    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.productReviews.index',['list'=>$list])?'active':''}}"
               href="{!! route('panel.productReviews.index',['list'=>$list]) !!}"><i
                        class="fa fa-list mr-2"></i>

                لیست نظرات
                @if($list!=null)

                @else

                @endif
            </a>
        </li>
        {{--<li class="nav-item ">--}}
            {{--<a class="nav-link {{url()->current() == route('panel.productReviews.create')?'active':''}}"--}}
               {{--href="{!! route('panel.productReviews.create',['parent'=>$list!=null?$list->id:0]) !!}"><i--}}
                        {{--class="fa fa-plus mr-2"></i>--}}
                {{--ایجاد--}}
                {{--@if($list!=null)--}}
                     {{--شهر جدید[--}}
                    {{--برای--}}
                    {{--{{$list->title}}--}}
                    {{--]--}}
                {{--@else--}}
                    {{--استان جدید--}}
                {{--@endif--}}

            {{--</a>--}}
        {{--</li>--}}

        {{--@if(Route::currentRouteName()=='panel.productReviews.edit')--}}
            {{--<li class="nav-item ">--}}
                {{--<a class="nav-link active"--}}
                   {{--href="#"><i--}}
                            {{--class="fa fa-pencil-alt mr-2"></i>--}}
                    {{--ویرایش--}}
                {{--</a>--}}
            {{--</li>--}}
        {{--@endif--}}

    </ul>
</div>