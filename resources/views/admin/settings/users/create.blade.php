@extends('admin.master')
@push('css_lib')
    {{--dropzone--}}
    <link rel="stylesheet" href="{{asset('plugins/dropzone/bootstrap.min.css')}}">
@endpush
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">ایجاد کاربر</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">

                @include('admin.layouts.errors')
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                            <li class="nav-item">
                                <a class="nav-link" href="{!! route('panel.users.index') !!}"><i class="fa fa-list mr-2"></i>
                                    لیست کاربران
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link active" href="{!! route('panel.users.create') !!}"><i class="fa fa-plus mr-2"></i>
                                    ایجاد کاربر
                                </a>
                            </li>

                        </ul>
                    </div>
                    <div class="card-body">
                        <form action="{{route('panel.users.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="row">
                            @include('admin.settings.users.fields')
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
        <!-- end row -->


        <!-- parsley plugin -->
        {{--<script src="{{asset('assets/libs/parsleyjs/parsley.min.js')}}"></script>--}}

        <!-- validation init -->
        {{--<script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>--}}

        @include('admin.layouts.media_modal',['collection'=>null])
    </div>
@endsection
@push('scripts_lib')
    <script src="{{asset('plugins/dropzone/dropzone.js')}}"></script>
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        var dropzoneFields = [];
    </script>
@endpush