<template>
    <div class="row">

        <div class="cart-page-content col-xl-9 col-lg-8 col-12 px-0">
            <section class="page-content dt-sl">
                <div class="section-title text-sm-title title-wide no-after-title-wide mb-0 px-res-1">
                    <h2>انتخاب شیوه پرداخت</h2>
                </div>
                <form method="post" id="shipping-data-form" class="dt-sn pt-3 pb-3 mb-4">
                    <div class="checkout-pack">
                        <div class="row">
                            <div class="checkout-time-table checkout-time-table-time">
                                <div class="col-12">
                                    <div class="radio-box custom-control custom-radio pl-0 pr-3">
                                        <input type="radio" class="custom-control-input" name="post-pishtaz" id="1"
                                               value="1" checked v-model="pay_type">
                                        <label for="1" class="custom-control-label">
                                            <i class="mdi mdi-credit-card-outline checkout-additional-options-checkbox-image"></i>
                                            <div class="content-box">
                                                <div
                                                        class="checkout-time-table-title-bar checkout-time-table-title-bar-city">
                                                    پرداخت اینترنتی

                                                    <!--<span class="help-sn" data-toggle="tooltip" data-html="true"-->
                                                    <!--data-placement="bottom"-->
                                                    <!--title="<div class='help-container is-left'><div class='help-arrow'></div><p class='help-text'>با پرداخت اینترنتی، سفارش شما با اولویت بیشتری نسبت به پرداخت در محل پردازش و ارسال می شود. در صورت پرداخت ناموفق هزینه کسر شده حداکثر طی ۷۲ ساعت به حساب شما بازگردانده می‌شود.</p></div>">-->
                                                    <!--<span class="mdi mdi-information-outline"></span>-->
                                                    <!--</span>-->

                                                </div>
                                                <ul class="checkout-time-table-subtitle-bar">
                                                    <li>
                                                        آنلاین با تمامی کارت‌های بانکی
                                                    </li>
                                                </ul>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <!--<div class="radio-box custom-control custom-radio pl-0 pr-3">-->
                                        <!--<input type="radio" class="custom-control-input" name="post-pishtaz" id="2"-->
                                               <!--value="2" v-model="pay_type">-->
                                        <!--<label for="2" class="custom-control-label">-->
                                            <!--<i class="mdi mdi-credit-card-multiple-outline checkout-additional-options-checkbox-image"></i>-->
                                            <!--<div class="content-box">-->
                                                <!--<div-->
                                                        <!--class="checkout-time-table-title-bar checkout-time-table-title-bar-city">-->
                                                    <!--پرداخت اعتباری دیجی‌پی-->
                                                <!--</div>-->
                                            <!--</div>-->
                                        <!--</label>-->
                                    <!--</div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

                <slot></slot>


                <!--<div class="row mt-4">-->
                    <!--<div class="col-sm-6 col-12">-->
                        <!--<div class="dt-sn pt-3 pb-3 px-res-1">-->
                            <!--<div class="section-title text-sm-title title-wide no-after-title-wide mb-0">-->
                                <!--<h2>استفاده از کارت هدیه دیجی‌کالا-->
                                    <!--<span class="help-sn" data-toggle="tooltip" data-html="true"-->
                                          <!--data-placement="bottom"-->
                                          <!--title="<div class='help-container is-left'><div class='help-arrow'></div><p class='help-text'>با استفاده از کد کارت هدیه، تمام یا بخشی از مبلغ سفارش توسط کارت هدیه پرداخت می‌شود.-->
                                                        <!--در صورت باقی ماندن بخشی از مبلغ کارت هدیه، امکان استفاده از باقی مانده مبلغ برای خریدهای بعدی امکان‌پذیر است.</p></div>">-->
                                                    <!--<span class="mdi mdi-information-outline"></span>-->
                                                <!--</span>-->
                                <!--</h2>-->
                            <!--</div>-->
                            <!--<p>با ثبت کد کارت هدیه، مبلغ کارت هدیه از “مبلغ قابل پرداخت” کسر می‌شود.</p>-->
                            <!--<div class="form-ui">-->
                                <!--<form action="">-->
                                    <!--<div class="row text-center">-->
                                        <!--<div class="col-xl-8 col-lg-12 px-0">-->
                                            <!--<div class="form-row">-->
                                                <!--<input type="text" class="input-ui pr-2"-->
                                                       <!--placeholder="مثلا 1234ABCD5678EFGH0123">-->
                                            <!--</div>-->
                                        <!--</div>-->
                                        <!--<div class="col-xl-4 col-lg-12 px-0">-->
                                            <!--<button class="btn btn-primary mt-res-1">ثبت کد هدیه</button>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                <!--</form>-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div>-->
                    <!--<div class="col-sm-6 col-12">-->
                        <!--<div class="dt-sn pt-3 pb-3 px-res-1">-->
                            <!--<div class="section-title text-sm-title title-wide no-after-title-wide mb-0">-->
                                <!--<h2>استفاده از کد تخفیف دیجی‌کالا-->
                                    <!--<span class="help-sn" data-toggle="tooltip" data-html="true"-->
                                          <!--data-placement="bottom"-->
                                          <!--title="<div class='help-container is-left'><div class='help-arrow'></div><p class='help-text'>بعد از نهایی شدن سفارش کد تخفیف را ثبت نمایید. بعد از ثبت کد تخفیف امکان بازگشت و یا تغییر سبد وجود نخواهد داشت. در صورت تغییر سفارش، کد تخفیف از بین خواهد رفت و امکان اعمال مجدد آن وجود ندارد</p></div>">-->
                                                    <!--<span class="mdi mdi-information-outline"></span>-->
                                                <!--</span>-->
                                <!--</h2>-->
                            <!--</div>-->
                            <!--<p>با ثبت کد تخفیف، مبلغ کد تخفیف از “مبلغ قابل پرداخت” کسر می‌شود.</p>-->
                            <!--<div class="form-ui">-->
                                <!--<form action="">-->
                                    <!--<div class="row text-center">-->
                                        <!--<div class="col-xl-8 col-lg-12 px-0">-->
                                            <!--<div class="form-row">-->
                                                <!--<input type="text" class="input-ui pr-2" placeholder="مثلا 837A2CS">-->
                                            <!--</div>-->
                                        <!--</div>-->
                                        <!--<div class="col-xl-4 col-lg-12 px-0">-->
                                            <!--<button class="btn btn-primary mt-res-1">ثبت کد تخفیف</button>-->
                                        <!--</div>-->
                                    <!--</div>-->
                                <!--</form>-->
                            <!--</div>-->
                        <!--</div>-->
                    <!--</div>-->
                <!--</div>-->

                <div class="mt-5">
                    <a href="/shopping" class="float-right border-bottom-dt">
                        <i class="mdi mdi-chevron-double-right"></i>
                        بازگشت به شیوه ارسال
                    </a>
                    <a href="/getForPay" class="float-left border-bottom-dt">
                        ثبت نهایی سفارش
                        <i class="mdi mdi-chevron-double-left"></i>
                    </a>
                </div>

            </section>
        </div>

        <!--///-->
        <div class="col-xl-3 col-lg-4 col-12 w-res-sidebar sticky-sidebar ">
            <div class="dt-sn mb-2">
                <ul class="checkout-summary-summary">
                    <li>
                        <span>مبلغ کل (
                            {{ProductCount}}
                            کالا)</span><span>
                          {{new Intl.NumberFormat().format(TotalPrice)}}
                        تومان
                    </span>
                    </li>
                    <li class="checkout-summary-discount">
                        <span>سود شما از خرید</span>
                        <span>
                            <span>(
                                {{TotalPrice>0?TotalDiscountCalculator().discount:0 }}
                                ٪)</span>
                            {{new Intl.NumberFormat().format(TotalDiscountCalculator().price)}}
                            تومان
                        </span>
                    </li>
                    <li>
                        <span>هزینه ارسال

                            <!--<span class="help-sn"-->
                            <!--data-toggle="tooltip"-->
                            <!--data-html="true"-->
                            <!--data-placement="bottom"-->
                            <!--title="<div class='help-container is-right'><div class='help-arrow'></div><p class='help-text'>هزینه ارسال مرسولات می‌تواند وابسته به شهر و آدرس گیرنده متفاوت باشد. در صورتی که هر یک از مرسولات حداقل ارزشی برابر با ۱۵۰هزار تومان داشته باشد، آن مرسوله بصورت رایگان ارسال می‌شود.<br>'حداقل ارزش هر مرسوله برای ارسال رایگان، می تواند متغیر باشد.'</p></div>">-->
                            <!--<span class="mdi mdi-information-outline"></span>-->
                            <!--</span>-->
                        </span>
                        <span>
                            {{new Intl.NumberFormat().format(SendTypePrice)}}
                            تومان
                        </span>
                    </li>

                </ul>
                <div class="checkout-summary-devider">
                    <div></div>
                </div>
                <div class="checkout-summary-content">

                    <div class="checkout-summary-price-title">مبلغ قابل پرداخت:</div>
                    <div class="checkout-summary-price-value">
                        <span class="checkout-summary-price-value-amount">
                             {{new Intl.NumberFormat().format(TotalPayPrice)}}
                        </span>
                        تومان
                    </div>

                    <div class="form-row mt-2 checkout-summary-summary">
                        <div class="custom-control custom-checkbox float-right mt-2">
                            <input type="checkbox" class="custom-control-input" id="neddyCheck" name="needy"
                                   v-model="needy"
                                   :value="reale_needy"
                                   @change="myHasNeedy"
                            >
                            <label class="custom-control-label text-justify" for="neddyCheck">
                                نیازمند میباشم
                            </label>
                        </div>
                        <div class="form-control-plaintext" v-if="reale_needy">
                            مبلغ مورد نیاز جهت پرداخت اولیه:

                            <span class="text-primary font-weight-bold">
                            {{new Intl.NumberFormat().format(TotalNeedyPayPrice)}}
                             </span>
                            تومان
                        </div>
                    </div>

                    <!--<a href="#" class="mb-2 d-block">-->
                    <button class="btn-primary-cm btn-with-icon w-100 text-center pr-0" @click="goToPay">
                        <i class="mdi mdi-arrow-left"></i>
                        پرداخت و ثبت نهایی سفارش
                    </button>
                    <!--</a>-->
                    <div>
                        <span>
                                                        کالاهای موجود در سبد شما ثبت و رزرو نشده‌اند، برای ثبت سفارش
                                                        مراحل بعدی را تکمیل کنید.
                        </span>
                        <span class="help-sn"
                              data-toggle="tooltip"
                              data-html="true"
                              data-placement="bottom"
                              title="<div class='help-container is-right'><div class='help-arrow'></div><p class='help-text'>محصولات موجود در سبد خرید شما تنها در صورت ثبت و پرداخت سفارش برای شما رزرو می‌شوند. در صورت عدم ثبت سفارش، دیجی‌کالا هیچگونه مسئولیتی در قبال تغییر قیمت یا موجودی این کالاها ندارد.</p></div>">
                            <span class="mdi mdi-information-outline"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="dt-sn checkout-feature-aside pt-4">
                <ul>
                    <li class="checkout-feature-aside-item">
                        <img src="/store/assets/img/svg/return-policy.svg" alt="">
                        هفت روز ضمانت تعویض
                    </li>
                    <li class="checkout-feature-aside-item">
                        <img src="/store/assets/img/svg/payment-terms.svg" alt="">
                        پرداخت در محل با کارت بانکی
                    </li>
                    <li class="checkout-feature-aside-item">
                        <img src="/store/assets/img/svg/delivery.svg" alt="">
                        تحویل اکسپرس
                    </li>
                </ul>
            </div>
        </div>
        <vue-snotify></vue-snotify>

    </div>


