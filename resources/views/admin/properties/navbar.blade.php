<div class="card-header">
    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.properties.index',['category'=>$category->id])?'active':''}}"
               href="{!! route('panel.properties.index',['category'=>$category->id]) !!}"><i
                        class="fa fa-list mr-2"></i>
                لیست ویژگی ها
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.properties.create',['category'=>$category])?'active':''}}"
               href="{!! route('panel.properties.create',['category'=>$category->id]) !!}">
                <i class="fa fa-plus mr-2"></i>
                ایجاد ویژگی جدید[
                @if($category!=null)
                    برای
                    {{$category->title}}
                @else
                    دسته ی اصلی
                @endif
                ]
            </a>
        </li>

        @if(Route::currentRouteName()=='panel.properties.edit')
            <li class="nav-item ">
                <a class="nav-link active"
                   href="#"><i
                            class="fa fa-plus mr-2"></i>
                    ویرایش ویژگی
                </a>
            </li>
        @endif

    </ul>
</div>