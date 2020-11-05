<template>
    <div class="row">

        <div class="cart-page-content col-xl-9 col-lg-8 col-12 px-0">
            <div class="section-title text-sm-title title-wide no-after-title-wide mb-0 px-res-1">
                <h2>انتخاب آدرس تحویل سفارش</h2>
            </div>
            <section class="page-content dt-sl">

                <div class="address-section">

                    <div v-if="has_changes_cart" class="alert alert-warning changes_cart">
                        <span>توجه : قیمت یا موجودی بعضی از کالاهای سبد خرید شما تغییر کرده است</span>
                        <a :href="$siteUrl+'/Cart'">مشاهده سبد خرید</a>
                    </div>

                    <div class="checkout-contact dt-sn rounded-0 px-0 pt-0 pb-0">
                        <div class="checkout-contact-content">
                            <div v-if="show_default_address()">
                                <ul class="checkout-contact-items">
                                    <li class="checkout-contact-item">
                                        گیرنده:
                                        <span class="full-name">{{DefaultAddress.receiver}}</span>
                                        <!--<a class="checkout-contact-btn-edit">اصلاح این آدرس</a>-->
                                    </li>
                                    <li class="checkout-contact-item">
                                        <div class="checkout-contact-item checkout-contact-item-mobile">
                                            شماره تماس:
                                            <span class="mobile-phone">{{DefaultAddress.mobile}}</span>
                                        </div>
                                        <div class="checkout-contact-item-message">
                                            کد پستی:
                                            <span class="post-code">{{DefaultAddress.postal_code}}</span>
                                        </div>
                                        <br>
                                        استان:
                                        <span class="state">{{DefaultAddress.state}}</span>
                                        ، ‌شهر:
                                        <span class="city">{{DefaultAddress.city}}</span>
                                        ،
                                        <span class="address-part">{{DefaultAddress.address}}</span>
                                    </li>
                                </ul>

                                <a class="checkout-contact-location" v-on:click="change_address()">تغییر
                                    آدرس
                                    ارسال</a>
                                <div class="checkout-contact-badge">
                                    <i class="mdi mdi-check-bold"></i>
                                </div>
                            </div>

                            <div v-if="AddressLists.length==0">
                                <div class="checkout-address-col">
                                    <button class="checkout-address-location" data-toggle="modal"
                                            v-on:click="showModalBox()" data-target=".bd-example-modal-lg"
                                    >
                                        <strong>ایجاد آدرس جدید</strong>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class=" dt-sn px-0 pt-0 pb-0 rounded-0" v-if="show_address_list"
                             id="user-address-list-container">
                            <div class="checkout-address-content">

                                <div class="checkout-address-headline">آدرس مورد نظر خود را جهت تحویل
                                    انتخاب فرمایید:
                                </div>
                                <div class="checkout-address-row">
                                    <div class="checkout-address-col">
                                        <button class="checkout-address-location"

                                                v-on:click="showModalBox()">
                                            <strong>ایجاد آدرس جدید</strong>
                                        </button>
                                    </div>
                                </div>

                                <div class="checkout-address-row" v-for="(address,key) in  AddressLists"
                                     v-bind:key="address.id">

                                    <div class="checkout-address-col">
                                        <div class="checkout-address-box">
                                            <h5 class="checkout-address-title">{{address.receiver}}</h5>
                                            <p class="checkout-address-text">
                                                            <span>
                                                                استان:
                                                                {{address.state}}
                                                                ،
                                                                شهر:
                                                                {{address.city}}
                                                                ،
                                                                آدرس پستی:
                                                                {{address.address}}
                                                            </span>
                                            </p>
                                            <ul class="checkout-address-list">
                                                <li>
                                                    <ul class="checkout-address-contact-info">
                                                        <li class="">کدپستی: <span>{{address.postal_code}}</span></li>
                                                        <li>شماره همراه: <span>{{address.mobile}}</span>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <ul>
                                                        <li>
                                                            <button class="checkout-address-btn-edit"
                                                                    v-on:click="updateRow(address)"
                                                            >
                                                                ویرایش
                                                            </button>

                                                        </li>
                                                        <li>
                                                            <button class="checkout-address-btn-remove"
                                                                    v-on:click="remove_address(address)"
                                                            >حذف
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>


                                            <button class="checkout-address-btn-submit" v-if="address.is_default"

                                            >سفارش به این آدرس
                                                ارسال می‌شود.
                                            </button>

                                            <button class="checkout-address-btn-submit" v-else
                                                    @click="changeAddress(address.id)"
                                            >
                                                انتخاب آدرس
                                            </button>

                                        </div>
                                    </div>

                                </div>


                            </div>
                            <button class="checkout-address-cancel" v-on:click="close_address_list()"></button>
                        </div>

                    </div>
                </div>

                <div class="modal fade" id="remove-location" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title mb-3" id="exampleModalLabel">آیا مطمئنید که
                                    این آدرس حذف شود؟</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button"
                                        class="remodal-general-alert-button remodal-general-alert-button--cancel"
                                        data-dismiss="modal">خیر</button>
                                <button type="button"
                                        class="remodal-general-alert-button remodal-general-alert-button--approve"

                                        v-on:click="delete_address()"
                                >بله</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!--<div class="message_div" v-if="show_dialog_box">-->



                    <!--<div class="message_box">-->
                        <!--<p id="msg">آیا مطمئنید که این آدرس حذف شود؟</p>-->
                        <!--<a class="alert alert-success" v-on:click="delete_address()">بله</a>-->
                        <!--<a class="alert alert-danger" v-on:click="show_dialog_box=false">خیر</a>-->
                    <!--</div>-->

                <!--</div>-->

                <form method="post" id="shipping-data-form" class="dt-sn pt-3 pb-3">

                    <div class="section-title text-sm-title title-wide no-after-title-wide mb-0 px-res-1">
                        <h2>انتخاب نحوه ارسال</h2>
                    </div>
                    <div class="checkout-shipment mb-4">

                        <div class="custom-control custom-radio pl-0 pr-3" v-for="(send_type,index) in SendTypes"
                             :key="index">
                            <input type="radio" class="custom-control-input"

                                   :id="'sendType'+send_type.id"
                                   :value="send_type.id"
                                   v-model="DefaultSendType"
                                   v-on:change="SendTypeChange(send_type.id)"
                            >
                            <label :for="'sendType'+send_type.id" class="custom-control-label">
                                {{send_type.title}}
                            </label>
                        </div>

                    </div>

                    <div class="section-title text-sm-title title-wide no-after-title-wide mb-0 px-res-1">
                        <h2>مرسوله</h2>
                    </div>
                    <div class="checkout-pack">
                        <section class="products-compact">
                            <!-- Start Product-Slider -->
                            <div class="col-12">
                                <slot></slot>
                            </div>
                            <!-- End Product-Slider -->
                        </section>
                        <!--<hr>-->

                    </div>

                    <!--<div class="section-title text-sm-title title-wide no-after-title-wide mb-0 px-res-1">-->
                    <!--<h2>صدور فاکتور</h2>-->
                    <!--</div>-->
                    <!--<div class="checkout-invoice">-->
                    <!--<div class="checkout-invoice-headline">-->
                    <!--<div class="custom-control custom-checkbox pl-0 pr-3">-->
                    <!--<input type="checkbox" class="custom-control-input" checked>-->
                    <!--<label class="custom-control-label">درخواست ارسال فاکتور خرید</label>-->
                    <!--</div>-->
                    <!--</div>-->
                    <!--</div>-->
                </form>
                <div class="mt-5">
                    <a href="/cart" class="float-right border-bottom-dt"><i
                            class="mdi mdi-chevron-double-right"></i>بازگشت به سبد خرید</a>
                    <a href="/payment" class="float-left border-bottom-dt">تایید و ادامه ثبت سفارش<i
                            class="mdi mdi-chevron-double-left"></i></a>
                </div>
            </section>
        </div>
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
                                {{TotalDiscountCalculator().discount}}
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
                    <!--<a href="#" class="mb-2 d-block">-->
                    <button class="btn-primary-cm btn-with-icon w-100 text-center pr-0" @click="goToPay">
                        <i class="mdi mdi-arrow-left"></i>
                        تایید و ادامه ثبت سفارش
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

        <address-form @setData="updateAddressList" ref="AddressesFormRef"></address-form>
        <vue-snotify></vue-snotify>

    </div>


