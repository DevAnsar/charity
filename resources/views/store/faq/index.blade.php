@extends('store.faq.master')
@section('faq-content')
    @include('store.faq.search_results',['q'=>$q,'search'=>$search])
    <div class="col-12">
        <div class="page info-page-cats dt-sl dt-sn pt-3 pb-2">
            <div class="row">
                <div class="col-12 pr-4 mb-3">
                    <div class="section-title title-wide mb-1 no-after-title-wide">
                        <h2 class="font-weight-bold px-res-2">دسته‌بندی پرسش‌ها</h2>
                    </div>
                </div>
                @foreach($faqCategories as $faqCategory)
                    <div class="col-sm-4 col-6">
                        <div class="info-page-cat">
                            <a href="{{route('site.faq.category',['faqCategory'=>$faqCategory])}}">
                                <div class="info-page-cat-icon">
                                    <img src="{{env('IMG').$faqCategory->image->url}}" alt="">
                                </div>
                                <span class="info-page-cat-title">
                                                {{$faqCategory->title}}
                                            </span>
                            </a>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection