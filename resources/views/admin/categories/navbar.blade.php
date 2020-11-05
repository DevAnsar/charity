<div class="card-header">
    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.categories.index')?'active':''}}"
               href="{!! route('panel.categories.index') !!}"><i
                        class="fa fa-list mr-2"></i>
                لیست دسته ها
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.categories.create')?'active':''}}"
               href="{!! route('panel.categories.create',['parent'=>$father_category!=null?$father_category->id:0]) !!}"><i
                        class="fa fa-plus mr-2"></i>
                ایجاد دسته ی جدید[
                @if($father_category!=null)
                    برای
                    {{$father_category->title}}
                @else
                    دسته ی اصلی
                @endif
                ]
            </a>
        </li>

        @if(Route::currentRouteName()=='panel.categories.edit')
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