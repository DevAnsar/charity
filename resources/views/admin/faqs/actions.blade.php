<div class='btn-group btn-group-sm'>
    @can('panel.faqs.show')
        <a data-toggle="tooltip" data-placement="bottom"
           title="مشاهده"
           href="{{ route('panel.faqs.show',['faqCategory'=>$faqCategory,'faq'=>$id]) }}"
           class='btn btn-link'>
            <i class="fa fa-eye"></i>
        </a>
    @endcan

    @can('panel.faqs.edit')
        <a data-toggle="tooltip" data-placement="bottom"
           title="ویرایش"
           href="{{ route('panel.faqs.edit',['faqCategory'=>$faqCategory,'faq'=>$id]) }}"
           class='btn btn-link'>
            <i class="fa fa-edit"></i>
        </a>
    @endcan

    @can('panel.faqs.destroy')
        <form action="{{route('panel.faqs.destroy',['faqCategory'=>$faqCategory,'faq'=>$id])}}" method="post">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-link text-danger pt-1" onclick="return confirm('آیا مطمعن هستید')">
                <i class="fa fa-trash"></i>
            </button>
        </form>
    @endcan
</div>