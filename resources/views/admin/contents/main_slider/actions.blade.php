<div class='btn-group btn-group-sm'>
    {{--@can('panel.mainSliders.show')--}}
        {{--<a data-toggle="tooltip" data-placement="bottom"--}}
           {{--title="مشاهده ی جزییات"--}}
           {{--href="{{ route('panel.mainSliders.show', $id) }}"--}}
           {{--class='btn btn-link'>--}}
            {{--<i class="fa fa-eye"></i>--}}
        {{--</a>--}}
    {{--@endcan--}}

    @can('panel.mainSliders.edit')
        <a data-toggle="tooltip" data-placement="bottom"
           title="ویرایش"
           href="{{ route('panel.mainSliders.edit', $id) }}"
           class='btn btn-link'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan

    @can('panel.mainSliders.destroy')
        <form action="{{route('panel.mainSliders.destroy',['mainSlider'=>$id])}}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-link text-danger pt-1" onclick="return confirm('آیا مطمعن هستید')">
                <i class="fa fa-trash"></i>
            </button>
        </form>
    @endcan
</div>