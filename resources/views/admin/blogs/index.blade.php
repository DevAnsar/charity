@extends('admin.master')
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">مدیریت وبلاگ</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">

                <div class="card">

                    @include('admin.blogs.navbar')
                    <div class="card-body">
                        <div class="">
                            <table id="datatable" class="table table-hover mb-0">

                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>عنوان مقاله</th>
                                    <th>تصویر</th>
                                    <th>دسته</th>
                                    <th>تعداد نمایش</th>
                                    <th>وضعیت</th>
                                    <th>تنظیمات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($blogs as $key=>$blog)
                                    <tr>
                                        <th>{{$key+1}}</th>

                                        <th>{{$blog->title}}</th>
                                        <th>
                                            @if($blog->image)
                                            <img style="width: 100px" src="{{env('IMG').$blog->image->url}}">
                                                @else
                                            <span class="badge badge-warning">تصویر یافت نشد</span>
                                            @endif
                                        </th>
                                        <th>{{$blog->blog_category->title}}</th>
                                        <th>{{$blog->viewCount}}</th>

                                        <th>
                                            @if($blog->status=='1')
                                                <span class="badge-info badge">منتشر شده</span>
                                            @elseif($blog->status=='0')
                                                <span class="badge-warning badge">پیشنویس</span>
                                            @endif

                                        </th>
                                        <th>
                                            @include('admin.blogs.actions',['id'=>$blog->id])
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