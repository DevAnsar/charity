@extends('store.blog.master')
@section('blog-content-header')

    <div class="title-breadcrumb-special dt-sl">
        <div class="title-page dt-sl">
            <h1>{{$blog->title}}</h1>
        </div>

    </div>

@endsection
@section('blog-content')

    <div class="col-lg-9 col-md-8 col-sm-12 col-12 mb-3 mt-3">
        <div class="content-page">
            <div class="content-desc dt-sn dt-sl">
                <header class="entry-header dt-sl mb-3">
                    <div class="post-meta date">
                        <i class="mdi mdi-folder"></i>

                        دسته :
                        {{$blog->blog_category->title}}
                    </div>

                    <div class="post-meta date">
                        <i class="mdi mdi-calendar-month"></i>

                        ارسال شده در تاریخ:
                        {{\Hekmatinasser\Verta\Verta::instance($blog->created_at)
                                                               ->format('d  M  Y')}}
                    </div>

                    <div class="post-meta category">
                        <i class="mdi mdi-eye"></i>
                        تعداد بازدید:
                        {{$blog->viewCount}}

                    </div>
                </header>

                <div>
                    {!! $blog->content !!}
                </div>
            </div>
        </div>


        <div class="comments-area dt-sl">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-ui blog-comment">
                        <form onsubmit="return false">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-row-title mb-2">عنوان نظر شما (اجباری)</div>
                                    <div class="form-row">
                                        <input class="input-ui pr-2" type="text" placeholder="عنوان نظر خود را بنویسید">
                                    </div>
                                </div>
                                <div class="col-12 mt-3 mb-3">
                                    <div class="form-row-title mb-2">متن نظر شما (اجباری)</div>
                                    <div class="form-row">
                                        <textarea class="input-ui pr-2 pt-2" rows="5"
                                                  placeholder="متن خود را بنویسید"></textarea>
                                    </div>
                                </div>
                                <div class="col-12 px-3">
                                    <p class="d-block">با “ثبت نظر” موافقت خود را با <a href="#"
                                                                                        class="border-bottom-dt"
                                                                                        target="_blank">قوانین
                                            انتشار محتوا</a> در دیجی‌کالا اعلام می‌کنم.</p>
                                    <button class="btn btn btn-primary px-3">
                                        ثبت نظر
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="section-title text-sm-title title-wide no-after-title-wide mb-0 mt-5 dt-sl">
                <h2>نظرات کاربران</h2>
                <p class="count-comment">123 نظر</p>
            </div>
            <ol class="comment-list">
                <!-- #comment-## -->
                <li>
                    <div class="comment-body mt-3">
                        <div class="row">
                            <div class="col-12 comment-content">
                                <div class="comment-author">
                                    توسط مجید سجادی فرد در تاریخ ۵ مهر ۱۳۹۵
                                </div>

                                <p>لورم ایپسوم متن ساختگی</p>

                                <div class="footer">
                                    <div class="comments-likes">
                                        آیا این نظر برایتان مفید بود؟
                                        <button class="btn-like" data-counter="۱۱">بله
                                        </button>
                                        <button class="btn-like" data-counter="۶">خیر
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- #comment-## -->
                <li>
                    <div class="comment-body">
                        <div class="row">
                            <div class="col-12 comment-content">
                                <div class="comment-author">
                                    توسط مجید سجادی فرد در تاریخ ۵ مهر ۱۳۹۵
                                </div>
                                <p>
                                    بعد از چندین هفته بررسی تصمیم به خرید
                                    این مدل از ماشین لباسشویی گرفتم ولی
                                    متاسفانه نتونست انتظارات منو برآورده کنه
                                    .
                                    دو تا ایراد داره یکی اینکه حدودا تا 20
                                    دقیقه اول شستشو یه صدایی شبیه به صدای
                                    پمپ تخلیه همش به گوش میاد که رو مخه یکی
                                    هم با اینکه خشک کنش تا 1400 دور در دقیقه
                                    میچرخه، ولی اون طوری که دوستان تعریف
                                    میکردن لباسها رو خشک نمیکنه .ضمنا برای
                                    این صدایی که گفتم زنگ زدم نمایندگی اومدن
                                    دیدن، وتعمیرکار گفتش که این صدا طبیعیه و
                                    تا چند دقیقه اول شستشو عادیه.بدجوری خورد
                                    تو ذوقم. اگه بیشتر پول میذاشتم میتونستم
                                    یه مدل میان رده از مارکهای بوش یا آ ا گ
                                    میخریدم که خیلی بهتر از جنس مونتاژی کره
                                    ای هستش.
                                </p>

                                <div class="footer">
                                    <div class="comments-likes">
                                        آیا این نظر برایتان مفید بود؟
                                        <button class="btn-like" data-counter="۱۱">بله
                                        </button>
                                        <button class="btn-like" data-counter="۶">خیر
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- #comment-## -->
                <li>
                    <div class="comment-body">
                        <div class="row">
                            <div class="col-12 comment-content">
                                <div class="comment-author">
                                    توسط مجید سجادی فرد در تاریخ ۵ مهر ۱۳۹۵
                                </div>

                                <p>لورم ایپسوم متن ساختگی</p>

                                <div class="footer">
                                    <div class="comments-likes">
                                        آیا این نظر برایتان مفید بود؟
                                        <button class="btn-like" data-counter="۱۱">بله
                                        </button>
                                        <button class="btn-like" data-counter="۶">خیر
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- #comment-## -->
                <li>
                    <div class="comment-body">
                        <div class="row">
                            <div class="col-12 comment-content">
                                <div class="comment-author">
                                    توسط مجید سجادی فرد در تاریخ ۵ مهر ۱۳۹۵
                                </div>

                                <p>لورم ایپسوم متن ساختگی</p>

                                <div class="footer">
                                    <div class="comments-likes">
                                        آیا این نظر برایتان مفید بود؟
                                        <button class="btn-like" data-counter="۱۱">بله
                                        </button>
                                        <button class="btn-like" data-counter="۶">خیر
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- #comment-## -->
                <li>
                    <div class="comment-body">
                        <div class="row">
                            <div class="col-12 comment-content">
                                <div class="comment-author">
                                    توسط مجید سجادی فرد در تاریخ ۵ مهر ۱۳۹۵
                                </div>

                                <p>لورم ایپسوم متن ساختگی</p>

                                <div class="footer">
                                    <div class="comments-likes">
                                        آیا این نظر برایتان مفید بود؟
                                        <button class="btn-like" data-counter="۱۱">بله
                                        </button>
                                        <button class="btn-like" data-counter="۶">خیر
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ol>
        </div>
    </div>
@endsection