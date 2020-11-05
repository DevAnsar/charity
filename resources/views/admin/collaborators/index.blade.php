@extends('admin.master')
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">لیست همیاران</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">

                <div class="card">

                    @include('admin.collaborators.navbar')

                    <div class="card-body">

                        <div class="">
                            <table id="datatable" class="table table-hover mb-0">

                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>نام و نام خانوادگی</th>
                                    <th>کد ملی</th>
                                    <th>شماره موبایل</th>
                                    <th>شماره تلفن</th>
                                    <th>زمینه ی همکاری</th>
                                    <th>تنظیمات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($collaborators as $key=>$collaborator)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <th>{{$collaborator->name}}{{$collaborator->family}}</th>

                                        <th>
                                            {{$collaborator->code_melli}}
                                        </th>
                                        <th>
                                            {{$collaborator->mobile}}
                                        </th>
                                        <th>
                                            {{$collaborator->tell}}
                                        </th>
                                        <th>
                                            {{$collaborator->type_of_cooperation}}
                                        </th>
                                        <th>
                                            @include('admin.collaborators.actions',compact('collaborator'))
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