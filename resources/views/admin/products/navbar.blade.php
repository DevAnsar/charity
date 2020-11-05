<div class="card-header">
    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.products.index')?'active':''}}"
               href="{!! route('panel.products.index') !!}"><i
                        class="fa fa-list mr-2"></i>
                لیست محصولات
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.products.create')?'active':''}}
            {{Route::currentRouteName()=='panel.products.properties.index'?'active':''}}"
               href="{!! route('panel.products.create') !!}">
                <i class="fa fa-plus mr-2"></i>
                ایجاد محصول جدید
                @if(Route::currentRouteName()=='panel.products.properties.index')
                    ->
                    ویژگی ها
                @endif
            </a>
        </li>

        @if(Route::currentRouteName()=='panel.products.edit')
            <li class="nav-item ">
                <a class="nav-link active"
                   href="#"><i
                            class="fa fa-pencil-alt mr-2"></i>
                    ویرایش محصول
                </a>
            </li>
        @endif

    </ul>
</div>