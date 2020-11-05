<template>
    <form :action="this.action" method="post" ref="form">
        <input type="hidden" name="_token" :value="this.csrf">

        <a @click="logOut" style="cursor: pointer;display:block">
            <i class="mdi mdi-logout-variant"></i>
            {{this.title}}
        </a>
    </form>
</template>

<script>
    export default {
        name: "LogOutBtn",
        props:['action','csrf','title'],
        methods:{
            logOut(){
                this.$refs.form.submit()
            }
        }
    }
</script>

<style scoped>

</style>