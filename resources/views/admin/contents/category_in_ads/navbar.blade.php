
<div class="card-header">
    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.categoryInAds.index')?'active':''}}"
               href="{!! route('panel.categoryInAds.index') !!}"><i
                        class="fa fa-list mr-2"></i>
                لیست دسته ها
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.categoryInAds.create')?'active':''}}"
               href="{!! route('panel.categoryInAds.create') !!}"><i
                        class="fa fa-plus mr-2"></i>
                افزودن دسته جدید
            </a>
        </li>

        @if(Route::currentRouteName()=='panel.categoryInAds.edit')
            <li class="nav-item ">
                <a class="nav-link active"
                   href="#"><i
                            class="fa fa-pencil-alt mr-2"></i>
                    ویرایش
                </a>
            </li>
        @endif

    </ul>
</div>