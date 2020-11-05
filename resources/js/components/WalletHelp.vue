<template>
    <div>
        <div class="form-group">
            <div class="row">
                <div class="col-3">
                    <label for="message-text" class="col-form-label">مبلغ واریزی:</label>
                </div>
                <div class="col-6">
                    <input name="left_over_price"
                           v-model="leftOverPrice"
                           class="form-control left_over_price"
                           type="number"
                           id="message-text" value="0">
                </div>
                <div class="col-3 pl-0">
                    <label for="message-text" class="col-form-label">تومان</label>
                </div>
            </div>


        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary waves-effect waves-light"
                    data-dismiss="modal">بستن
            </button>

            <a class="btn btn-primary waves-effect waves-light text-white" @click="getPayFromWallet">
                پرداخت از کیف پول

                <div v-if="loading" class="spinner-border spinner-border-sm mb-1 font-size-11 text-white" role="status">
                    <span class="sr-only"></span>
                </div>
            </a>

            <button type="submit" class="btn btn-info waves-effect waves-light">پرداخت بانکی</button>
        </div>
    </div>
</template>

<script>

    // import axios from 'axios';
    export default {
        name: "WalletHelp",
        props: ['order_id'],
        data() {
            return {
                loading: false,
                leftOverPrice: 0,
            }
        },
        methods: {
            getPayFromWallet() {
                if (this.leftOverPrice > 0) {
                    this.loading = true;
                    window.axios.post(`/panel/orders/${this.order_id}/sponsor/fromWallet`, {
                        left_over_price: this.leftOverPrice
                    })
                        .then(response => {
                            this.loading = false;
                            let {status, message} = response.data;
                            if (status === true) {
                                // alert(message);
                                window.location.reload();
                            } else {
                                alert(message);
                            }
                        })
                        .cache(err => console.log(err));
                }
                else {
                    alert('ابتدا مبلغ را وارد کنید');
                }
            }
        }
    }
</script>

<style scoped>

</style>