<template>
    <div>
        <div class="custom-control custom-switch mb-2" dir="rtl" v-if="!loading">
            <input type="checkbox" class="custom-control-input"
                   :id="id"
                   :checked="Checked"
                   @change="getChange"
            >
            <label class="custom-control-label" :for="id"></label>
        </div>

        <div class="pb-1" v-else>
            <div class="spinner-border text-secondary m-1 spinner-border-sm" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {

        name: "DefaultImage",
        props: ['product_id', 'image_id', 'is_main'],
        data() {
            return {
                ProductId: this.product_id,
                ImageId: this.image_id,
                Checked: this.is_main,
                loading:false
            }
        },
        computed: {
            id() {
                return `customSwitch_${this.ProductId}_${this.ImageId}`;
            },
        },
        methods: {
            getChange() {
                console.log('changed');
                this.loading = true;
                let url = `/panel/products/${this.ProductId}/images/${this.ImageId}/setDefault`;


                axios.patch(url)
                    .then(response => {
                        this.loading = false;
                        console.log(response.data);
                        if (response.data.status) {
                            this.Checked = response.data.check_status
                        }
                        window.location.reload();
                    }).catch(err => {
                    console.log(err)
                });
            }
        }
    }
</script>

<style scoped>

</style>