@extends('admin.master')
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">
                        کاربران


                    </h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">

                <div class="card">

                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                            <li class="nav-item ">
                                <a class="nav-link active" href="{!! route('panel.users.index') !!}"><i class="fa fa-list mr-2"></i>
                                    لیست کاربران
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="{!! route('panel.users.create') !!}"><i class="fa fa-plus mr-2"></i>
                                    ایجاد کاربر
                                </a>
                            </li>

                        </ul>
                    </div>

                    <div class="card-body">

                        <div class="">
                            <table id="datatable" class="table table-hover mb-0">

                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>نام</th>
                                    <th>شماره موبایل</th>
                                    <th>مقام</th>
                                    <th>آخرین ویرایش</th>
                                    <th>تاریخ عضویت</th>
                                    <th>تنظیمات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $key=>$user)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <th>{{$user->name}}</th>
                                        <th>
                                            <a class="btn btn-outline-secondary btn-sm"
                                               href="#">
                                                <i class="fa fa-mobile-alt mr-1"></i>
                                                {{$user->mobile}}
                                            </a>

                                        </th>
                                        <th>
                                            {!! $user->role !!}
                                        </th>

                                        <th>
                                            {{\Hekmatinasser\Verta\Verta::instance($user->updated_at)->formatDifference()}}
                                        </th>
                                        <th>
                                            {{\Hekmatinasser\Verta\Verta::instance($user->created_at)->format('Y/m/d')}}
                                        </th>
                                        <th>
                                            @include('admin.settings.users.actions',['id'=>$user->id])
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


    </div>
@endsection