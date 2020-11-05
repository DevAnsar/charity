{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
{{--<div class="row justify-content-center">--}}
{{--<div class="col-md-8">--}}
{{--<div class="card">--}}
{{--<div class="card-header">{{ __('Register') }}</div>--}}

{{--<div class="card-body">--}}
{{--<form method="POST" action="{{ route('register') }}">--}}
{{--@csrf--}}

{{--<div class="form-group row">--}}
{{--<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>--}}

{{--<div class="col-md-6">--}}
{{--<input id="name" type="text"--}}
{{--class="form-control @error('name') is-invalid @enderror" name="name"--}}
{{--value="{{ old('name') }}" required autocomplete="name" autofocus>--}}

{{--@error('name')--}}
{{--<span class="invalid-feedback" role="alert">--}}
{{--<strong>{{ $message }}</strong>--}}
{{--</span>--}}
{{--@enderror--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="form-group row">--}}
{{--<label for="email"--}}
{{--class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--<div class="col-md-6">--}}
{{--<input id="email" type="email"--}}
{{--class="form-control @error('email') is-invalid @enderror" name="email"--}}
{{--value="{{ old('email') }}" required autocomplete="email">--}}

{{--@error('email')--}}
{{--<span class="invalid-feedback" role="alert">--}}
{{--<strong>{{ $message }}</strong>--}}
{{--</span>--}}
{{--@enderror--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="form-group row">--}}
{{--<label for="password"--}}
{{--class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--<div class="col-md-6">--}}
{{--<input id="password" type="password"--}}
{{--class="form-control @error('password') is-invalid @enderror" name="password"--}}
{{--required autocomplete="new-password">--}}

{{--@error('password')--}}
{{--<span class="invalid-feedback" role="alert">--}}
{{--<strong>{{ $message }}</strong>--}}
{{--</span>--}}
{{--@enderror--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="form-group row">--}}
{{--<label for="password-confirm"--}}
{{--class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

{{--<div class="col-md-6">--}}
{{--<input id="password-confirm" type="password" class="form-control"--}}
{{--name="password_confirmation" required autocomplete="new-password">--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="form-group row mb-0">--}}
{{--<div class="col-md-6 offset-md-4">--}}
{{--<button type="submit" class="btn btn-primary">--}}
{{--{{ __('Register') }}--}}
{{--</button>--}}
{{--</div>--}}
{{--</div>--}}
{{--</form>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--@endsection--}}

@extends('store.master',['mini'=>true])

@section('content')
    <main class="main-content dt-sl mt-4 mb-3">
        <div class="container main-container">

            <div class="row">
                <div class="col-xl-4 col-lg-5 col-md-7 col-12 mx-auto">
                    <div class="form-ui dt-sl dt-sn pt-4">
                        <div class="section-title title-wide mb-1 no-after-title-wide">
                            <h2 class="font-weight-bold">ثبت نام در فروشگاه خیریه</h2>
                        </div>
                        {{--<div class="message-light">--}}
                            {{--اگر قبلا با ایمیل ثبت‌نام کرده‌اید، نیاز به ثبت‌نام مجدد با شماره همراه ندارید--}}
                        {{--</div>--}}
                        @include('store.layouts.errors')
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf


                            <div class="form-row-title">
                                <h3>نام و نام خانوادگی</h3>
                            </div>
                            <div class="form-row with-icon">
                                <input type="text" class="input-ui pr-2 @error('name') is-invalid @enderror"
                                       placeholder="نام  خود را وارد نمایید" id="name" name="name"
                                       value="{{ old('name') }}" required autocomplete="name" autofocus>
                                <i class="mdi mdi-account-circle-outline"></i>
                            </div>


                            <div class="form-row-title">
                                <h3>ایمیل</h3>
                            </div>
                            <div class="form-row with-icon">
                                <input class="input-ui pr-2 @error('email') is-invalid @enderror "
                                       placeholder="ایمیل  خود را وارد نمایید" id="email" type="email"
                                       name="email"
                                       value="{{ old('email') }}" required autocomplete="email">
                                <i class="mdi mdi-account-circle-outline"></i>
                            </div>


                            <div class="form-row-title">
                                <h3>رمز عبور</h3>
                            </div>
                            <div class="form-row with-icon">
                                <input type="password" class="input-ui pr-2 @error('password') is-invalid @enderror"
                                       placeholder="رمز عبور خود را وارد نمایید" id="password"
                                       name="password"
                                       required autocomplete="new-password">
                                <i class="mdi mdi-lock-open-variant-outline"></i>
                            </div>


                            <div class="form-row-title">
                                <h3>تکرار رمز عبور</h3>
                            </div>
                            <div class="form-row with-icon">
                                <input type="password" class="input-ui pr-2"
                                       placeholder="رمز عبور خود را دوباره وارد نمایید"
                                       id="password-confirm"
                                       name="password_confirmation" required autocomplete="new-password">
                                <i class="mdi mdi-lock-open-variant-outline"></i>
                            </div>

                            <im-neddy needy="{{old('needy')?true:false}}"></im-neddy>

                            <div class="form-row mt-2">
                                <div class="custom-control custom-checkbox float-right mt-2">
                                    <input type="checkbox" class="custom-control-input" id="customCheck3" name="roles">
                                    <label class="custom-control-label text-justify" for="customCheck3">
                                        <a href="#">حریم خصوصی</a> و <a href="#">شرایط و قوانین</a> استفاده از سرویس های
                                        فروشگاه خیریه را مطالعه نموده و با کلیه موارد آن موافقم.
                                    </label>
                                </div>
                            </div>
                            <div class="form-row mt-3">
                                <button class="btn-primary-cm btn-with-icon mx-auto w-100">
                                    <i class="mdi mdi-account-circle-outline"></i>
                                    ثبت نام در فروشگاه خیریه
                                </button>
                            </div>
                            <div class="form-footer text-right mt-3">
                                <span class="d-block font-weight-bold">قبلا ثبت نام کرده اید؟</span>
                                <a href="{{route('login')}}" class="d-inline-block mr-3 mt-2">وارد شوید</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
