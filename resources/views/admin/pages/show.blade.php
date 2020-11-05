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
                    <h4 class="page-title mb-0 font-size-18">مشاهده ی محتوای صفحه</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">


                <div class="card">
                    @include('admin.pages.navbar')
                    <div class="card-body">
                        <div class="invoice-title">

                            <div class="mb-4">
                                <h4 class="font-size-16">عنوان :
                                    {{$page->title}}
                                </h4>
                                {{--<img src="assets/images/logo-dark.png" alt="logo" height="20" />--}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <address>

                                    <br>

                                    {!! $page->content !!}
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
