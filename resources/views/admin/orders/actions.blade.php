<div class='btn-group btn-group-sm'>

    @can('panel.orders.destroy')
        <form action="{{route('panel.orders.destroy',['order'=>$id])}}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-link text-danger pt-1" onclick="return confirm('آیا مطمعن هستید')">
                <i class="fa fa-trash font-size-18"></i>
            </button>
        </form>
    @endcan

    @can('panel.orders.show')
        <a data-toggle="tooltip" data-placement="bottom"
           title="{{trans('lang.view_details')}}"
           href="{{ route('panel.orders.show',['order'=>$id,'list'=>$list]) }}"
           class='btn btn-link'>
            <i class="fa fa-eye font-size-18"></i>
        </a>
    @endcan

    @can('panel.orders.edit')
        <a data-toggle="tooltip" data-placement="bottom"
           title="ویرایش"
           href="{{ route('panel.orders.edit', $id) }}"
           class='btn btn-link'>
            <i class="fa fa-edit font-size-18"></i>
        </a>
    @endcan

</div>