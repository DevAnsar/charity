@extends('admin.master')
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">
                        ایجاد دسته ی جدید برای وبلاگ
                        [
                        @if($parent==null)
                            دسته ی والد
                        @else
                            دسته ی والد:
                            {{$parent->title}}
                        @endif
                        ]
                    </h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">

                @include('admin.layouts.errors')
                <div class="card">
                    @include('admin.blog_categories.navbar')
                    <div class="card-body">
                        <form action="{{route('panel.blogCategories.store')}}" method="post">
                            @csrf
                            @method('post')
                            @include('admin.blog_categories.fields')
                        </form>
                    </div>
                </div>

            </div>

        </div>
        <!-- end row -->


        <!-- parsley plugin -->
        <script src="{{asset('assets/libs/parsleyjs/parsley.min.js')}}"></script>

        <!-- validation init -->
        <script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>
    </div>
@endsection