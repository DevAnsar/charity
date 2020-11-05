<div class='btn-group btn-group-sm'>
    @can('panel.blogCategories.show')
        <a data-toggle="tooltip" data-placement="bottom"
           title="مشاهده ی جزییات"
           href="{{ route('panel.blogCategories.show', ['blogCategory'=>$id,'parent_id'=>$parent_id]) }}"
           class='btn btn-link'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan

    @can('panel.blogCategories.edit')
        <a data-toggle="tooltip" data-placement="bottom"
           title="ویرایش"
           href="{{ route('panel.blogCategories.edit', ['blogCategory'=>$id,'parent_id'=>$parent_id]) }}"
           class='btn btn-link'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan

    @can('panel.blogCategories.destroy')
        <form action="{{route('panel.blogCategories.destroy',['blogCategory'=>$id,'parent_id'=>$parent_id])}}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-link text-danger pt-1" onclick="return confirm('آیا مطمعن هستید')">
                <i class="fa fa-trash"></i>
            </button>
        </form>
    @endcan
</div>