</template>

<script>
    import axios from 'axios';
    import {minLength, required} from 'vuelidate/lib/validators';
    // const { validationMixin, default: Vuelidate } = require('vuelidate')

    export default {
        name: "Payment",
        components: {},
        props: ['img_env', 'send_type_price', 'payment_action','has_needy'],
        data() {

            return {
                needy: false,
                reale_needy: false,
                TotalNeedyPayPrice: 0,

                IMG: this.img_env,
                cartLoaded: false,
                Products: [],
                ProductCount: 0,
                TotalPrice: 0,
                TotalPayPrice: 0,
                SendTypePrice: this.send_type_price,
                pay_type: '1',
            }
        },
        computed: {},
        methods: {
            async getBasket() {
                await axios.get('/getCart')
                    .then(res => {
                        console.log('data', res);
                        this.Products = res.data.data;
                        this.ProductCountCalculator();
                        this.TotalPriceCalculator();
                        this.TotalPayPriceCalculator();

                        this.cartLoaded = true;

                        if (this.has_needy === "1"){
                            this.needy=true;
                            this.myHasNeedy();
                        }

                    }).catch(err => console.log(err));
            },
            TotalPriceCalculator() {
                let price = 0;
                this.Products.map(product => {
                    price = price + (product.count * parseInt(product.price));
                });

                this.TotalPrice = price;
            },
            TotalPayPriceCalculator() {
                let price = 0;
                this.Products.map(product => {
                    price = price + (product.count * parseInt(product.price * (1 - parseInt(product.discount) / 100)));
                });

                this.TotalPayPrice = price + parseInt(this.SendTypePrice);
            },
            TotalDiscountCalculator() {
                let price = 0;
                this.Products.map(product => {
                    price = price + (product.count * parseInt(product.price * (1 - parseInt(product.discount) / 100)));
                });

                return {
                    'price': this.TotalPrice - price,
                    'discount': Math.ceil(((this.TotalPrice - price) / this.TotalPrice) * 100),
                }
            },
            ProductCountCalculator() {
                this.ProductCount = this.Products.length;
            },


            changeAddress(id) {
                console.log(id);
                axios.post('/change-address', {
                    id: id,
                }).then(response => {
                    console.log(response);
                    if (response.data.status) {
                        window.location.reload();
                    }
                }).error(err => console.log(err));
            },

            SendTypeChange(id) {
                console.log(id);
                axios.post('/change-send-type', {
                    id: id,
                }).then(response => {
                    console.log(response);
                    if (response.data.status) {
                        // window.location.reload();
                    }
                }).error(err => console.log(err));

            },

            goToPay() {
                window.location = this.payment_action + '?_type=' + this.pay_type;
            },

            myHasNeedy() {
                console.log(this.needy);
                if (this.needy) {

                    axios.post('/checkMyNeedyStatus',{
                        totalPayPrice:this.TotalPayPrice
                    }).then(response => {
                        let {status, message, discount} = response.data;
                        if (status) {
                            this.TotalNeedyPayPrice = this.TotalPayPrice * discount / 100;
                            this.reale_needy = true;

                        } else {
                            this.needy = false;
                            this.$snotify.warning(message, '');
                        }
                    }).catch(err => console.log(err));


                } else {
                    axios.post('/deleteMyNeedySession').then(response => {

                            this.TotalNeedyPayPrice = this.TotalPayPrice;
                            this.needy = false;
                            this.reale_needy = false;

                    }).catch(err => console.log(err));

                }
            }
        },
        validations: {
            receiver: {
                required: required,
                minLength: minLength(2)
            },
            postal_code: {
                required: required,
                minLength: minLength(10)
            },
        },

        created() {
            this.getBasket();

        },
    }
</script>

<style scoped>

</style>