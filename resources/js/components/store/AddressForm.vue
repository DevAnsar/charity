<template>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true" id="AddressModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">
                        <span class="fa fa-location-arrow"></span>
                        <span>{{ title }}</span>
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div id="add_address_box">
                                <div class="row justify-content-center" v-if="server_error">
                                    <div class="col-10">
                                        <div class="alert alert-warning">
                                            خطا در ارسال اطلاعات مجددا تلاش نمایید
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="account_title">نام و نام خانوادگی تحویل گیرنده</div>
                                            <label class="input_label">
                                                <input type="text" v-model="receiver"
                                                       class="form-control"
                                                       placeholder="نام و نام خانوادگی تحویل گیرنده">
                                                <label v-if="error_receiver_message"
                                                       :class="[error_receiver_message ? 'feedback-hint active' : 'feedback']">
                                                    {{ error_receiver_message }}
                                                </label>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="account_title">شماره موبایل</div>
                                            <label class="input_label">
                                                <input type="text" v-model="mobile"
                                                       class="form-control" placeholder="شماره موبایل">
                                                <label v-if="error_mobile_message"
                                                       :class="[error_mobile_message ? 'feedback-hint active' : 'feedback']">
                                                    {{ error_mobile_message }}
                                                </label>
                                            </label>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="account_title">استان</div>
                                            <label class="input_label  w-100">
                                                <select class="selectpicker form-control w-100" v-model="state_id"
                                                        id="state_id"
                                                        v-on:change="getCity('')">
                                                    <option value="">انتخاب استان</option>
                                                    <option v-for="row in state" v-bind:value="row.id"
                                                            v-bind:key="row.id">
                                                        {{ row.title }}
                                                    </option>
                                                </select>
                                                <label v-if="error_state_id_message"
                                                       :class="[error_state_id_message ? 'feedback-hint active' : 'feedback']">
                                                    {{ error_state_id_message }}
                                                </label>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <div class="account_title">شهر</div>
                                            <label class="input_label  w-100">
                                                <select class="selectpicker form-control w-100" v-model="city_id"
                                                        id="city_id">
                                                    <option value="">انتخاب شهر</option>
                                                    <option v-for="row in city" v-bind:value="row.id"
                                                            v-bind:key="row.id">
                                                        {{ row.title }}
                                                    </option>
                                                </select>
                                                <label v-if="error_city_id_message"
                                                       :class="[error_city_id_message ? 'feedback-hint active' : 'feedback']">
                                                    {{ error_city_id_message }}
                                                </label>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="account_title">آدرس پستی</div>
                                            <label class="input_label w-100">
                                                    <textarea class="textArea form-control w-100" v-model="address"
                                                              placeholder="آدرس تحویل گیرنده را وارد نمایید"></textarea>

                                                <label v-if="error_address_message"
                                                       :class="[error_address_message ? 'feedback-hint active' : 'feedback']">
                                                    {{ error_address_message }}
                                                </label>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="account_title">کد پستی</div>
                                            <label class="input_label  w-100">
                                                <input type="text" v-model="postal_code" class="form-control"
                                                       placeholder="کد پستی">

                                                <label v-if="error_postal_code_message"
                                                       :class="[error_postal_code_message ? 'feedback-hint active' : 'feedback']">
                                                    {{ error_postal_code_message }}
                                                </label>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <button class="btn btn-primary" v-on:click="add_address()">
                                                <span>{{ btn_text }}</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div id="map" style="width:100%;height:400px"></div>
                            <button class="btn btn-success" id="select_location_btn">انتخاب</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import axios from 'axios';
    import myMixin from "../../myMixin";

    export default {
        name: "AddressFrom",
        data() {
            return {
                id: 0,
                receiver: '',
                mobile: '',
                state_id: '',
                city_id: '',
                address: '',
                postal_code: '',

                error_receiver_message: false,
                error_mobile_message: false,
                error_state_id_message: false,
                error_city_id_message: false,
                error_address_message: false,
                error_postal_code_message: false,
                state: [],
                city: [],
                title: 'افزودن آدرس جدید',
                btn_text: 'ثبت و ارسال به این آدرس',
                server_error: false,
                get_page: 'no'
            }
        },
        mixins: [myMixin],
        props: ['paginate'],
        mounted() {
            this.getstate();
            // this.get_page=this.paginate=='ok' ? 'ok' : 'no';
        },
        methods: {
            getstate() {
                axios.get('/get_state').then(response => {
                    this.state = response.data.states;
                    console.log(this.state);
                    setTimeout(function () {
                        $("#state_id").selectpicker('refresh');
                    }, 100)
                });
            },
            getCity: function (id) {
                if (this.state_id != '') {
                    this.city_id = id;
                    this.city = [];
                    axios.get('/get_city/' + this.state_id).then(response => {
                        this.city = response.data.city;
                        setTimeout(function () {
                            $("#city_id").selectpicker('refresh');
                        }, 100)
                    });
                }
            },
            add_address: function () {
                const validateReceiver = this.validateReceiver();
                const validateMobileNumber = this.validateMobileNumber();
                const validateAddress = this.validateAddress();
                const validatePostalCode = this.validatePostalCode();
                const validateState = this.validateState();
                const validateCity = this.validateCity();

                if (validateReceiver && validateMobileNumber && validateAddress && validatePostalCode && validateState && validateCity) {
                    $("#loading_box").show();
                    const lat = $("#lat").val();
                    const lng = $("#lng").val();

                    const formData = new FormData();
                    formData.append('id', this.id);
                    formData.append('receiver', this.receiver);
                    formData.append('mobile', this.mobile);
                    formData.append('address', this.address);
                    formData.append('postal_code', this.postal_code);
                    formData.append('city_id', this.city_id);
                    formData.append('state_id', this.state_id);
                    formData.append('lat', lat);
                    formData.append('lng', lng);
                    formData.append('paginate', this.get_page);
                    const url = '/add-address';
                    this.server_error = false;
                    axios.post(url, formData).then(response => {
                        $("#loading_box").hide();
                        if (response.data != "error") {
                            window.location.reload();
                            // this.$emit('setData', response.data);
                            // $("#AddressModal").modal('hide');
                        }
                        else {
                            this.server_error = true;
                        }
                    }).catch(error => {
                        $("#loading_box").hide();
                        this.server_error = true;
                    });
                }
            },

            validateReceiver: function () {
                if (this.receiver.toString().trim() == "") {
                    this.error_receiver_message = 'نام و نام خانوادگی نمی تواند خالی باشد';
                    return false;
                }
                else if (this.receiver.toString().trim().length < 6) {
                    this.error_receiver_message = 'نام و نام خانوادگی حداقل باید شامل ۶ کاراکتر باشد';
                    return false;
                }
                else {
                    this.error_receiver_message = false;
                    return true;
                }
            },
            validateMobileNumber: function () {
                if (this.mobile.toString().trim() == "") {
                    this.error_mobile_message = 'لطفا شماره موبایل خود را وارد نمایید';
                    return false;
                }
                else if (this.check_mobile_number()) {
                    this.error_mobile_message = 'شماره موبایل وارد شده معتبر نمی باشد';
                    return false;
                }
                else {
                    this.error_mobile_message = false;
                    return true;
                }
            },
            validateAddress: function () {
                if (this.address.toString().trim() == "") {
                    this.error_address_message = 'آدرس نمی تواند خالی باشد';
                    return false;
                }
                else if (this.address.toString().trim().length < 20) {
                    this.error_address_message = 'آدرس وارد شده کوتاه است';
                    return false;
                }
                else {
                    this.error_address_message = false;
                    return true;
                }
            },
            validatePostalCode: function () {
                if (this.postal_code.toString().trim() == "") {
                    this.error_postal_code_message = 'کد پستی نمی تواند خالی باشد';
                    return false;
                }
                else if (this.postal_code.toString().trim().length < 10 || isNaN(this.postal_code) || this.postal_code.toString().trim().length > 10) {
                    this.error_postal_code_message = 'کد پستی معتبر نمی باشد';
                    return false;
                }
                else {
                    this.error_postal_code_message = false;
                    return true;
                }
            },
            validateState: function () {
                if (this.state_id.toString().trim() == "") {
                    this.error_state_id_message = 'لطفا استان را انتخاب کنید';
                    return false;
                }
                else {
                    this.error_state_id_message = false;
                    return true;
                }
            },
            validateCity: function () {
                if (this.city_id.toString().trim() == "") {
                    this.error_city_id_message = 'لطفا شهر را انتخاب کنید';
                    return false;
                }
                else {
                    this.error_city_id_message = false;
                    return true;
                }
            },

            setUpdateData: function (address, title) {
                this.btn_text = 'ویرایش';
                this.id = address.id;
                this.receiver = address.receiver;
                this.mobile = address.mobile;
                this.city_id = address.city_id;
                this.state_id = address.state_id;
                this.address = address.address;
                this.postal_code = address.postal_code;
                this.title = title;
                this.getstate();
                if (this.state_id > 0) {
                    this.getCity(this.city_id);
                }
                else {
                    this.cityList = [];
                    setTimeout(function () {
                        $("#city_id").selectpicker('refresh');
                    }, 100);
                }
                this.error_receiver_message = false;
                this.error_mobile_message = false;
                this.error_address_message = false;
                this.error_postal_code_message = false;
                this.error_state_id_message = false;
                this.error_city_id_message = false;
                $("#AddressModal").modal('show');
            },

            setTitle: function (title) {
                this.title = title;
                this.id = '';
                this.receiver = '';
                this.mobile = '';
                this.city_id = '';
                this.state_id = '';
                this.address = '';
                this.postal_code = '';
                this.btn_text = 'ثبت و ارسال به این آدرس';
            }

        }
    }
</script>

<style scoped>

</style>
