/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import {VuejsDatatableFactory} from 'vuejs-datatable';
import Snotify, {SnotifyPosition} from 'vue-snotify';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import axios from 'axios';
import Vuelidate from 'vuelidate'

Vue.use(VuejsDatatableFactory);

const options = {
    toast: {
        position: SnotifyPosition.leftBottom,
        timeout: 5000
    },


};
Vue.use(Snotify, options);

Vue.use(Vuelidate);
// const { validationMixin, default: Vuelidate } = require('vuelidate');
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('permission-change', require('./components/PermissionChange').default);
Vue.component('multi-role', require('./components/MultiRole').default);
Vue.component('vue-select', require('./components/VueSelect').default);
Vue.component('d-table', require('./components/DTable').default);
Vue.component('wallet-help', require('./components/WalletHelp').default);
Vue.component('default-image', require('./components/DefaultImage').default);

Vue.component('basket-count', require('./components/store/BasketCount').default);
Vue.component('basket-modal-show', require('./components/store/BasketModalShow').default);
Vue.component('add-or-remove-product-in-basket', require('./components/store/AddOrRemoveProductInBasket').default);
Vue.component('cart', require('./components/store/Cart').default);
Vue.component('cart-product', require('./components/store/CartProduct').default);
Vue.component('log-out-btn', require('./components/store/LogOutBtn').default);
Vue.component('im-neddy', require('./components/store/ImNeedy').default);//
Vue.component('login', require('./components/store/auth/Login').default);
Vue.component('shopping', require('./components/store/Shopping').default);
Vue.component('payment', require('./components/store/Payment').default);
Vue.component('product-favorite-btn', require('./components/store/btn/ProductFavorite').default);
Vue.component('product-box', require('./components/store/ProductBox').default);
Vue.component('pagination',require('laravel-vue-pagination'));


Vue.component('city-selection',require('./components/store/CitySelection').default);
Vue.component('address-form',require('./components/store/AddressForm').default);
Vue.component('address-list',require('./components/store/AddressList').default);
Vue.component('date', require('./components/store/date').default);

import VuePersianDatetimePicker from 'vue-persian-datetime-picker';
Vue.use(VuePersianDatetimePicker, {
    name: 'custom-date-picker',
    props: {
        inputFormat: 'YYYY/MM/DD',
        format: 'jYYYY/jMM/jDD',
        editable: false,
        inputClass: 'input-ui',
        placeholder: '',
        altFormat: 'YYYY/MM/DD',
        color: '#f7858d',
        autoSubmit: false,
    }
});

Vue.prototype.$siteUrl = document.querySelector('meta[name="app_url"]').getAttribute('content');
// import axios from 'axios';
// import VueAxsio from 'vue-axios';
// Vue.use(VueAxsio,axios);

const app = new Vue({
    el: '#app',

    data() {
        return {
            BasketProducts: [],
            BasketProductsPrice: '0',
            // bus: new Vue(),
        }
    },
    methods: {
        async setBasket() {

            await axios.get('/getUserBasket').then(response => {
                // console.log('getUserBasket',response);
                this.BasketProducts = response.data;
                this.basketTotalPrice();
            }).catch(err => {
                console.log(err)
            });
        },
        BasketChange(session_basket) {
            this.BasketProducts = session_basket;
            this.basketTotalPrice();
            // this.$emit('deleted_product')
        },
        basketTotalPrice() {
            let price = 0;
            this.BasketProducts.map(data => {
                price = price + (parseInt(data.price)*(1-parseInt(data.discount)/100));
            });
            this.BasketProductsPrice = new Intl.NumberFormat().format(price);
        },

        async deleteProductInBasket(product_id) {

            await axios.post('/deleteFromBasket', {
                'product_id': product_id
            }).then(response => {
                let {status, basket} = response.data;
                if (status) {

                    this.BasketChange(basket)
                }
            }).catch(err => {
                console.log(err)
            });
        },
    },

    created() {
        this.setBasket();

        // let search = new window.URLSearchParams(window.location.search);
        // if (search.get('has_product') != null) {
        //     if (search.get('has_product') == 1) {
        //         $("#switcher-hasProduct").attr('checked', true)
        //     }
        // }
    }


});

