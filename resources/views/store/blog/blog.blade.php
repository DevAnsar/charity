@extends('store.blog.master')
@section('blog-content')
    <div class="col-lg-9 col-md-8 col-sm-12 col-12 mb-3">
        <div class="row mt-5">
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                {{--{{$selected_category}}--}}
            </div>
        </div>
        <div class="row mt-5">

            @foreach($blogs as $blog)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">

                    <div class="post-card">
                        <div class="post-thumbnail">
                            <a href="{{route('site.blog.show',['slug'=>$blog->slug])}}">
                                <img src="{{env('IMG').$blog->image->url}}" alt="">
                            </a>
                            <span class="post-tag">مقاله</span>

                        </div>
                        <div class="post-title">
                            <a href="{{route('site.blog.show',['slug'=>$blog->slug])}}">
                                {{$blog->title}}
                            </a>
                            <span class="post-date">
                                            {{\Hekmatinasser\Verta\Verta::instance($blog->created_at)
                                                                ->format('d  M  Y')}}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        {{--<div class="row">--}}
            {{--<div class="col-12">--}}
                {{--<div class="pagination">--}}
                    {{--<a href="#" class="prev"><i class="mdi mdi-chevron-double-right"></i></a>--}}
                    {{--<a href="#">1</a>--}}
                    {{--<a href="#" class="active-page">2</a>--}}
                    {{--<a href="#">3</a>--}}
                    {{--<a href="#">4</a>--}}
                    {{--<a href="#">...</a>--}}
                    {{--<a href="#">7</a>--}}
                    {{--<a href="#" class="next"><i class="mdi mdi-chevron-double-left"></i></a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
@endsection