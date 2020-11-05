@extends('store.master',['mini'=>false])

@section('content')
    <main class="main-content dt-sl mt-4 mb-3">
        <div class="container main-container">

            <div class="row">
                <div class="col-xl-7 col-lg-7 col-md-10 col-12 mx-auto">
                    <div class="form-ui dt-sl dt-sn pt-4">
                        <div class="section-title title-wide mb-1 no-after-title-wide">
                            <h2 class="font-weight-bold">ثبت اطلاعات برای همکاری با ما</h2>
                        </div>
                        <div class="card-body">

                            <form action="{{route('site.collaborator.create')}}" method="post" style="max-width: inherit">
                                @csrf
                                @method('POST')

                                <div class="form-row row ">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mt-3">
                                        <span>
                                        نام
                                        <span class="text-danger">*</span>
                                        </span>
                                        <input type="text"
                                               name="name"
                                               class="input-ui pr-2 "
                                               placeholder=""
                                               required>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mt-3">
                                        <span>
                                        نام خانوادگی
                                        <span class="text-danger">*</span>
                                        </span>
                                        <input type="text"
                                               name="family"
                                               class="input-ui pr-2 "
                                               placeholder=""
                                               required>
                                    </div>

                                </div>

                                <div class="form-row row ">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mt-3">
                                       <span>کد ملی
                                          <span class="text-danger">*</span>
                                       </span>
                                       <input type="number"
                                           name="code_melli"
                                           class="input-ui pr-2 "
                                           placeholder=""
                                           required>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mt-3">
                                        <span>تاریخ تولد
                                            <span class="text-danger">*</span>
                                         </span>
                                        <date></date>

                                    </div>
                                </div>

                                <div class="form-row row ">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mt-3">
                                       <span>
                                           شماره موبایل
                                          <span class="text-danger">*</span>
                                       </span>
                                       <input type="number"
                                           name="mobile"
                                           class="input-ui pr-2 "
                                           placeholder=""
                                           required>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mt-3">

                                            <span>تلفن منزل
                                                <span class="text-danger">*</span>
                                            </span>
                                            <input type="number"
                                                   name="tell"
                                                   class="input-ui pr-2 "
                                                   placeholder=""
                                                   required>

                                    </div>
                                </div>


                                <div class="form-row row ">
                                    <div class="col-xl-4 col-lg-4 col-md-4 col-12 mt-3">
                                       <span>
                                           میزان تحصیلات
                                          {{--<span class="text-danger">*</span>--}}
                                       </span>
                                       <input type="text"
                                           name="education_rate"
                                           class="input-ui pr-2 "
                                           placeholder=""
                                           >
                                    </div>

                                    <div class="col-xl-4 col-lg-4 col-md-4 col-12 mt-3">
                                            <span>
                                                رشته ی تحصیلی
                                                {{--<span class="text-danger">*</span>--}}
                                            </span>
                                            <input type="text"
                                                   name="field_of_Study"
                                                   class="input-ui pr-2 "
                                                   placeholder=""
                                                   >
                                    </div>

                                    <div class="col-xl-4 col-lg-4 col-md-4 col-12 mt-3">
                                            <span>
                                                شغل
                                                {{--<span class="text-danger">*</span>--}}
                                            </span>
                                            <input type="text"
                                                   name="job"
                                                   class="input-ui pr-2 "
                                                   placeholder=""
                                                   >

                                    </div>
                                </div>

                                <div class="row form-row ">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-12 mt-3">
                                        <span>آدرس محل سکونت
                                            <span class="text-danger">*</span>
                                        </span>
                                        <input type="text"
                                               class="input-ui pr-2 "
                                               placeholder=""
                                               name="address" required>
                                    </div>
                                </div>


                                <div class="form-row row ">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mt-3">
                                       <span>
                                           نوع همکاری
                                           <span class="text-danger">*</span>
                                       </span>
                                        <select name="type_of_cooperation" class="input-ui pr-2 selectpicker" required>
                                            <option value="" selected>انتخاب کنید...</option>
                                            <option value="مالی">مالی</option>
                                            <option value="مشاوره ی پزشکی">مشاوره ی پزشکی</option>
                                            <option value="آموزشی">آموزشی</option>
                                            <option value="اداری">اداری</option>
                                            <option value="مشاوره ی حقوقی">مشاوره ی حقوقی</option>
                                            <option value="تبلیغات و روابط عمومی">تبلیغات و روابط عمومی</option>
                                            <option value="پشتیبانی و حمل و نقل">پشتیبانی و حمل و نقل</option>
                                            <option value="سایر">سایر</option>
                                        </select>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 mt-3">

                                            <span>
                                                ساعت و روزهای هفته جهت همکاری
                                                {{--<span class="text-danger">*</span>--}}
                                            </span>
                                        <input type="text"
                                               name="cooperation_time"
                                               class="input-ui pr-2 "
                                               placeholder=""
                                               >

                                    </div>
                                </div>



                                <div class="form-row mt-3">
                                    <button type="submit" class="btn-primary-cm btn-with-icon mx-auto w-100">
                                        <i class="mdi mdi-login-variant"></i>
                                        ثبت اطلاعات
                                        {{--<div class="spinner-border text-danger" role="status">--}}
                                            {{--<span class="sr-only">Loading...</span>--}}
                                        {{--</div>--}}
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
@endsection
