@extends('admin.master')
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">شبکه های اجتماعی</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">

                <div class="card">

                    @include('admin.footer.footer_socials.navbar')

                    <div class="card-body">

                        <div class="">
                            <table id="datatable" class="table table-hover mb-0">

                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>عنوان</th>
                                    <th>آیکن</th>
                                    <th>لینک</th>
                                    <th>تنظیمات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($footer_socials as $key=>$footer_social)
                                    <tr>
                                        <th>{{$key+1}}</th>
                                        <th>{{$footer_social->title}}</th>
                                        <th>
                                            <a href="{{$footer_social->link}}"><i class="mdi mdi-{{$footer_social->icon}}"></i></a>
                                        </th>
                                        <th>{{$footer_social->link}}</th>
                                        <th>
                                            @include('admin.footer.footer_socials.actions',['id'=>$footer_social->id])
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