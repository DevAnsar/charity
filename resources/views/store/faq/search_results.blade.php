@if(isset($q) && ($q!='' || $q!=null))
    <div class="col-12">
        <div class="page info-page-cats dt-sl dt-sn pt-3 pb-2 mb-4">
            <div class="row">
                <div class="col-12 pr-4 mb-3">
                    <div class="section-title title-wide mb-1 no-after-title-wide">
                        <h2 class="font-weight-bold">جستجوی
                            "
                            {{$q}}
                            "
                        </h2>
                    </div>
                </div>
                <div class="col-12 filter-product mb-3">
                    <div class="accordion" id="accordionExample">

                        @foreach($search as $key=>$item)
                            <?php
                            $time = \Carbon\Carbon::now()->timestamp;
                            ?>
                            <div class="card">
                                <div class="card-header" id="heading{{$key.$time}}">
                                    <h2 class="mb-0">
                                        <button class="btn btn-block text-right collapsed" type="button"
                                                data-toggle="collapse" data-target="#collapse{{$key.$time}}"
                                                aria-expanded="false" aria-controls="collapse{{$key.$time}}">
                                            {{$item->title}}
                                            <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapse{{$key.$time}}" class="collapse"
                                     aria-labelledby="heading{{$key.$time}}"
                                     data-parent="#accordionExample">
                                    <div class="card-body">
                                        {!! $item->description !!}
                                    </div>


                                    @if($item->body!='' || $item->body !=null)
                                        <div class="card-body">
                                            <a href="{{route('site.faq.question',['faq'=>$item])}}"
                                               class="btn btn-link-border text-primary float-left ">مشاهده ی توضیحات
                                                کامل</a>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif