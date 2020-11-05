<div class="card-header">
    <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
        <li class="nav-item ">
            <a class="nav-link {{url()->current() == route('panel.faqs.index',['faqCategory'=>$faqCategory])?'active':''}}"
               href="{!! route('panel.faqs.index',['faqCategory'=>$faqCategory]) !!}"><i
                        class="fa fa-list mr-2"></i>
                لیست سوالات متداول
            </a>
        </li>

        @can('panel.faqs.create')
            <li class="nav-item ">
                <a class="nav-link {{url()->current() == route('panel.faqs.create',['faqCategory'=>$faqCategory])?'active':''}}"
                   href="{!! route('panel.faqs.create',['faqCategory'=>$faqCategory]) !!}"><i
                            class="fa fa-plus mr-2"></i>
                    ایجاد سوال جدید
                </a>
            </li>
        @endif

        @if(Route::currentRouteName()=='panel.faqs.edit')
            <li class="nav-item ">
                <a class="nav-link active"
                   href="#"><i
                            class="fa fa-pencil-alt mr-2"></i>
                    ویرایش سوال
                </a>
            </li>
        @endif

        <li class="nav-item ">
            <a class="nav-link"
               href="{{route('panel.faqCategories.index')}}"><i
                        class="fa fa-share-square mr-2"></i>
                برگشت به دسته ی سوال
            </a>
        </li>

        @if(Route::currentRouteName()=='panel.faqs.show')
            <li class="nav-item ">
                <a class="nav-link active"
                   href="#"><i
                            class="fa fa-eye mr-2"></i>
                    مشاهده ی سوال
                </a>
            </li>
        @endif

    </ul>
</div>