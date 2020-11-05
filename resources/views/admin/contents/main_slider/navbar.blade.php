
<div class="card-header">
    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.mainSliders.index')?'active':''}}"
               href="{!! route('panel.mainSliders.index') !!}"><i
                        class="fa fa-list mr-2"></i>
                لیست تصاویر اسلایدر اصلی
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.mainSliders.create')?'active':''}}"
               href="{!! route('panel.mainSliders.create') !!}"><i
                        class="fa fa-plus mr-2"></i>
                ایجاد اسلاید جدید
            </a>
        </li>

        @if(Route::currentRouteName()=='panel.mainSliders.edit')
            <li class="nav-item ">
                <a class="nav-link active"
                   href="#"><i
                            class="fa fa-pencil-alt mr-2"></i>
                    ویرایش اسلاید
                </a>
            </li>
        @endif

    </ul>
</div>