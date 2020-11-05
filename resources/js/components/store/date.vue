<template>
    <div class="">
        <input  type="text"
                id="my-custom-date-input"
                name="date_of_birth"
                class="input-ui pr-2"
                placeholder=""
                :value="date"
                required>
        <date-picker class=""  v-model="date" element="my-custom-date-input" />
        <!--<input  type="hidden"-->
               <!--name="date_of_birth" :value="date"-->
               <!--class="input-ui pr-2 border-danger"-->
               <!--placeholder=""-->
               <!--required>-->
    </div>
</template>

<script>
    import VuePersianDatetimePicker from 'vue-persian-datetime-picker';
    export default {
        name: "date",
        data(){
            return {
                date: ''
            }
        },
        components: {
            datePicker: VuePersianDatetimePicker
        }
    }
</script>

<style scoped>

</style>