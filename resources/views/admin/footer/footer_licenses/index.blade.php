@extends('admin.master')
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">مجوزها</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">

                <div class="card">

                    @include('admin.footer.footer_licenses.navbar')

                    <div class="card-body">

                        <div class="">
                            <table id="datatable" class="table table-hover mb-0">

                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>عنوان</th>
                                    <th>تصویر</th>
                                    <th>لینک</th>
                                    <th>تنظیمات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($footer_licenses as $key=>$footer_license)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <th>{{$footer_license->title}}</th>
                                        <th>
                                            <img style="width: 100px" src="{{env('IMG').$footer_license->image->url}}">
                                        </th>
                                        <th>{{$footer_license->link}}</th>
                                        <th>
                                            @include('admin.footer.footer_licenses.actions',['id'=>$footer_license->id])
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