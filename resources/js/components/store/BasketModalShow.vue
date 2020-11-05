<template>
    <div class="dropdown-menu cart dropdown-menu-sm dropdown-menu-left">
        <div class="dropdown-header">سبد خرید</div>
        <div class="dropdown-list-icons">
            <a v-for="data in this.basketData" :key="data.product_id"  class="dropdown-item">
                <div class="dropdown-item-icon">
                    <img :src="img_env+data.image" alt="">
                    <!--<img :src="getImageUrl.bind(this,data.image)" alt="">-->
                </div>
                <div class="mr-3">
                    <span v-text="data.title"></span>
                    <div class="pt-1">
                        <span>
                            {{new Intl.NumberFormat().format(parseInt(data.price)*(1-parseInt(data.discount)/100))}}
                        </span>
                        تومان</div>
                </div>

                <div class="mr-3">
                    <span v-text="data.count"></span>
                    عدد
                </div>
                <button class="remove" @click="destroy(data.product_id)">
                    <i class="mdi mdi-close" ></i>
                </button>
            </a>
        </div>
        <hr>
        <div class="dropdown-footer text-center">
            <div class="dt-sl mb-3">
                <span class="float-right">جمع :</span>
                <span class="float-left">
                    <span v-text="this.basket_products_price"></span>
                    تومان
                </span>
            </div>
            <a href="/cart" class="btn btn-success">مشاهده سبد خرید</a>
            <!--<a href="#" class="btn btn-primary">پرداخت</a>-->
            <!--<div @click="basketTotalPrice" class="btn btn-primary">jsj</div>-->
        </div>
    </div>
</template>

<script>
    export default {
        name: "BasketModalShow",
        props: ['basketData','img_env','basket_products_price'],
        data() {
            return{

            }
        },
        methods:{
            destroy(product_id){
                console.log(product_id);
                this.$emit('delete-product',product_id)
            }
        }
    }
</script>

<style scoped>

</style>