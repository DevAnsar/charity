<div class="card-header">
    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
        <li class="nav-item ">
            <a class="nav-link {{Route::currentRouteName()=='panel.productAdminReviews.index'?'active':''}}"
               href="{!! route('panel.products.index') !!}"><i
                        class="fa fa-list mr-2"></i>
                لیست
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link
            {{Route::currentRouteName()=='panel.productAdminReviews.create'?'active':''}}"
               href="{!! route('panel.productAdminReviews.create',['product'=>$product->id]) !!}">
                <i class="fa fa-plus mr-2"></i>
                ایجاد نقد جدید
            </a>
        </li>

        @if(Route::currentRouteName()=='panel.productAdminReviews.edit')
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