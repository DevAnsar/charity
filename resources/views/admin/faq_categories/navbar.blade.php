
<div class="card-header">
    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.faqCategories.index')?'active':''}}"
               href="{!! route('panel.faqCategories.index') !!}"><i
                        class="fa fa-list mr-2"></i>
                لیست دسته بندی سوالات متداول
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.faqCategories.create')?'active':''}}"
               href="{!! route('panel.faqCategories.create') !!}"><i
                        class="fa fa-plus mr-2"></i>
                ایجاد دسته ی جدید
            </a>
        </li>

        @if(Route::currentRouteName()=='panel.faqCategories.edit')
            <li class="nav-item ">
                <a class="nav-link active"
                   href="#"><i
                            class="fa fa-pencil-alt mr-2"></i>
                    ویرایش دسته
                </a>
            </li>
        @endif

    </ul>
</div>