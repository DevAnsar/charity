@extends('admin.master')
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">نقد و بررسی محصول</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">

                <div class="card">

                    @include('admin.products.admin_reviews.navbar')

                    <div class="card-body">

                        <div class="">
                            <table id="datatable" class="table table-hover mb-0">

                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>عنوان</th>
                                    <th>متن</th>
                                    <th>تنظیمات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($product->productAdminReviews as $key=>$adminReview)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <th>{{$adminReview->title}}</th>

                                        <th>
                                            {!! $adminReview->body !!}
                                        </th>
                                        <th>
                                            @include('admin.products.admin_reviews.actions',['id'=>$adminReview->id])
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