<template>
    <span class="count" v-text="this.basket_count"></span>
</template>

<script>
    export default {
        name: "BasketCount",
        props:['basket_count'],
        data(){

            return{

            }
        }
    }
</script>

<style scoped>

</style>