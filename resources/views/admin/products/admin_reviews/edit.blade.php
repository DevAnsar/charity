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
                    <h4 class="page-title mb-0 font-size-18">ویرایش محصول</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">

                @include('admin.layouts.errors')
                <div class="card">
                    @include('admin.products.admin_reviews.navbar')
                    <div class="card-body">
                        <form action="{{route('panel.productAdminReviews.update',['product'=>$product,'productAdminReview'=>$productAdminReview])}}" method="post">
                            @csrf
                            @method('patch')
                            @include('admin.products.admin_reviews.fields')
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
    {{--<script src="{{asset('plugins/dropzone/dropzone.js')}}"></script>--}}
    {{--<script type="text/javascript">--}}
        {{--Dropzone.autoDiscover = false;--}}
        {{--var dropzoneFields = [];--}}
    {{--</script>--}}
@endpush