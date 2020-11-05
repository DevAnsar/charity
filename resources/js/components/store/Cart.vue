<template>
    <div class="row">
        <div class="col-xl-9 col-lg-8 col-12 px-0">
            <div class="table-responsive checkout-content dt-sl">
                <div class="checkout-header checkout-header--express">
                    <span class="checkout-header-title">محصولات موجود در سبد خرید</span>
                    <span class="checkout-header-extra-info">({{ProductCount}} کالا)</span>
                </div>


                <div class="container" v-if="cartLoaded">
                    <table class="table table-cart" v-if="Products.length > 0">
                        <tbody>


                        <cart-product v-for="(product,index) in Products"
                                      :key="index"
                                      :product="product"
                                      :img_env="IMG"
                                      :count="product.count"
                                      @countStepDown="StepDown"
                                      @countStepUp="StepUp"
                                      @delete-product="destroy"
                        ></cart-product>


                        </tbody>
                    </table>
                    <div v-else>

                        <div class="container main-container">

                            <div class="row">
                                <div class="col-12">
                                    <div class=" sl pt-3 pb-5">
                                        <div class="cart-page cart-empty">
                                            <div class="circle-box-icon">
                                                <i class="mdi mdi-cart-remove"></i>
                                            </div>
                                            <p class="cart-empty-title">سبد خرید شما خالیست!</p>

                                            <a href="/" class="btn-primary-cm">ادامه خرید در دیدیکالا</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="container" v-else>
                    <div class="row">
                        <div class="col-12 py-5">
                            <div class="row justify-content-center">
                                <span>
                                در حال دریافت...
                                </span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-12 w-res-sidebar sticky-sidebar">
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
                                {{TotalPrice>0?Math.ceil(((TotalPrice - TotalPayPrice)/TotalPrice)):0 }}
                                ٪)</span>
                            {{new Intl.NumberFormat().format(TotalPrice - TotalPayPrice)}}
                            تومان
                        </span>
                    </li>
                    <li>
                        <span>هزینه ارسال

                        </span>
                        <span>وابسته به نوع ارسال</span>
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
                    <button class="btn-primary-cm btn-with-icon w-100 text-center pr-0" @click="goToOrder">
                        <i class="mdi mdi-arrow-left"></i>
                        ادامه ثبت سفارش
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

        <!--<cart-price-boarad :authenticated="true"></cart-price-boarad>-->
        <vue-snotify></vue-snotify>

    </div>


</template>

<script>
    import axios from 'axios';
    import CartProduct from "./CartProduct";


    export default {
        name: "Cart",
        components: {CartProduct},
        props: ['img_env','authenticated'],
        data() {

            return {
                IMG: this.img_env,
                cartLoaded: false,
                Products: [],
                ProductCount: 0,
                TotalPrice: 0,
                TotalPayPrice: 0,
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

                this.TotalPayPrice = price;
            },
            // TotalDiscountCalculator() {
            //     let price = 0;
            //     this.Products.map(product => {
            //         price = price + (product.count * parseInt(product.price * (1 - parseInt(product.discount) / 100)));
            //     });
            //
            //     this.TotalPayPrice = price;
            // },
            ProductCountCalculator() {

                this.ProductCount = this.Products.length;
            },

            StepDown(product_id) {
                console.log('StepDown', product_id);
                this.Products.map(product => {
                    console.log(product.id);
                    if (product.id === product_id) {
                        return product.count--;
                    }
                });
                axios.post('/setDown', {
                    product_id
                }).then(res => {
                    this.setBasket(res.data.basket);
                });

            },
            StepUp(product_id) {
                console.log('StepUp');
                this.Products.map(product => {
                    if (product.id === product_id) {
                        return product.count++;
                    }
                });
                axios.post('/setUp', {
                    product_id
                }).then(res => {
                    this.setBasket(res.data.basket);
                });
            },
            destroy(product_id) {
                // this.Products=

                let x = this.Products.filter(product => {
                    if (product.id !== product_id) {
                        return product;
                    }
                });
                console.log('x', x);
                this.$emit('delete-product', product_id);
                this.Products = x;
            },
            setBasket(basket) {
                this.$emit('get-set-basket', basket)
            },
            goToOrder() {

                let basketCount = this.Products.length;

                if (basketCount > 0) {
                    if (this.authenticated){
                        window.location='/shopping'
                    } else {
                        window.location='/login?_redirect=/shopping'
                    }

                } else {


                    this.$snotify.warning('سبد خرید شما خالی است!', '');
                }
            }
        },


        created() {
            this.getBasket();
        },
        updated() {
            // this.getBasket();
            this.TotalPriceCalculator();
            this.TotalPayPriceCalculator();
        }
    }
</script>

<style scoped>

</style>