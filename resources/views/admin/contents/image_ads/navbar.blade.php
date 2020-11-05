
<div class="card-header">
    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.imageAds.index')?'active':''}}"
               href="{!! route('panel.imageAds.index') !!}"><i
                        class="fa fa-list mr-2"></i>
                لیست تبلیغات
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.imageAds.create')?'active':''}}"
               href="{!! route('panel.imageAds.create') !!}"><i
                        class="fa fa-plus mr-2"></i>
                ایجاد تبلیغ جدید
            </a>
        </li>

        @if(Route::currentRouteName()=='panel.imageAds.edit')
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