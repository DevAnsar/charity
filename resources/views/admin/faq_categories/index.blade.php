@extends('admin.master')
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">دسته بندی سوالات متداول</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">

                <div class="card">

                    @include('admin.faq_categories.navbar')

                    <div class="card-body">

                        <div class="">
                            <table id="datatable" class="table table-hover mb-0">

                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>عنوان</th>
                                    <th>تصویر</th>
                                    <th>سوالات</th>
                                    <th>وضعیت</th>
                                    <th>تنظیمات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($faqCategories as $key=>$faqCategory)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <th>{{$faqCategory->title}}</th>
                                        <th>
                                            <img style="width: 100px" src="{{env('IMG').$faqCategory->image->url}}">
                                        </th>
                                        <th>
                                            <div class="col-xl-3 col-lg-4 col-sm-6">
                                                <a href="{{route('panel.faqs.index',['faqCategory'=>$faqCategory])}}">
                                                    <i class="bx bx-add-to-queue font-size-22"></i>
                                                </a>
                                            </div>
                                        </th>
                                        <th>
                                            @if($faqCategory->status)
                                                <span class="badge-info badge">در حال نمایش</span>
                                            @else
                                                <span class="badge-warning badge">غیرقابل نمایش</span>
                                            @endif

                                        </th>
                                        <th>
                                            @include('admin.faq_categories.actions',['id'=>$faqCategory->id])
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