@extends('admin.master')
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">لیست دسته بندی ها</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">

                <div class="card">

                    @include('admin.categories.navbar')

                    <div class="card-body">

                        <div class="">
                            <table id="datatable" class="table table-hover mb-0">

                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>عنوان دسته</th>
                                    <th>اسلاگ</th>
                                    {{--@if($level==1)--}}
                                        <td>آیکون</td>
                                    {{--@endif--}}
                                    @if($level<3)
                                        <th>زیر دسته ها</th>
                                    @endif
                                    @if($level==2)
                                        <th>ویژگی ها</th>
                                    @endif
                                    <th>تنظیمات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $key=>$category)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <th>{{$category->title}}</th>
                                        <th>{{$category->slug}}</th>
                                        {{--@if($level==1)--}}
                                            <td>
                                                @if($category->image)
                                                    {{--<div style='width: 56px;height: 56px;display: block;background: url("{{'/storage/'.$category->image->url}}")no-repeat;' ></div>--}}
                                                    <img style="width: 60px"
                                                         src="{{'/storage/'.$category->image->url}}">
                                                @endif
                                            </td>
                                        {{--@endif--}}
                                        @if($level<3)
                                            <th>
                                                <div class="col-xl-3 col-lg-4 col-sm-6">
                                                    <a href="{{route('panel.categories.index',['parent'=>$category->id])}}">
                                                        <i class="bx bx-add-to-queue font-size-22"></i>
                                                    </a>
                                                </div>
                                            </th>
                                        @endif
                                        @if($level==2)
                                            <th>
                                                <div class="col-xl-3 col-lg-4 col-sm-6">
                                                    <a href="{{route('panel.properties.index',['category'=>$category->id])}}">
                                                        <i class="bx bx-extension font-size-22"></i>
                                                    </a>
                                                </div>
                                            </th>
                                        @endif

                                        <th>
                                            @include('admin.categories.actions',['id'=>$category->id])
                                        </th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>

                        {{--<d-table :table_columns="[--}}
                        {{--{label: '#', field: 'id'},--}}
                        {{--{label: 'عنوان دسته', field: 'user.username', headerClass: 'class-in-header second-class'},--}}
                        {{--{label: 'First Name', field: 'user.firstName'},--}}
                        {{--{label: 'Last Name', field: 'user.lastName'},--}}
                        {{--{label: 'Email', field: 'user.email'},--}}
                        {{--{--}}
                        {{--label: 'Address',--}}
                        {{--representedAs: ({address, city, state}) => `${address}<br />${city}, ${state}`,--}}
                        {{--interpolate: true--}}
                        {{--}--}}
                        {{--]"></d-table>--}}
                    </div>
                </div>

            </div>

        </div>
        <!-- end row -->

        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>

    </div>
@endsection