@extends('admin.master')
@push('css_lib')
    {{--dropzone--}}
    {{--<link rel="stylesheet" href="{{asset('plugins/dropzone/bootstrap.min.css')}}">--}}
@endpush
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">مشاهده ی همیار</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">


                <div class="card">
                    @include('admin.collaborators.navbar')
                    <div class="card-body">
                        <div class="invoice-title">
                            <div class="mb-4">
                                <h4 class="font-size-16">نام و نام خانوادگی :
                                    {{$collaborator->name}}
                                    {{$collaborator->family}}
                                </h4>
                            </div>
                        </div>
                        <hr>

                        <div class="invoice-title">
                            <div class="mb-4">
                                <h4 class="font-size-16">کد ملی :
                                    {{$collaborator->code_melli}}
                                </h4>
                            </div>
                        </div>

                        <div class="invoice-title">
                            <div class="mb-4">
                                <h4 class="font-size-16">شماره موبایل :
                                    {{$collaborator->mobile}}
                                </h4>
                            </div>
                        </div>

                        <div class="invoice-title">
                            <div class="mb-4">
                                <h4 class="font-size-16">تلفن ثابت :
                                    {{$collaborator->tell}}
                                </h4>
                            </div>
                        </div>
                        <div class="invoice-title">
                            <div class="mb-4">
                                <h4 class="font-size-16">میزان تحصیلات :
                                    {{$collaborator->education_rate}}
                                </h4>
                            </div>
                        </div>

                        <div class="invoice-title">
                            <div class="mb-4">
                                <h4 class="font-size-16">رشته ی تحصیلی :
                                    {{$collaborator->field_of_Study}}
                                </h4>
                            </div>
                        </div>

                        <div class="invoice-title">
                            <div class="mb-4">
                                <h4 class="font-size-16">شغل :
                                    {{$collaborator->job}}
                                </h4>
                            </div>
                        </div>

                        <div class="invoice-title">
                            <div class="mb-4">
                                <h4 class="font-size-16">تاریخ تولد :
                                    {{$collaborator->date_of_birth}}
                                </h4>
                            </div>
                        </div>

                        <div class="invoice-title">
                            <div class="mb-4">
                                <h4 class="font-size-16">نوع همکاری :
                                    {{$collaborator->type_of_cooperation}}
                                </h4>
                            </div>
                        </div>

                        <div class="invoice-title">
                            <div class="mb-4">
                                <h4 class="font-size-16">ساعت و روزهای هفته جهت همکاری :
                                    {{$collaborator->cooperation_time}}
                                </h4>
                            </div>
                        </div>

                        <div class="invoice-title">
                            <div class="mb-4">
                                <h4 class="font-size-16">آدرس :
                                    {{$collaborator->address}}
                                </h4>
                            </div>
                        </div>



                    </div>
                </div>

            </div>

        </div>
        <!-- end row -->



    </div>
@endsection
