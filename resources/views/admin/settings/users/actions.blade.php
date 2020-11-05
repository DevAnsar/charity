<div class='btn-group btn-group-sm'>
    @can('panel.users.show')
        <a data-toggle="tooltip" data-placement="bottom"
           title="{{trans('lang.view_details')}}"
           href="{{ route('panel.users.show', $id) }}"
           class='btn btn-link'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan

    @can('panel.users.edit')
        <a data-toggle="tooltip" data-placement="bottom"
           title="{{trans('lang.gallery_edit')}}"
           href="{{ route('panel.users.edit', $id) }}"
           class='btn btn-link'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan

    @can('panel.users.destroy')
        <form action="{{route('panel.users.destroy',['user'=>$id])}}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-link text-danger pt-1" onclick="return confirm('آیا مطمعن هستید')">
                <i class="fa fa-trash"></i>
            </button>
        </form>
    @endcan
</div>