<template>
    <tr class="checkout-item">
        <td>
            <img :src="getImage(Product.main_image[0].url)" alt="" style="width: 100px">
            <button class="checkout-btn-remove" @click="destroy">&times;</button>
        </td>
        <td class="text-right">
            <a href="#">
                <h3 class="checkout-title">
                    {{product.title}}
                </h3>
            </a>
            <p class="checkout-dealer">
                فروشنده:
                {{Product.seller.name}}
            </p>

        </td>
        <td>
            <p class="mb-0">تعداد</p>
            <div class="number-input">
                <button
                        @click="stepDown"></button>
                <input class="quantity" min="1" name="quantity"
                       :value="this.count" type="number">
                <button
                        @click="stepUp"
                        class="plus"></button>
            </div>
        </td>
        <td><strong>
            {{new Intl.NumberFormat().format(TotalPrice)}}
            تومان
        </strong>
        </td>
    </tr>

</template>

<script>
    export default {
        name: "CartProduct",
        props: ['img_env', 'product', 'count'],
        data() {
            return {
                Product: this.product,
                TotalPrice: 0,
            }
        },
        methods: {
            getImage(url) {
                return this.img_env + url;
            },

            stepDown() {
                if (this.count > 1) {
                    this.$emit('countStepDown', this.Product.id);
                    // this.getTotalPrice();
                }
            },
            stepUp() {
                // console.log('countStepUp',this.count);
                if (this.count+1 <= this.Product.stock) {
                    this.$emit('countStepUp', this.Product.id);
                    // this.getTotalPrice();
                }else {
                    this.$snotify.info('تعداد انتخابی موجود نمیباشد');
                }
            },
            getTotalPrice() {
                this.TotalPrice=this.count * (parseInt(this.product.price)*(1- parseInt(this.product.discount)/100));
            },

            destroy(){
                // console.log(product_id);
                this.$emit('delete-product',this.Product.id)
            }
        },
        updated(){
            this.getTotalPrice();
        },
        created(){
            this.getTotalPrice();
        }
    }
</script>

<style scoped>

</style>