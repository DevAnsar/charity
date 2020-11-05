<div class="card-header">
    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.blogCategories.index')?'active':''}}"
               href="{!! route('panel.blogCategories.index') !!}"><i
                        class="fa fa-list mr-2"></i>
                لیست دسته بندی وبلاگ
                @if($parent!=null)
                    :
                    {{$parent->title}}
                @endif
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.blogCategories.create')?'active':''}}"
               href="{!! route('panel.blogCategories.create',['parent_id'=>$parent?$parent->id:0]) !!}"><i
                        class="fa fa-plus mr-2"></i>
                ایجاد دسته ی جدید
                @if($parent==null)

                @else

                    برای
                    [
                    {{$parent->title}}
                    ]
                @endif
            </a>
        </li>

        @if(Route::currentRouteName()=='panel.blogCategories.edit')
            <li class="nav-item ">
                <a class="nav-link active"
                   href="#"><i
                            class="fa fa-pencil-alt mr-2"></i>
                    ویرایش دسته
                </a>
            </li>
        @endif

        @if(Route::currentRouteName()=='panel.blogCategories.show')
            <li class="nav-item ">
                <a class="nav-link active"
                   href="#"><i
                            class="fa fa-eye mr-2"></i>
                    نمایش دسته
                </a>
            </li>
        @endif

    </ul>
</div>