<div class='btn-group btn-group-sm'>
    @can('panel.roles.show')
        <a data-toggle="tooltip" data-placement="bottom"
           title="{{trans('lang.view_details')}}"
           href="{{ route('panel.roles.show', $id) }}"
           class='btn btn-link'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan

    @can('panel.roles.edit')
        <a data-toggle="tooltip" data-placement="bottom"
           title="{{trans('lang.gallery_edit')}}"
           href="{{ route('panel.roles.edit', $id) }}"
           class='btn btn-link'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan

    @can('panel.roles.destroy')
            <form action="{{route('panel.roles.destroy',['role'=>$id])}}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-link text-danger pt-1" onclick="return confirm('آیا مطمعن هستید')">
                    <i class="fa fa-trash"></i>
                </button>
            </form>
    @endcan
</div>