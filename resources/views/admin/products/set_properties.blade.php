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
                    <h4 class="page-title mb-0 font-size-18">تعیین ویژگی های محصول</h4>

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
                        <form action="{{route('panel.products.properties.store',['product'=>$product])}}" method="post">
                            @csrf
                            @method('post')
                            <div class="row">
                                <div style="padding: 0 4px;" class="col-6 pt-4">
                                    <!-- Name Field -->
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

                                    @foreach($properties as $property)


                                        <?php
                                        $product_property_value=$product->property_values()->where('property_id','=',$property->id)->first()
                                        ?>

                                        <div class="form-group row ">
                                            <label for="{{$property->id}}" class="col-4 control-label text-right">
                                                {{$property->title}} :
                                            </label>
                                            <div class="col-8">
                                                <select class="form-control" id="{{$property->id}}" name="{{$property->id}}">
                                                    <option value="0" selected>انتخاب کنید</option>
                                                    @foreach($property->defaults as $default)
                                                        <option
                                                                {{ $product_property_value? ($product_property_value->property_default_id == $default->id? 'selected' :'' ):''  }}
                                                                value="{{$default->id}}">
                                                            {{$default->value}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                            <!-- Submit Field -->
                            <div class="form-group col-12 text-right">
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>
                                    ذخیره ویژگی ها
                                </button>
                                <a href="{!! route('panel.products.index') !!}" class="btn btn-light"><i
                                            class="fa fa-undo"></i>
                                    کنسل
                                </a>
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