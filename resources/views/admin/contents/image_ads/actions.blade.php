<div class='btn-group btn-group-sm'>
    {{--@can('panel.imageAds.show')--}}
        {{--<a data-toggle="tooltip" data-placement="bottom"--}}
           {{--title="مشاهده ی جزییات"--}}
           {{--href="{{ route('panel.imageAds.show', $id) }}"--}}
           {{--class='btn btn-link'>--}}
            {{--<i class="fa fa-eye"></i>--}}
        {{--</a>--}}
    {{--@endcan--}}

    @can('panel.imageAds.edit')
        <a data-toggle="tooltip" data-placement="bottom"
           title="ویرایش"
           href="{{ route('panel.imageAds.edit', $id) }}"
           class='btn btn-link'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan

    @can('panel.imageAds.destroy')
        <form action="{{route('panel.imageAds.destroy',['imageAd'=>$id])}}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-link text-danger pt-1" onclick="return confirm('آیا مطمعن هستید')">
                <i class="fa fa-trash"></i>
            </button>
        </form>
    @endcan
</div>