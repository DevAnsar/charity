@extends('admin.master')
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">محصولات</h4>

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
                                <a class="nav-link active" href="{!! route('panel.products.index') !!}"><i
                                            class="fa fa-list mr-2"></i>
                                    لیست محصولات
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="{!! route('panel.products.create') !!}"><i
                                            class="fa fa-plus mr-2"></i>
                                    ایجاد محصول جدید
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
                                    <th>عنوان محصول</th>
                                    @if(auth()->user()->hasRole('admin'))
                                        <th>کاربر</th>
                                    @endif
                                    <th>آخرین ویرایش</th>
                                    <th>تنظیمات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $key=>$product)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <th>{{$product->title}}</th>
                                        @if(auth()->user()->hasRole('admin'))
                                            <th>
                                                <a href="{{route('panel.users.edit',['user'=>$product->user])}}">
                                                    {{$product->user->name}}
                                                </a>
                                            </th>
                                        @endif

                                        <th>
                                            {{\Hekmatinasser\Verta\Verta::instance($product->updated_at)->formatDifference()}}
                                        </th>
                                        <th>
                                            @include('admin.products.actions',['id'=>$product->id])
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