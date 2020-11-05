<div class='btn-group btn-group-sm'>
    @can('panel.propertyDefaults.show')
        <a data-toggle="tooltip" data-placement="bottom"
           title="مشاهده ی جزییات"
           href="{{ route('panel.propertyDefaults.show',['category'=>$category,'property'=>$property,'propertyDefault'=>$id]) }}"
           class='btn btn-link'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan

    @can('panel.propertyDefaults.edit')
        <a data-toggle="tooltip" data-placement="bottom"
           title="ویرایش"
           href="{{ route('panel.propertyDefaults.edit',['category'=>$category,'property'=>$property,'propertyDefault'=>$id]) }}"
           class='btn btn-link'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan

    @can('panel.propertyDefaults.destroy')
        <form action="{{route('panel.propertyDefaults.destroy',['category'=>$category,'property'=>$property,'propertyDefault'=>$id])}}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-link text-danger pt-1" onclick="return confirm('آیا مطمعن هستید')">
                <i class="fa fa-trash"></i>
            </button>
        </form>
    @endcan
</div>