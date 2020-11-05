<div class="card-header">
    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.propertyDefaults.index',['category'=>$category,'property'=>$property])?'active':''}}"
               href="{!! route('panel.propertyDefaults.index',['category'=>$category->id,'property'=>$property]) !!}"><i
                        class="fa fa-list mr-2"></i>
                لیست مقادیر
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.propertyDefaults.create',['category'=>$category,'property'=>$property])?'active':''}}"
               href="{!! route('panel.propertyDefaults.create',['category'=>$category->id,'property'=>$property]) !!}">
                <i class="fa fa-plus mr-2"></i>
                ایجاد مقدار جدید[
                @if($property!=null)
                    برای
                    {{$property->title}}
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
                            class="fa fa-pencil-alt mr-2"></i>
                    ویرایش ویژگی
                </a>
            </li>
        @endif

    </ul>
</div>