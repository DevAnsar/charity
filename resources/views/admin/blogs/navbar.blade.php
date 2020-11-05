
<div class="card-header">
    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.blogs.index')?'active':''}}"
               href="{!! route('panel.blogs.index') !!}"><i
                        class="fa fa-list mr-2"></i>
                لیست مقاله ها
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.blogs.create')?'active':''}}"
               href="{!! route('panel.blogs.create') !!}"><i
                        class="fa fa-plus mr-2"></i>
                ایجاد مقاله جدید
            </a>
        </li>

        @if(Route::currentRouteName()=='panel.blogs.edit')
            <li class="nav-item ">
                <a class="nav-link active"
                   href="#"><i
                            class="fa fa-pencil-alt mr-2"></i>
                    ویرایش مقاله
                </a>
            </li>
        @endif

        @if(Route::currentRouteName()=='panel.blogs.show')
            <li class="nav-item ">
                <a class="nav-link active"
                   href="#"><i
                            class="fa fa-eye mr-2"></i>
                    نمایش
                </a>
            </li>
        @endif

    </ul>
</div>