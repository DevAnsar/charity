<div class='btn-group btn-group-sm'>
    @can('panel.properties.show')
        <a data-toggle="tooltip" data-placement="bottom"
           title="مشاهده ی جزییات"
           href="{{ route('panel.properties.show',['category'=>$category,'property'=>$id]) }}"
           class='btn btn-link'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan

    @can('panel.properties.edit')
        <a data-toggle="tooltip" data-placement="bottom"
           title="ویرایش"
           href="{{ route('panel.properties.edit',['category'=>$category,'property'=>$id]) }}"
           class='btn btn-link'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan

    @can('panel.properties.destroy')
        <form action="{{route('panel.properties.destroy',['category'=>$category,'property'=>$id])}}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-link text-danger pt-1" onclick="return confirm('آیا مطمعن هستید')">
                <i class="fa fa-trash"></i>
            </button>
        </form>
    @endcan
</div>