<template>

    <li>
        <button :class="getStatus" @click="getFavorite">
            <i class="mdi mdi-heart"></i>
        </button>
        <span class="tooltip-option">{{getTooltip}}</span>
    </li>

</template>

<script>
    import axios from 'axios';

    export default {
        name: "ProductFavorite",
        props: ['is_favorite', 'product_id', 'auth'],
        data() {

            return {
                IsFavorite: this.is_favorite
            }
        },
        methods: {
            getFavorite() {
                if (this.auth) {

                    axios.post(`/product/${this.product_id}/getFavorite`).then(response => {
                        console.log(response);
                        this.IsFavorite = response.data.is_favorite;
                    }).catch(err => console.log(err));

                } else {
                    this.$snotify.warning('برای افزودن محصول به علاقه مندی ها ابتدا باید وارد سایت شوید!', '');
                }

            }
        },
        computed: {
            getStatus() {
                if (this.IsFavorite) {
                    return 'add-favorites favorites';
                } else {
                    return 'add-favorites'
                }
            },
            getTooltip() {
                if (this.IsFavorite) {
                    return 'حذف از علاقمندی';
                } else {
                    return 'افزودن به علاقمندی'
                }
            }
        }
    }
</script>

<style scoped>

</style>