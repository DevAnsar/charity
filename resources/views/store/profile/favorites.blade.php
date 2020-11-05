@extends('store.profile.master')
@section('profile-content')

    <div class="col-xl-9 col-lg-8 col-md-8 col-sm-12">
        <div class="row">
            <div class="col-12">
                <div
                        class="section-title text-sm-title title-wide mb-1 no-after-title-wide dt-sl mb-2 px-res-1">
                    <h2>علاقمندی ها</h2>
                </div>
                <div class="dt-sl">
                    <div class="row">
                        @foreach($favorites as $favorite)
                            <div class="col-lg-6 col-md-12 ">
                                <div class="card-horizontal-product product-card">
                                    <div class="card-horizontal-product-thumb">

                                        <a href="#">
                                            <img src="{{env('IMG').$favorite->product->main_image[0]->url}}" alt="">
                                        </a>

                                    </div>
                                    <div class="card-horizontal-product-content">
                                        <div class="card-horizontal-product-title">
                                            <h5 class="product-title">
                                                <a href="#">
                                                    {{$favorite->product->title}}
                                                </a>
                                            </h5>
                                        </div>
                                        <div class="rating-stars">
                                            @for($i=1;$i<6;$i++)
                                                <i class="mdi mdi-star {{$favorite->product->rate >= $i ?'active':''}}"></i>
                                            @endfor
                                            {{--<i class="mdi mdi-star active"></i>--}}
                                            {{--<i class="mdi mdi-star active"></i>--}}
                                            {{--<i class="mdi mdi-star active"></i>--}}
                                            {{--<i class="mdi mdi-star active"></i>--}}
                                            {{--<i class="mdi mdi-star"></i>--}}
                                        </div>
                                        <div class="card-horizontal-product-price">
                                            <span>
                                                {{number_format($favorite->product->price*(1-$favorite->product->discount/100))}}
                                                تومان
                                            </span>
                                        </div>
                                        <div class="card-horizontal-product-buttons">
                                            <form action="{{route('site.profile.favorites.destroy',['favorite'=>$favorite])}}"
                                                  method="post">
                                                @csrf
                                                @method('delete')
                                                <a href="{{route('site.product',['slug'=>$favorite->product->slug])}}"
                                                   class="btn">مشاهده محصول</a>

                                                <button class="remove-btn" type="submit">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </button>
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