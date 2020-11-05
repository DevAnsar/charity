@extends('store.master')
@section('content')
    <main class="main-content dt-sl mt-4 mb-3">
        <div class="container main-container">

            @yield('blog-content-header')

            <div class="dt-sl">
                <div class="row">

                    @yield('blog-content')


                    <div class="col-lg-3 col-md-4 col-sm-12 col-12 mb-3 sidebar sticky-sidebar">
                        <div class="widget-posts dt-sn dt-sl mb-3">
                            <div class="title-sidebar dt-sl mb-3">
                                <h3>جدیدترین نوشته ها</h3>
                            </div>
                            <div class="content-sidebar dt-sl">
                                @foreach($new_blogs as $new_blog)
                                    <div class="item">
                                        <div class="item-inner">
                                            <div class="item-thumb">
                                                <a href="{{route('site.blog.show',['slug'=>$new_blog->slug])}}"
                                                   class="img-holder"
                                                   style="background-image: url('{{env('IMG').$new_blog->image->url}}')"></a>
                                            </div>
                                            <p class="title">
                                                <a href="{{route('site.blog.show',['slug'=>$new_blog->slug])}}">{{$new_blog->title}}</a>
                                            </p>
                                            <div class="item-meta">
                                                <span class="time">
                                                          {{\Hekmatinasser\Verta\Verta::instance($new_blog->created_at)
                                                                ->format('d  M  Y')}}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="dt-sn dt-sl mb-3">
                            <div class="section-title text-sm-title title-wide no-after-title-wide mb-1">
                                <h2>دسته ها</h2>
                            </div>
                            <ul class="category-list">
                                @foreach($blogCategories as $blogCategory)
                                    <li>
                                        <a href="{{route('site.blog.index',['category'=>$blogCategory->slug])}}">{{$blogCategory->title}}</a>
                                        <ul>
                                            @foreach($blogCategory->real_children as $real_child)
                                                <li><a href="{{route('site.blog.index',['category'=>$real_child->slug])}}">{{$real_child->title}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach

                            </ul>
                        </div>

                        {{--<div class="dt-sn dt-sl">--}}
                        {{--<div class="section-title text-sm-title title-wide no-after-title-wide mb-1">--}}
                        {{--<h2>برچسبها</h2>--}}
                        {{--</div>--}}
                        {{--<ul class="tag-list">--}}
                        {{--<li><a href="#">بهینه سازی</a></li>--}}
                        {{--<li><a href="#">برنامه نویسی</a></li>--}}
                        {{--<li><a href="#">طراحی سایت</a></li>--}}
                        {{--<li><a href="#">وردپرس</a></li>--}}
                        {{--<li><a href="#">پلاگین نویسی</a></li>--}}
                        {{--<li><a href="#">گرافیک</a></li>--}}
                        {{--</ul>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection