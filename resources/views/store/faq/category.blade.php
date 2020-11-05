@extends('store.faq.master')
@section('faq-content')

    <div class="col-12">
        <div class="page info-page-cats dt-sl dt-sn pt-3 pb-2">
            <div class="row">
                <div class="col-12 pr-4 mb-3">
                    <div class="section-title title-wide no-title-wide-before mb-1 no-after-title-wide">
                        <img src="{{asset('/store/assets/img/faq/1.png')}}" width="60" alt="">
                        <h2 class="font-weight-bold">{{$faqCategory->title}}</h2>
                    </div>
                </div>
                <div class="col-12 filter-product mb-3">
                    <div class="accordion" id="accordionExample">
                        @foreach($faqs as $key=>$faq)
                            <div class="card">
                                <div class="card-header" id="heading{{$key}}">
                                    <h2 class="mb-0">
                                        <button class="btn btn-block text-right collapsed" type="button"
                                                data-toggle="collapse" data-target="#collapse{{$key}}"
                                                aria-expanded="false" aria-controls="collapse{{$key}}">
                                            {{$faq->title}}
                                            <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapse{{$key}}" class="collapse" aria-labelledby="heading{{$key}}"
                                     data-parent="#accordionExample">
                                    <div class="card-body">
                                        {!! $faq->description !!}
                                    </div>

                                    @if($faq->body!='' || $faq->body !=null)
                                        <div class="card-body">
                                            <a href="{{route('site.faq.question',['faq'=>$faq])}}"
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

@endsection