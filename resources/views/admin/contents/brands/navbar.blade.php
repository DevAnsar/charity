
<div class="card-header">
    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.brands.index')?'active':''}}"
               href="{!! route('panel.brands.index') !!}"><i
                        class="fa fa-list mr-2"></i>
                لیست برندها
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.brands.create')?'active':''}}"
               href="{!! route('panel.brands.create') !!}"><i
                        class="fa fa-plus mr-2"></i>
                ایجاد برند جدید
            </a>
        </li>

        @if(Route::currentRouteName()=='panel.brands.edit')
            <li class="nav-item ">
                <a class="nav-link active"
                   href="#"><i
                            class="fa fa-pencil-alt mr-2"></i>
                    ویرایش برند
                </a>
            </li>
        @endif

    </ul>
</div>