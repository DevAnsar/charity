@extends('admin.master')
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">سوالات متداول
                        برای دسته ی [
                        {{$faqCategory->title}}
                        ]
                    </h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">

                <div class="card">

                    @include('admin.faqs.navbar')

                    <div class="card-body">

                        <div class="">
                            <table id="datatable" class="table table-hover mb-0">

                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>متن سوال</th>
                                    <th>پرتکرار</th>
                                    <th>وضعیت</th>
                                    <th>تنظیمات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($faqs as $key=>$faq)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <th>{{$faq->title}}</th>

                                        <th>
                                            @if($faq->repetitive)
                                                <span class="badge-info badge">بله</span>
                                            @else
                                                <span class="badge-warning badge">خیر</span>
                                            @endif

                                        </th>
                                        <th>
                                            @if($faq->status)
                                                <span class="badge-info badge">در حال نمایش</span>
                                            @else
                                                <span class="badge-warning badge">غیرقابل نمایش</span>
                                            @endif

                                        </th>
                                        <th>
                                            @include('admin.faqs.actions',['id'=>$faq->id])
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