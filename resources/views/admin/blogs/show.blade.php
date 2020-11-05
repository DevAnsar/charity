@extends('admin.master')
@push('css_lib')
    {{--dropzone--}}
    {{--<link rel="stylesheet" href="{{asset('plugins/dropzone/bootstrap.min.css')}}">--}}
@endpush
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">مشاهده ی مقاله</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">


                <div class="card">
                    @include('admin.blogs.navbar')
                    <div class="card-body">
                        <div class="invoice-title">
                            <div class="mb-4">
                                <h4 class="font-size-16">عنوان :
                                    {{$blog->title}}
                                </h4>
                            </div>
                        </div>
                        <hr>

                        <div class="invoice-title">
                            <div class="mb-4">
                                <h4 class="font-size-16">دسته ی مقاله :
                                    {{$blog->blog_category->title}}
                                </h4>
                            </div>
                        </div>
                        <div class="invoice-title">
                            <div class="mb-4">
                                <h4 class="font-size-16">تعداد نمایش :
                                    {{$blog->viewCount}}
                                </h4>
                            </div>
                        </div>
                        <div class="invoice-title">
                            <div class="mb-4">
                                <h4 class="font-size-16">تصویر شاخص :
                                    @if($blog->image)
                                        <img style="width: 100px" src="{{env('IMG').$blog->image->url}}">
                                    @else
                                        <span class="badge badge-warning">تصویر یافت نشد</span>
                                    @endif
                                </h4>
                            </div>
                        </div>
                        <div class="invoice-title">
                            <div class="mb-4">
                                <h4 class="font-size-16">وضعیت :
                                    @if($blog->status=='1')
                                        <span class="badge-info badge">منتشر شده</span>
                                    @elseif($blog->status=='0')
                                        <span class="badge-warning badge">پیشنویس</span>
                                    @endif
                                </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <address>

                                    <br>

                                    {!! $blog->content !!}
                                </address>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
        <!-- end row -->



    </div>
@endsection
