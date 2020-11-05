@extends('admin.master')
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">تبلیغات تصویری</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">

                <div class="card">

                    @include('admin.contents.image_ads.navbar')

                    <div class="card-body">

                        <div class="">
                            <table id="datatable" class="table table-hover mb-0">

                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>تصویر</th>
                                    <th>بخش</th>
                                    <th>تعداد ستون</th>
                                    <th>لینک</th>
                                    <th>نمایش در اپلیکیشن</th>
                                    <th>وضعیت</th>
                                    <th>تنظیمات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($imageAds as $key=>$imageAd)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <th>
                                            <img style="width: 300px" src="{{env('IMG').$imageAd->image->url}}">
                                        </th>
                                        <th>{{$imageAd->section}}</th>
                                        <th>{{$imageAd->col}}</th>
                                        <th style="width: 150px;display: block">{{$imageAd->link}}</th>

                                        <th>
                                            @if($imageAd->showInApp)
                                                <span class="badge-info badge">بله</span>
                                            @else
                                                <span class="badge-danger badge">خیر</span>
                                            @endif

                                        </th>
                                        <th>
                                            @if($imageAd->status)
                                                <span class="badge-info badge">در حال نمایش</span>
                                            @else
                                                <span class="badge-warning badge">غیرقابل نمایش</span>
                                            @endif

                                        </th>
                                        <th>
                                            @include('admin.contents.image_ads.actions',['id'=>$imageAd->id])
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