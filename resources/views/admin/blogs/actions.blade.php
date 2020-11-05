<div class='btn-group btn-group-sm'>
    @can('panel.blogs.show')
        <a data-toggle="tooltip" data-placement="bottom"
           title="مشاهده ی جزییات"
           href="{{ route('panel.blogs.show', $id) }}"
           class='btn btn-link'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan

    @can('panel.blogs.edit')
        <a data-toggle="tooltip" data-placement="bottom"
           title="ویرایش"
           href="{{ route('panel.blogs.edit', $id) }}"
           class='btn btn-link'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan

    @can('panel.blogs.destroy')
        <form action="{{route('panel.blogs.destroy',['blog'=>$id])}}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-link text-danger pt-1" onclick="return confirm('آیا مطمعن هستید')">
                <i class="fa fa-trash"></i>
            </button>
        </form>
    @endcan
</div>