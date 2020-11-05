
<div class="card-header">
    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.pages.index')?'active':''}}"
               href="{!! route('panel.pages.index') !!}"><i
                        class="fa fa-list mr-2"></i>
                لیست صفحات
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.pages.create')?'active':''}}"
               href="{!! route('panel.pages.create') !!}"><i
                        class="fa fa-plus mr-2"></i>
                ایجاد صفحه ی جدید
            </a>
        </li>

        @if(Route::currentRouteName()=='panel.pages.edit')
            <li class="nav-item ">
                <a class="nav-link active"
                   href="#"><i
                            class="fa fa-pencil-alt mr-2"></i>
                    ویرایش صفحه
                </a>
            </li>
        @endif

        @if(Route::currentRouteName()=='panel.pages.show')
            <li class="nav-item ">
                <a class="nav-link active"
                   href="#"><i
                            class="fa fa-eye mr-2"></i>
                    نمایش صفحه
                </a>
            </li>
        @endif

    </ul>
</div>