
<div class="card-header">
    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.collaborators.index')?'active':''}}"
               href="{!! route('panel.collaborators.index') !!}"><i
                        class="fa fa-list mr-2"></i>
                لیست همیاران
            </a>
        </li>
        {{--<li class="nav-item ">--}}
            {{--<a class="nav-link {{url()->current() == route('panel.collaborators.create')?'active':''}}"--}}
               {{--href="{!! route('panel.collaborators.create') !!}"><i--}}
                        {{--class="fa fa-plus mr-2"></i>--}}
                {{--ایجاد همیار جدید--}}
            {{--</a>--}}
        {{--</li>--}}

        @if(Route::currentRouteName()=='panel.collaborators.edit')
            <li class="nav-item ">
                <a class="nav-link active"
                   href="#"><i
                            class="fa fa-pencil-alt mr-2"></i>
                    ویرایش همیار
                </a>
            </li>
        @endif

        @if(Route::currentRouteName()=='panel.collaborators.show')
            <li class="nav-item ">
                <a class="nav-link active"
                   href="#"><i
                            class="fa fa-eye mr-2"></i>
                    مشاهده ی همیار
                </a>
            </li>
        @endif

    </ul>
</div>