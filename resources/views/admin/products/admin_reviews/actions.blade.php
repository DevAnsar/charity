<div class='btn-group btn-group-sm'>


    @can('panel.productAdminReviews.destroy')
        <form action="{{route('panel.productAdminReviews.destroy',['product'=>$product->id,'productAdminReview'=>$id])}}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-link text-danger pt-1" onclick="return confirm('آیا مطمعن هستید')">
                <i class="fa fa-trash font-size-18"></i>
            </button>
        </form>
    @endcan

    @can('panel.productAdminReviews.edit')
        <a data-toggle="tooltip" data-placement="bottom"
           title="ویرایش"
           href="{{ route('panel.productAdminReviews.edit',['product'=>$product->id,'productAdminReview'=>$id]) }}"
           class='btn btn-link'>
            <i class="fa fa-edit font-size-18"></i>
        </a>
    @endcan

</div>