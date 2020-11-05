<div class='btn-group btn-group-sm'>
    @can('panel.collaborators.show')
        <a data-toggle="tooltip" data-placement="bottom"
           title="مشاهده ی جزییات"
           href="{{ route('panel.collaborators.show', ['collaborator'=>$collaborator]) }}"
           class='btn btn-link'>
            <i class="fa fa-eye @if($collaborator->seen) text-black-50 @else text-danger @endif"></i>
        </a>
    @endcan

    @can('panel.collaborators.edit')
        <a data-toggle="tooltip" data-placement="bottom"
           title="ویرایش"
           href="{{ route('panel.collaborators.edit',['collaborator'=>$collaborator]) }}"
           class='btn btn-link'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan

    @can('panel.collaborators.destroy')
        <form action="{{route('panel.collaborators.destroy',['collaborator'=>$collaborator])}}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-link text-danger pt-1" onclick="return confirm('آیا مطمعن هستید')">
                <i class="fa fa-trash"></i>
            </button>
        </form>
    @endcan
</div>