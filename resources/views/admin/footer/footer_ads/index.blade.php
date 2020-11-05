@extends('admin.master')
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">تبلیغات فوتر</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">

                <div class="card">

                    @include('admin.footer.footer_ads.navbar')

                    <div class="card-body">

                        <div class="">
                            <table id="datatable" class="table table-hover mb-0">

                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>عنوان</th>
                                    <th>تصویر</th>
                                    <th>تنظیمات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($footer_ads as $key=>$footer_ad)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <th>{{$footer_ad->title}}</th>
                                        <th>
                                            <img style="width: 300px" src="{{env('IMG').$footer_ad->image->url}}">
                                        </th>
                                        <th>
                                            @include('admin.footer.footer_ads.actions',['id'=>$footer_ad->id])
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