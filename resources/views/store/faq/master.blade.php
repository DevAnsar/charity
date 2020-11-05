@extends('store.master')
@section('content')
    <main class="main-content dt-sl mt-4 mb-3">
        <div class="page-cover mb-2">
            <div class="page-cover-title">
                <h1>پاسخ پرسش‌های پرتکرار</h1>
                <div class="form-ui">
                    <form action="{{route('site.faq.index')}}" method="get">
                        <div class="form-row">
                            <input type="text" name="q"
                                   value="{{isset($q)?$q:''}}"
                                   class="input-ui pr-2"
                                   placeholder="پرسش خود را جستجو کنید">
                            <button class="btn btn-info" type="submit">جستجو</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container main-container">
            <div class="row">


                @yield('faq-content')


                @include('store.faq.repetitive',['repetitives'=>$repetitives])

                <div class="col-12">
                    <div class="page-question-not-found">
                        <div class="row">
                            <div class="col-12">
                                <div class="page-question-not-found-text">
                                    جواب یا پرسش خود را پیدا نکردید؟
                                    <br>
                                    روش‌های ارتباط با ما
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 text-center">
                                <img src="./assets/img/faq/phone.svg" alt="">
                                <div class="page-contact-option-text">تماس تلفنی</div>
                                <div class="page-contact-option-text mr-3">۰۲۱-۶۱۹۳۰۰۰۰</div>
                            </div>
                            <div class="col-md-6 col-sm-12 text-center">
                                <img src="./assets/img/faq/email.svg" class="mb-5" alt="">
                                <a href="#" class="btn btn-info pr-4 pl-4">ارسال پیام</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection