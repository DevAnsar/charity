<div class='btn-group btn-group-sm'>
    {{--@can('panel.cities.show')--}}
        {{--<a data-toggle="tooltip" data-placement="bottom"--}}
           {{--title="مشاهده ی جزییات"--}}
           {{--href="{{ route('panel.cities.show',['city'=>$id,'parent'=>$parent]) }}"--}}
           {{--class='btn btn-link'>--}}
            {{--<i class="fa fa-eye"></i>--}}
        {{--</a>--}}
    {{--@endcan--}}

    @can('panel.productReviews.edit')
        <a class="btn btn-link"
                data-toggle="modal"
                data-target="#reviewShow"
                data-review="{{$productReview}}"
                data-action="{{route('panel.productReviews.update',['productReview'=>$productReview,'list'=>$list])}}"
        >
            <i class="fa fa-edit"></i>
        </a>
    @endcan

    @can('panel.productReviews.destroy')
        <form action="{{route('panel.productReviews.destroy',['productReview'=>$productReview->id])}}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-link text-danger pt-1" onclick="return confirm('آیا مطمعن هستید')">
                <i class="fa fa-trash"></i>
            </button>
        </form>
    @endcan
</div>
