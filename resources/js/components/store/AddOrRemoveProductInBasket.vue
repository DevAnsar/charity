<template>
    <div>


        <div @click="deleteFromBasket" class="btn-primary-cm btn-with-icon"
             style="display: inline" v-if="hasInBasket">
            <img src="/store/assets/img/theme/shopping-cart.png" alt="">
            حذف از سبد خرید
        </div>

        <div @click="addToBasket" class="btn-primary-cm btn-with-icon"
             style="display: inline" v-else>
            <img src="/store/assets/img/theme/shopping-cart.png" alt="">
            افزودن به سبد خرید
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        name: "AddOrRemoveProductInBasket",
        props: ['product_id', 'has_in_basket'],
        data(){

            return{
                productId:this.product_id,
                hasInBasket:this.has_in_basket
            }
        },
        methods:{
            async addToBasket() {
                await axios.post('/addToBasket', {
                    'product_id': this.productId
                }).then(response => {
                    let {status, basket} = response.data;
                    if (status) {
                        this.hasInBasket=true;
                        this.basketChange(basket)
                    }
                }).catch(err => {
                    console.log(err)
                });

            },

            async  deleteFromBasket(){

                await axios.post('/deleteFromBasket', {
                    'product_id':  this.productId
                }).then(response => {
                    let {status, basket} = response.data;
                    if (status) {
                        this.hasInBasket=false;
                        this.basketChange(basket)
                    }
                }).catch(err => {
                    console.log(err)
                });
            },

            basketChange(basket){
                // console.log(product_id);
                this.$emit('basket-change',basket)
            }
        },


    }
</script>

<style scoped>

</style>