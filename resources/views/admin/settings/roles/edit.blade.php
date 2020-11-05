@extends('admin.master')
@section('content')
    <div class="page-content">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="page-title mb-0 font-size-18">مقام ها</h4>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-12">

                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">ویرایش مقام </h4>

                        <form class="needs-validation" novalidate="" action="{{route('panel.roles.update',['role'=>$role->id])}}" method="post">
                            @csrf
                            @method('patch')
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="form-group position-relative">
                                        <label for="validationTooltip01">مقدار دسترسی</label>
                                        <input name="name" type="text"
                                               class="form-control" id="validationTooltip01"
                                               placeholder="" value="{{$role->name}}" required="">
                                        <div class="valid-tooltip">
                                            مورد تایید میباشد
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit">ویرایش کن</button>
                        </form>
                    </div>
                </div>

            </div>

        </div>
        <!-- end row -->


        <!-- parsley plugin -->
        <script src="{{asset('assets/libs/parsleyjs/parsley.min.js')}}"></script>

        <!-- validation init -->
        <script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>
    </div>
@endsection