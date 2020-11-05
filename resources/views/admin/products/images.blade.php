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
                    <h4 class="page-title mb-0 font-size-18">تصاویر محصول</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">

                @include('admin.layouts.errors')
                <div class="card">
                    @include('admin.products.navbar')
                    <div class="card-body">

                        <div class="row">

                            <div style="padding: 0 4px;" class="col-12 pt-4">

                                <div class="form-group row ">
                                    <label class="col-4 control-label text-right">
                                        عنوان محصول:
                                    </label>
                                    <div class="col-8">
                                        {!! $product->title !!}
                                        |
                                        {!! $product->title_en !!}
                                    </div>
                                </div>
                                <div class="form-group row ">

                                    <div class="col-12">

                                        <table id="datatable" class="table table-hover mb-0">

                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>تصویر</th>
                                                <th>تصویر اصلی</th>
                                                <th>تنظیمات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($product->images as $key=>$image)
                                                <tr>
                                                    <th>{{$key+1}}</th>
                                                    <th>

                                                        <div style="height: 100px;border: 1px dashed #ccc">
                                                            <img style="height: 100%" src="{{'/storage/'.$image->url}}">
                                                        </div>

                                                    </th>

                                                    <th>
                                                        <default-image product_id="{{$product->id}}"
                                                                           image_id="{{$image->id}}"
                                                                           :is_main="{{$image->isMain}}"
                                                        ></default-image>
                                                        {{--<input  type="checkbox" @if($image->isMain==true) checked @endif>--}}
                                                    </th>
                                                    <th>
                                                        <form action="{{route('panel.products.images.destroy',['product'=>$product,'image'=>$image])}}"
                                                              method="post">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit"
                                                                    class="btn btn-link text-danger pt-1"
                                                                    onclick="return confirm('آیا مطمعن هستید')">
                                                                <i class="fa fa-trash font-size-18"></i>
                                                            </button>
                                                        </form>
                                                    </th>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                            </div>

                            <div class="col-12 mt-4 mb-3 py-3" style="border: 2px dashed #eee;
    border-radius: 15px;">

                                <form action="{{route('panel.products.images.store',['product'=>$product])}}"
                                      method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('post')
                                    <div class="form-group col-12 ">
                                        <label class="mt-2 control-label text-right">
                                            افزودن تصویر:
                                        </label>
                                        <div class="col-8" style="border:1px dashed #eee;">
                                            <input type="file" name="image">
                                        </div>
                                    </div>

                                    <!-- Submit Field -->
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>
                                            افزودن تصویر
                                        </button>
                                    </div>


                                </form>
                            </div>

                        </div>
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