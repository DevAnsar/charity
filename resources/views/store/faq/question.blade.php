@extends('store.faq.master')
@section('faq-content')
    <div class="col-12">
        <div class="page info-page-cats dt-sl dt-sn pt-3 pb-2">
            <div class="row">
                <div class="col-12 pr-4 mb-3">
                    <div class="section-title title-wide no-title-wide-before mb-1 no-after-title-wide">
                        <img src="{{asset('store/assets/img/faq/question.svg')}}" width="30" alt="">
                        <h2 class="font-weight-bold">
                            {{$faq->title}}
                        </h2>
                    </div>
                </div>
                <div class="col-12">
                    <div class="content-faq-question px-4 pb-2">
                        {!! $faq->body !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection