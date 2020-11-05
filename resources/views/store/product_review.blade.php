@extends('store.master')
@section('content')
    <main class="main-content dt-sl mt-4 mb-3">
        <div class="container main-container">

            <!-- Start Product -->
            <div class="dt-sn mb-5 dt-sl">
                <div class="row">
                    <!-- Product Thumbnail-->
                    <div class="col-lg-4 col-md-6 pb-5">
                        <div class="product-thumbnail text-center">
                            <a href="{{route('site.product',['slug'=>$product->slug])}}">
                                <img src="{{env('IMG').$product->main_image[0]->url}}"
                                     class="img-fluid" alt="">
                            </a>
                        </div>
                    </div>
                    <!-- Product Info -->
                    <div class="col-lg-8 col-md-6 pb-5">
                        <div class="product-info dt-sl">
                            <div class="product-title dt-sl">
                                <h1>
                                    {{$product->title}}
                                </h1>
                                <h3>{{$product->title_en}}</h3>
                            </div>
                            <div class="comments-product-attributes px-3 dt-sl">

                                <form class="px-5" action="{{route('site.products.reviews.send',['slug'=>$product->slug])}}" method="post" >
                                    @csrf
                                    @method('post')
                                    <div class="form-ui">
                                        <div class="row">
                                            <div class="col-sm-12 col-12 mb-3">
                                                <div class="comments-product-attributes-title">امتیاز</div>
                                                <input id="ex19" type="text" data-provide="slider"
                                                       name="rate"
                                                       required
                                                       data-slider-ticks="[1, 2, 3, 4, 5]"
                                                       data-slider-ticks-labels='["1", "2", "3","4","5"]'
                                                       data-slider-min="1" data-slider-max="5" data-slider-step="1"
                                                       data-slider-value="3" data-slider-tooltip="hide"/>
                                            </div>

                                            <div class="col-md-12 col-sm-12">

                                                <div class="row">

                                                    <div class="col-12 mt-5">
                                                        <div class="form-row-title mb-2">متن نظر شما (اجباری)</div>
                                                        <div class="form-row">
                                                <textarea name="review" required class="input-ui pr-2 pt-2" rows="5"
                                                          placeholder="متن خود را بنویسید"></textarea>
                                                        </div>
                                                    </div>


                                                    <div class="col-12 px-0">
                                                        <p class="d-block">
                                                            با “ثبت نظر” موافقت خود را با
                                                            <a href="#" class="border-bottom-dt" target="_blank">قوانین
                                                                انتشار
                                                                محتوا</a>
                                                            در دیجی‌کالا اعلام می‌کنم.
                                                        </p>
                                                        <button type="submit" class="btn btn btn-primary px-3">
                                                            ثبت نظر
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End Product -->

        </div>
    </main>
@endsection
@section('css')
    <link rel="stylesheet" href="/store/assets/css/vendor/bootstrap-slider.min.css">

@endsection
@section('script')
    <script src="/store/assets/js/vendor/bootstrap-slider.min.js"></script>
    <script>
        $(document).ready(function () {
            var inputs = $('#advantage-input, #disadvantage-input');
            var inputChangeCallback = function () {
                var self = $(this);
                if (self.val().trim().length > 0) {
                    self.siblings('.js-icon-form-add').show();
                } else {
                    self.siblings('.js-icon-form-add').hide();
                }
            };
            inputs.each(function () {
                inputChangeCallback.bind(this)();
                $(this).on('change keyup', inputChangeCallback.bind(this));
            });
            $("#advantages").delegate(".js-icon-form-add", 'click', function (e) {

                var parent = $('.js-advantages-list');
                if (parent.find(".js-advantage-item").length >= 5) {
                    return;
                }

                var advantageInput = $('#advantage-input');

                if (advantageInput.val().trim().length > 0) {
                    parent.append(
                        '<div class="ui-dynamic-label ui-dynamic-label--positive js-advantage-item">\n' +
                        advantageInput.val() +
                        '<button type="button" class="ui-dynamic-label-remove js-icon-form-remove"></button>\n' +
                        '<input type="hidden" name="comment[advantages][]" value="' + advantageInput
                            .val() + '">\n' +
                        '</div>');

                    advantageInput.val('').change();
                    advantageInput.focus();
                }

            }).delegate(".js-icon-form-remove", 'click', function (e) {
                $(this).parent('.js-advantage-item').remove();
            });

            $("#disadvantages").delegate(".js-icon-form-add", 'click', function (e) {

                var parent = $('.js-disadvantages-list');
                if (parent.find(".js-disadvantage-item").length >= 5) {
                    return;
                }

                var disadvantageInput = $('#disadvantage-input');

                if (disadvantageInput.val().trim().length > 0) {
                    parent.append(
                        '<div class="ui-dynamic-label ui-dynamic-label--negative js-disadvantage-item">\n' +
                        disadvantageInput.val() +
                        '<button type="button" class="ui-dynamic-label-remove js-icon-form-remove"></button>\n' +
                        '<input type="hidden" name="comment[disadvantages][]" value="' +
                        disadvantageInput.val() + '">\n' +
                        '</div>');

                    disadvantageInput.val('').change();
                    disadvantageInput.focus();
                }

            }).delegate(".js-icon-form-remove", 'click', function (e) {
                $(this).parent('.js-disadvantage-item').remove();
            });
        });
    </script>
@endsection
<script>

</script>