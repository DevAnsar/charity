@extends('admin.master')
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">لیست ویژگی های دسته بندی
                        {{$category->title}}
                    </h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">

                <div class="card">

                    @include('admin.properties.navbar')

                    <div class="card-body">

                        <div class="">
                            <table id="datatable" class="table table-hover mb-0">

                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>عنوان </th>
                                    <th>مقادیر</th>
                                    <th>تنظیمات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($properties as $key=>$property)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <th>{{$property->title}}</th>


                                            <th>
                                                <div class="col-xl-3 col-lg-4 col-sm-6">
                                                    <a href="{{route('panel.propertyDefaults.index',['category'=>$category,'property'=>$property])}}">
                                                        <i class="bx bx-add-to-queue font-size-22"></i>
                                                    </a>
                                                </div>
                                            </th>

                                        <th>
                                            @include('admin.properties.actions',['id'=>$property->id])
                                        </th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>

        </div>
        <!-- end row -->

        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>

    </div>
@endsection