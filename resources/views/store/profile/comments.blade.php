@extends('store.profile.master')
@section('profile-content')
    <div class="col-xl-9 col-lg-8 col-md-8 col-sm-12">
        <div class="row">
            <div class="col-12">
                <div
                        class="section-title text-sm-title title-wide mb-1 no-after-title-wide dt-sl mb-2 px-res-1">
                    <h2>نقد و نظرات</h2>
                </div>
                <div class="dt-sl">
                    <div class="row">
                        @foreach($comments as $comment)
                        <div class="col-lg-6 col-md-12">
                            <div class="card-horizontal-product">
                                <div class="card-horizontal-product-thumb">
                                    <a href="{{route('site.product',['slug'=>$comment->product->slug])}}">
                                        <img src="{{env('IMG').$comment->product->main_image[0]->url}}" alt="">
                                    </a>
                                    <small class="font-weight-bold">امتیاز من به محصول</small>
                                    <div class="rating-stars">
                                        @for($i=1;$i<6;$i++)
                                            <i class="mdi mdi-star {{$comment->rate >= $i ?'active':''}}"></i>
                                        @endfor
                                    </div>
                                </div>
                                <div class="card-horizontal-product-content">
                                    <div class="label-status-comment">
                                        @if($comment->status=='-1')
                                            رد شده
                                            @elseif($comment->status=='0')
                                        در انتظار تایید
                                        @elseif($comment->status=='1')
                                        تایید شده
                                        @endif
                                    </div>
                                    <div class="card-horizontal-comment-title">
                                        <a href="#">
                                            <h3></h3>
                                        </a>
                                    </div>
                                    <div class="card-horizontal-comment">
                                        <p>
                                           {{$comment->review}}
                                        </p>
                                    </div>

                                    <div class="card-horizontal-product-buttons">
                                        <div class="float-right">
                                                            {{--<span class="count-like">--}}
                                                                {{--<i class="mdi mdi-thumb-up-outline"></i>11--}}
                                                            {{--</span>--}}
                                            {{--<span class="count-like">--}}
                                                                {{--<i class="mdi mdi-thumb-down-outline"></i>2--}}
                                                            {{--</span>--}}
                                        </div>
                                        <form action="{{route('site.profile.comments.destroy',['productReview'=>$comment])}}" method="post">
                                            @csrf
                                            @method('delete')


                                        <button class="btn btn-light" type="submit">حذف</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection