@extends('store.profile.master')
@section('profile-content')
    <div class="col-xl-9 col-lg-8 col-md-8 col-sm-12">
        <div class="row">
            <div class="col-md-10 col-sm-12 mx-auto">
                <div class="px-3 px-res-0">
                    <div
                            class="section-title text-sm-title title-wide mb-1 no-after-title-wide dt-sl mb-2 px-res-1">
                        <h2>ویرایش اطلاعات شخصی</h2>
                    </div>
                    <div class="form-ui additional-info dt-sl dt-sn pt-4">
                        <form action="{{route('site.profile.update')}}" method="post" enctype="multipart/form-data">
                            @method('patch')
                            @csrf

                            <div class="form-row-title">
                                <h3>نام و نام خانوادگی</h3>
                            </div>
                            <div class="form-row">
                                <input type="text" class="input-ui pr-2"
                                       name="name"
                                       placeholder="نام خانوادگی خود را وارد نمایید" value="{{$user->name}}">
                            </div>
                            <div class="form-row-title">
                                <h3>کد ملی</h3>
                            </div>
                            <div class="form-row">
                                <input type="text" class="input-ui pl-2 text-left dir-ltr"
                                       name="code_melli"
                                       value="{{$user->code_melli}}"
                                       placeholder="-">
                            </div>
                            {{--<div class="form-row mt-2">--}}
                                {{--<div class="custom-control custom-checkbox float-right mt-2">--}}
                                    {{--<input type="checkbox" class="custom-control-input"--}}
                                           {{--id="customCheck3">--}}
                                    {{--<label class="custom-control-label text-justify" for="customCheck3">--}}
                                        {{--تبعه خارجی فاقد کد ملی هستم--}}
                                    {{--</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="form-row-title">
                                <h3>شماره موبایل</h3>
                            </div>
                            <div class="form-row">
                                <input type="text" class="input-ui pl-2 text-left dir-ltr"
                                       {{--name="mobile"--}}
                                       disabled
                                       placeholder="" value="{{$user->mobile}}">
                            </div>
                            <div class="form-row-title">
                                <h3>آدرس ایمیل</h3>
                            </div>
                            <div class="form-row">
                                <input type="email" class="input-ui pl-2 text-left dir-ltr"
                                       name="email"
                                       placeholder="آدرس ایمیل خود را وارد نمایید" value="{{$user->email}}">
                            </div>
                            {{--<div class="form-row mt-2">--}}
                                {{--<div class="custom-control custom-checkbox float-right mt-2">--}}
                                    {{--<input type="checkbox" class="custom-control-input"--}}
                                           {{--id="customCheck4">--}}
                                    {{--<label class="custom-control-label text-justify" for="customCheck4">--}}
                                        {{--اشتراک در خبرنامه دیدیکالا--}}
                                    {{--</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <div class="form-row-title">
                                <h3>عکس پروفایل</h3>
                            </div>
                            <div class="form-row mt-2">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input"
                                               id="inputGroupFile04"
                                               aria-describedby="inputGroupFileAddon04"
                                               name="avatar"
                                        >
                                        <label class="custom-file-label" for="inputGroupFile04">انتخاب
                                            عکس</label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="bg-light px-3 pt-2 pb-2 mb-3 dt-sl">
                                <div class="form-row-title">
                                    <h3>شماره کارت</h3>
                                </div>
                                <div class="form-row">
                                    <input type="text" class="input-ui pl-2 text-left dir-ltr"
                                           placeholder="-" name="bank_cart" value="{{$user->bank_cart}}">
                                </div>

                                <div class="form-row-title">
                                    <h3>شماره شبا</h3>
                                </div>
                                <div class="form-row">
                                    <input type="text" class="input-ui pl-2 text-left dir-ltr"
                                           placeholder="-" name="shaba_number" value="{{$user->shaba_number}}">


                                </div>
                                    {{--<button class="btn btn-success float-left mt-1">بررسی--}}
                                        {{--اطلاعات</button>--}}
                            </div>
                            <hr>
                            <div class="dt-sl">
                                <div class="form-row mt-3 justify-content-center">
                                    <button type="submit" class="btn-primary-cm btn-with-icon ml-2">
                                        <i class="mdi mdi-account-circle-outline"></i>
                                        ثبت اطلاعات کاربری
                                    </button>
                                    <button class="btn-primary-cm bg-secondary">انصراف</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection