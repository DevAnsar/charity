<template>

    <div>

        <div v-if="level===1">
            <div class="form-row-title">
                <h3>شماره موبایل</h3>
            </div>
            <div class="form-row with-icon">

                <input type="text" id="mobile"
                       name="email"
                       class="input-ui pr-2"
                       placeholder="شماره موبایل خود را وارد نمایید" v-model="mobile"
                       required autocomplete="mobile"
                       autofocus>


                <i class="mdi mdi-account-circle-outline"></i>
            </div>

            <div class="form-row mt-3">
                <button class="btn-primary-cm btn-with-icon mx-auto w-100" @click="sendCode">
                    <i class="mdi mdi-login-variant"></i>
                    ارسال کد به تلفن همراه
                    <div v-if="loading" class="spinner-border text-danger" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </button>
            </div>
        </div>

        <div v-if="level===2">
            <div class="form-row-title">
                <h3>کد فعالسازی</h3>
            </div>
            <div class="form-row with-icon">

                <input type="number" id="password"
                       name="login_code"
                       class="input-ui pr-2"
                       placeholder="کد ارسال شده را وارد نمایید" v-model="login_code"
                       required autocomplete="mobile"
                       autofocus>

                <i class="mdi mdi-account-circle-outline"></i>
            </div>
            <!--<div class="form-row mt-2">-->
            <!--<div class="custom-control custom-checkbox float-right mt-2">-->
            <!--<input type="checkbox" class="custom-control-input" id="customCheck3" name="remember"-->
            <!--{{ old('remember') ? 'checked' : '' }}>-->
            <!--<label class="custom-control-label" for="customCheck3">-->
            <!--مرا به خاطر بسپار-->
            <!--</label>-->
            <!--</div>-->
            <!--</div>-->
            <div class="form-row mt-3">
                <button class="btn-primary-cm btn-with-icon mx-auto w-100" @click="login">
                    <i class="mdi mdi-login-variant"></i>
                    ارسال و
                    {{isRegistered?'ورود':'ثبت نام'}}
                    <div v-if="loading" class="spinner-border text-danger" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </button>
            </div>
        </div>

        <div v-if="level===3">
            <div class="form-row-title">
                <h3>ثبت اطلاعات</h3>
            </div>


            <div class="form-row-title">
                <h3>نام</h3>
            </div>
            <div class="form-row with-icon">
                <input type="text" class="input-ui pr-2 @error('name') is-invalid @enderror"
                       placeholder="نام  خود را وارد نمایید" id="name" name="name"
                       v-model="name" required autocomplete="name" autofocus>
                <i class="mdi mdi-account-circle-outline"></i>
            </div>

            <div class="form-row-title">
                <h3>نام خانوادگی</h3>
            </div>
            <div class="form-row with-icon">
                <input type="text" class="input-ui pr-2  is-invalid "
                       placeholder="نام  خانوادگی خود را وارد نمایید" id="family" name="family"
                       v-model="family" required>
                <i class="mdi mdi-account-circle-outline"></i>
            </div>

            <div>
                <div class="form-row mt-2">
                    <div class="custom-control custom-checkbox float-right mt-2">
                        <input type="checkbox" class="" id="customCheck4"
                               v-model="user_type"
                               value="needy">
                        <!--<label class="custom-control-label text-justify" for="customCheck4">-->
                        نیازمند میباشم
                        <!--</label>-->
                    </div>
                    <div class="custom-control custom-checkbox float-right mt-2">
                        <input type="checkbox" class="" id="customCheck5"
                               v-model="user_type"
                               value="helper">
                        <!--<label class="custom-control-label text-justify" for="customCheck5">-->
                        خیّر میباشم
                        <!--</label>-->
                    </div>
                    <div class="custom-control custom-checkbox float-right mt-2">
                        <input type="checkbox" class="" id="customCheck6"
                               v-model="user_type"
                               value="store">
                        <!--<label class="custom-control-label text-justify" for="customCheck5">-->
                        فروشنده میباشم
                        <!--</label>-->
                    </div>
                </div>

                <template v-if="user_type.filter(item=>item=='needy').length==1">

                    <div class="form-row with-icon  mt-3">
                        <span>کد ملی
                            <span class="text-danger">*</span>
                        </span>
                        <input type="number" :class="code_melli_error?'input-ui pr-2 border-danger':'input-ui pr-2' "
                               placeholder=""
                               v-model="code_melli" required>
                    </div>

                    <div class="form-row with-icon  mt-3">
                        <span>تاریخ تولد
                            <span class="text-danger">*</span>
                        </span>
                        <input type="text" :class="date_of_birth_error?'input-ui pr-2 border-danger':'input-ui pr-2' "
                               placeholder=""
                               v-model="date_of_birth" required>
                    </div>

                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="form-group mb-0">
                                <div class="account_title">استان
                                    <span class="text-danger">*</span>
                                </div>
                                <label class="input_label  w-100">
                                    <select :class="state_id_error ? 'selectpicker form-control w-100 border-danger':'selectpicker form-control w-100'"
                                            v-model="state_id"
                                            id="state_id"
                                            v-on:change="getCity('')">
                                        <option value="">انتخاب استان</option>
                                        <option v-for="row in state" v-bind:value="row.id"
                                                v-bind:key="row.id">
                                            {{ row.title }}
                                        </option>
                                    </select>
                                </label>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group mb-0">
                                <div class="account_title">شهر
                                    <span class="text-danger">*</span>
                                </div>
                                <label class="input_label  w-100">
                                    <select :class="city_id_error ? 'selectpicker form-control w-100 border-danger':'selectpicker form-control w-100'"
                                            v-model="city_id"
                                            id="city_id">
                                        <option value="">انتخاب شهر</option>
                                        <option v-for="row in city" v-bind:value="row.id"
                                                v-bind:key="row.id">
                                            {{ row.title }}
                                        </option>
                                    </select>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-row with-icon  mt-3">
                        <span>وضعیت تاهل

                            <span class="text-danger">*</span>
                        </span>
                        <select :class="is_married_error?'input-ui pr-2 selectpicker border-danger':'input-ui pr-2 selectpicker' "
                                v-model="is_married" required>
                            <option value="" selected>انتخاب کنید...</option>
                            <option value="1">متاهل</option>
                            <option value="0">مجرد</option>
                        </select>

                    </div>

                    <div class="form-row with-icon  mt-3">
                        <span>تعداد فرزندان
                            <span class="text-danger">*</span>
                        </span>
                        <input type="number"
                               :class="number_of_child_error?' input-ui pr-2 border-danger':'input-ui pr-2 '"
                               placeholder="تعداد فرزندان"
                               v-model="number_of_child" required>
                    </div>


                    <div class="form-row with-icon  mt-3">
                        <span>وضعیت اشتغال
                            <span class="text-danger">*</span>
                        </span>
                        <select :class="is_employed_error?'input-ui pr-2  border-danger':'input-ui pr-2 '"
                                v-model="is_employed" required>
                            <option value="" selected>انتخاب کنید...</option>
                            <option value="1">شاغل</option>
                            <option value="0">بیکار</option>
                        </select>

                    </div>

                    <div class="form-row with-icon  mt-3">
                         <span>وضعیت سلامت
                            <span class="text-danger">*</span>
                        </span>
                        <select :class="health_status_error?'input-ui pr-2  border-danger':'input-ui pr-2' "
                                v-model="health_status" required>
                            <option value="" selected>انتخاب کنید...</option>
                            <option value="healthy" selected>سالم</option>
                            <option value="patient">بیمار</option>
                            <option value="out_of_service">از کار افتاده</option>
                            <option value="disability">معلولیت</option>
                        </select>

                    </div>

                    <div class="form-row with-icon  mt-3">
                         <span>تحت پوشش
                            <span class="text-danger">*</span>
                        </span>
                        <select :class="covered_error?'input-ui pr-2 border-danger':'input-ui pr-2' "
                                v-model="covered" required>
                            <option value="" selected>انتخاب کنید...</option>
                            <option value="aid_committee">کمیته امداد</option>
                            <option value="rehabilitation">بهزیستی</option>
                            <option value="other">سایر</option>
                        </select>

                    </div>

                    <div class="form-row with-icon  mt-3">
                         <span>وضعیت مسکن
                            <span class="text-danger">*</span>
                        </span>
                        <select :class="housing_situation_error?'input-ui pr-2 border-danger ':'input-ui pr-2 '"
                                v-model="housing_situation" required>
                            <option value="" selected>انتخاب کنید...</option>
                            <option value="personal">شخصی</option>
                            <option value="rental">اجاره ای</option>
                        </select>

                    </div>

                    <div class="form-row with-icon  mt-3">
                        <span>آدرس محل سکونت
                            <span class="text-danger">*</span>
                        </span>
                        <input type="text" :class="address_error?'input-ui pr-2 border-danger':'input-ui pr-2' "
                               placeholder=""
                               v-model="address" required>
                    </div>

                    <div class="form-row with-icon  mt-3">
                        <span>تلفن منزل
                            <!--<span class="text-danger">*</span>-->
                        </span>
                        <input type="number" :class="tell_error?'input-ui pr-2 border-danger ':'input-ui pr-2' "
                               placeholder=""
                               v-model="tell" required>
                    </div>

                    <div class="form-row with-icon  mt-3">
                        <input type="file" class="input-ui pr-2 pt-1"
                               name="needy_file" id="needy_file">
                        <i class="mdi mdi-file-check-outline"></i>
                    </div>
                    <div class="form-footer text-right">
                        <a class="d-inline-block mr-1 mt-1 small">جهت تایید صلاحیت مدرک معتبر خود را آپلود نمایید.</a>
                    </div>


                </template>
            </div>

            <div class="form-row mt-3">
                <button class="btn-primary-cm btn-with-icon mx-auto w-100" @click="register">
                    <i class="mdi mdi-login-variant"></i>
                    ثبت نام

                    <div v-if="loading" class="spinner-border text-danger" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </button>
            </div>
        </div>

        <vue-snotify></vue-snotify>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "Login",
        props: ['redirect'],

        data() {
            return {
                Redirect: this.redirect,
                level: 1,
                mobile: '',
                login_code: '',
                loading: false,
                isRegistered: false,
                name: '',
                family: '',
                user_type: [],

                code_melli: '',
                date_of_birth: '',
                state_id: '',
                city_id: '',
                is_married: '',
                number_of_child: '0',
                is_employed: '',
                health_status: '',
                covered: '',
                housing_situation: '',
                tell: '',
                address: '',

                state: [],
                city: [],

                code_melli_error: false,
                state_id_error: false,
                city_id_error: false,
                date_of_birth_error: false,
                is_married_error: false,
                number_of_child_error: false,
                is_employed_error: false,
                health_status_error: false,
                covered_error: false,
                housing_situation_error: false,
                address_error: false,
                tell_error: false,
            }
        },
        methods: {

            sendCode() {
                if (!this.loading) {
                    if (this.mobile.length === 11) {
                        this.send_code_to_user();
                    } else {
                        //alert
                        this.$snotify.warning('شماره موبایل صحیح نمیباشد');
                        console.log('mobile invalid')
                    }
                }
            },
            async send_code_to_user() {

                this.loading = true;
                await axios.post('/send_code', {
                    mobile: this.mobile
                }).then(response => {
                    console.log(response);
                    this.loading = false;
                    let {status, registered, loginCode} = response.data;
                    // this.$snotify.warning('کد ورود', loginCode);

                    if (status) {
                        this.isRegistered = registered;
                        this.level = 2;
                    }


                }).catch(err => {
                    console.log(err)
                });

            },


            login() {
                if (!this.loading) {
                    if (this.login_code.length === 5) {
                        this.login_user();
                    } else {
                        //alert
                        this.$snotify.warning('کد وارد شده صحیح نمیباشد');
                        console.log('mobile invalid')
                    }
                }
            },
            async login_user() {

                this.loading = true;
                await axios.post('/login', {
                    mobile: this.mobile,
                    login_code: this.login_code
                }).then(response => {
                    console.log(response);
                    this.loading = false;
                    let {status, registered} = response.data;

                    if (status && registered) {

                        window.location = this.Redirect;
                    } else if (status && !registered) {
                        this.level = 3;
                    }
                    // this.loading=false;

                }).catch(err => {
                    console.log(err)
                });

            },

            register() {

                if (!this.loading) {
                    let name_message = '';
                    if (this.name.length < 1 || this.family.length < 1) {
                        if (this.name.length < 1 && this.family.length >= 1) {
                            name_message = 'نام خود را وارد کنید';
                        } else if (this.family.length < 1 && this.name.length >= 1) {
                            name_message = 'نام خوانوادگی خود را وارد کنید';
                        } else {
                            name_message = 'نام و نام خانوادگی خود را وارد کنید';
                        }
                        this.$snotify.warning(name_message);
                    }
                    else {

                        if (this.user_type.filter(item => item === 'needy').length === 1) {

                            if (this.needyFormValidate()) {
                                let needyfile = document.querySelector('#needy_file');
                                let hasFile = needyfile.files.length === 1 ? true : false;
                                if (hasFile) {
                                    this.register_user();
                                } else {
                                    this.$snotify.warning('درصورت نیازمند بودن باید مدرک احراز هویت خود را آپلود نمایید');
                                }

                            } else {
                                this.$snotify.warning('همه ی فیلدهای ضروری را باید پر کنید');
                            }


                        } else {
                            this.register_user();
                        }

                    }
                }
            },
            async register_user() {
                // console.log(this.user_type.toString());
                this.loading = true;

                let formData = new FormData();
                let needyfile = document.querySelector('#needy_file');

                formData.append("user_types", this.user_type.toString());
                formData.append("name", this.name);
                formData.append("family", this.family);
                formData.append("mobile", this.mobile);
                formData.append("login_code", this.login_code);

                if (this.user_type.filter(item => item === 'needy').length === 1) {
                    formData.append("needy_file", needyfile.files[0]);
                    formData.append("code_melli", this.code_melli);
                    formData.append("date_of_birth", this.date_of_birth);
                    formData.append("state_id", this.state_id);
                    formData.append("city_id", this.city_id);
                    formData.append("is_married", this.is_married);
                    formData.append("number_of_child", this.number_of_child);
                    formData.append("is_employed", this.is_employed);
                    formData.append("health_status", this.health_status);
                    formData.append("covered", this.covered);
                    formData.append("housing_situation", this.housing_situation);
                    formData.append("tell", this.tell);
                    formData.append("address", this.address);
                }

                await axios.post('/register', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then(response => {
                    console.log(response);
                    this.loading = false;
                    let {status} = response.data;
                    if (status) {

                        window.location = this.Redirect;
                    } else {
                        // this.level=3;
                    }


                }).catch(err => {
                    console.log(err)
                });
            },

            getState() {
                axios.get('/get_state').then(response => {
                    this.state = response.data.states;
                    console.log(this.state);
                    setTimeout(function () {
                        $("#state_id").selectpicker('refresh');
                    }, 100)
                });
            },
            getCity: function (id) {
                if (this.state_id !== '') {
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
            needyFormValidate() {
                let tellValidate = this.tellValidate();
                let code_melliValidate = this.code_melliValidate();
                let date_of_birthValidate = this.date_of_birthValidate();
                let state_idValidate = this.state_idValidate();
                let city_idValidate = this.city_idValidate();
                let is_marriedValidate = this.is_marriedValidate();
                let is_employedValidate = this.is_employedValidate();
                let health_statusValidate = this.health_statusValidate();
                let coveredValidate = this.coveredValidate();
                let housing_situationValidate = this.housing_situationValidate();
                let addressValidate = this.addressValidate();

                if (!tellValidate || !code_melliValidate || !date_of_birthValidate || !state_idValidate || !city_idValidate || !is_marriedValidate || !is_employedValidate || !health_statusValidate || !coveredValidate || !housing_situationValidate || !addressValidate) {
                    return false;
                } else {
                    return true;
                }
            },
            code_melliValidate() {
                if (this.code_melli.length === 10) {
                    this.code_melli_error = false;
                    return true;
                } else {
                    this.code_melli_error = true;
                    return false;
                }
            },
            date_of_birthValidate() {
                if (this.date_of_birth !== '') {
                    this.date_of_birth_error = false;
                    return true;
                } else {
                    this.date_of_birth_error = true;
                    return false;
                }
            },
            state_idValidate() {
                if (this.state_id !== '') {
                    this.state_id_error = false;
                    return true;
                } else {
                    this.state_id_error = true;
                    return false;
                }
            },
            city_idValidate() {
                if (this.city_id !== '') {
                    this.city_id_error = false;
                    return true;
                } else {
                    this.city_id_error = true;
                    return false;
                }
            },
            is_marriedValidate() {
                if (this.is_married !== '') {
                    this.is_married_error = false;
                    return true;
                } else {
                    this.is_married_error = true;
                    return false;
                }
            },
            is_employedValidate() {
                if (this.is_employed !== '') {
                    this.is_employed_error = false;
                    return true;
                } else {
                    this.is_employed_error = true;
                    return false;
                }
            },
            health_statusValidate() {
                if (this.health_status !== '') {
                    this.health_status_error = false;
                    return true;
                } else {
                    this.health_status_error = true;
                    return false;
                }
            },
            coveredValidate() {
                if (this.covered !== '') {
                    this.covered_error = false;
                    return true;
                } else {
                    this.covered_error = true;
                    return false;
                }
            },
            housing_situationValidate() {
                if (this.housing_situation !== '') {
                    this.housing_situation_error = false;
                    return true;
                } else {
                    this.housing_situation_error = true;
                    return false;
                }
            },
            addressValidate() {
                if (this.address.length > 10) {
                    this.address_error = false;
                    return true;
                } else {
                    this.address_error = true;
                    if (this.address.length > 0)
                        this.$snotify.warning('آدرس باید بیشتر از 10 کاراکتر باشد');
                    return false;
                }
            },
            tellValidate() {
                if (this.tell.length < 5) {
                    this.tell_error = true;
                    return false;
                } else {
                    this.tell_error = false;
                    return true;
                }
            },

        },
        mounted() {
            this.getState();
        },

    }
</script>

<style scoped>

</style>