</template>

<script>
    import axios from 'axios';
    import myMixin from "../../myMixin";
    import {minLength, required} from 'vuelidate/lib/validators';
    // const { validationMixin, default: Vuelidate } = require('vuelidate')

    export default {
        name: "Shopping",
        components: {},
        props: ['img_env', 'authenticated', 'addresses', 'default_address', 'send_types', 'default_send_type'],
        mixins: [myMixin],
        data() {

            return {
                IMG: this.img_env,
                cartLoaded: false,
                Products: [],
                ProductCount: 0,
                TotalPrice: 0,
                TotalPayPrice: 0,

                SendTypes: this.send_types,

                DefaultAddress: this.default_address,
                DefaultSendType: this.default_send_type,
                SendTypePrice: this.send_types.find(item => {
                    return item.id === this.default_send_type
                }).price,


                Cities: this.cities,

                AddressLists: [],
                show_address_list: false,
                show_default: true,
                city_id: 0,
                show_dialog_box: false,
                remove_address_id: '',
                has_changes_cart: false
            }
        },
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
                // this.TotalDiscount = price;
            },
            ProductCountCalculator() {

                this.ProductCount = this.Products.length;
            },


            setBasket(basket) {
                this.$emit('get-set-basket', basket)
            },

            goToPay() {

                let basketCount = this.Products.length;

                if (basketCount > 0) {
                    window.location = '/payment'

                } else {


                    this.$snotify.warning('سبد خرید شما خالی است!', '');
                }
            },

            checkNewAddressForm() {
                console.log('submit!');
                this.$v.$touch();
                if (this.$v.$invalid) {
                    this.submitStatus = 'ERROR';
                } else {
                    // do your submit logic here
                    this.submitStatus = 'PENDING';
                    setTimeout(() => {
                        this.submitStatus = 'OK';
                    }, 500)

                }
                ;
                this.addAddress();
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
                        this.SendTypePrice = this.send_types.find(item => {
                            return item.id === id
                        }).price;
                        // window.location.reload();
                    }
                }).error(err => console.log(err));

            },

            // getModalId(address_id){
            //     return 'modal-location-edit'+address_id;
            // } ,
            // addressModalCenterTitle(address_id){
            //     return 'addressModalCenterTitle'+address_id;
            // },

            close_address_list: function () {
                this.show_address_list = false;
                this.show_default = true;
            },
            show_default_address: function () {
                if (this.AddressLists.length > 0 && this.show_default) {
                    console.log('show default address');
                    return true;
                } else {
                    return false;
                }
            },
            change_address: function () {
                this.show_default = false;
                this.show_address_list = true;
            },

            updateAddressList: function (data) {
                //     this.AddressLists=data;
                //     if(this.AddressLists.length==1){
                //         this.city_id=this.AddressLists[0].city_id;
                //         this.show_default=true;
                //         document.getElementById('address_id').value=this.AddressLists[0].id;
                //     }
                //     $('body').css('overflow-y','auto');
            },
            change_default_address: function (key) {
                let old_array = this.AddressLists;
                const first = old_array[0];
                const select = old_array[key];

                this.city_id = select.city_id;

                this.$set(this.AddressLists, 0, select);
                this.$set(this.AddressLists, key, first);
                this.show_address_list = false;
                this.show_default = this;
                // document.getElementById('address_id').value=select.id;
            },

            loadMap: function () {
                let lat = '38.0412';
                let lng = '46.3993';
                let marker = null;
                let map = null;
                L.cedarmaps.accessToken = '196066ad375f95ed4c14b7eaaa2f7457af233d76';
                const tileJSONUrl = 'https://api.cedarmaps.com/v1/tiles/cedarmaps.streets.json?access_token=' + L.cedarmaps.accessToken;
                map = L.cedarmaps.map('map', tileJSONUrl, {
                    scrollWheelZoom: true
                }).addControl(L.cedarmaps.geocoderControl('cedarmaps.streets', {
                    keepOpen: false,
                    autocomplete: true,
                })).setView([lat, lng], 16);
                marker = L.marker([lat, lng]).addTo(map);
            },

            ChangeCartStatus: function () {
                this.has_changes_cart = true;
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
        updated() {
            // this.getBasket();
            this.TotalPriceCalculator();
            this.TotalPayPriceCalculator();
        },
        computed: {},
        mounted() {
            this.AddressLists = this.addresses;
            // if(this.AddressLists.length>0)
            // {
            //     this.city_id=this.AddressLists[0].city_id;
            //     document.getElementById('address_id').value=this.AddressLists[0].id;
            // }
        }
    }
</script>

<style scoped>

</style>