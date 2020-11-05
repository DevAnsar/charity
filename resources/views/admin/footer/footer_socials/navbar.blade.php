
<div class="card-header">
    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.footerSocials.index')?'active':''}}"
               href="{!! route('panel.footerSocials.index') !!}"><i
                        class="fa fa-list mr-2"></i>
                لیست شبکه های اجتماعی
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.footerSocials.create')?'active':''}}"
               href="{!! route('panel.footerSocials.create') !!}"><i
                        class="fa fa-plus mr-2"></i>
                ایجاد شبکه ی اجتماعی جدید
            </a>
        </li>

        @if(Route::currentRouteName()=='panel.footerSocials.edit')
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