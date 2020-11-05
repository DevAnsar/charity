<div class='btn-group btn-group-sm'>


    @can('panel.products.destroy')
        <form action="{{route('panel.products.destroy',['product'=>$id])}}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-link text-danger pt-1" onclick="return confirm('آیا مطمعن هستید')">
                <i class="fa fa-trash font-size-18"></i>
            </button>
        </form>
    @endcan

    @can('panel.products.show')
        {{--<a data-toggle="tooltip" data-placement="bottom"--}}
           {{--title="جزییات"--}}
           {{--href="{{ route('panel.products.show', $id) }}"--}}
           {{--class='btn btn-link'>--}}
            {{--<i class="fa fa-eye font-size-18"></i>--}}
        {{--</a>--}}
        <a data-toggle="tooltip" data-placement="bottom"
           title="جزییات"
           href="{{ route('site.product',['slug'=>$product->slug]) }}"
           class='btn btn-link'>
            <i class="fa fa-eye font-size-18"></i>
        </a>
    @endcan

    @can('panel.products.edit')
        <a data-toggle="tooltip" data-placement="bottom"
           title="ویرایش"
           href="{{ route('panel.products.edit', $id) }}"
           class='btn btn-link'>
            <i class="fa fa-edit font-size-18"></i>
        </a>
    @endcan

    @can('panel.productAdminReviews.index')
        <a data-toggle="tooltip" data-placement="bottom"
           title="نقد و بررسی"
           href="{{ route('panel.productAdminReviews.index',['product'=>$id]) }}"
           class='btn btn-link text-success'>
            <i class="fa fa-pencil-ruler font-size-18"></i>
        </a>
    @endcan

    @can('panel.products.properties.index')
        <a data-toggle="tooltip" data-placement="bottom"
           title="ویژگی ها"
           href="{{ route('panel.products.properties.index',['product'=>$id]) }}"
           class='btn btn-link text-success'>
            <i class="fa fa-clipboard-list font-size-18"></i>
        </a>
    @endcan
    @can('panel.products.images.index')
        <a data-toggle="tooltip" data-placement="bottom"
           title="تصاویر"
           href="{{ route('panel.products.images.index',['product'=>$id]) }}"
           class='btn btn-link text-success'>
            <i class="fa fa-images font-size-18"></i>
        </a>
    @endcan
</div>