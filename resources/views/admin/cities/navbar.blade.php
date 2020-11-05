<div class="card-header">
    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.cities.index')?'active':''}}"
               href="{!! route('panel.cities.index') !!}"><i
                        class="fa fa-list mr-2"></i>

                لیست
                @if($state!=null)
                    شهرهای
                    {{$state->title}}
                @else
                    استان ها
                @endif
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.cities.create')?'active':''}}"
               href="{!! route('panel.cities.create',['parent'=>$state!=null?$state->id:0]) !!}"><i
                        class="fa fa-plus mr-2"></i>
                ایجاد
                @if($state!=null)
                     شهر جدید[
                    برای
                    {{$state->title}}
                    ]
                @else
                    استان جدید
                @endif

            </a>
        </li>

        @if(Route::currentRouteName()=='panel.cities.edit')
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