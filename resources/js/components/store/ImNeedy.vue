<template>
    <div>
        <div class="form-row mt-2">
            <div class="custom-control custom-checkbox float-right mt-2">
                <input type="checkbox" class="custom-control-input" id="customCheck4" name="needy" v-model="Needy"
                       @change="check()" :value="Needy">
                <label class="custom-control-label text-justify" for="customCheck4">
                    نیازمند میباشم
                </label>
            </div>
        </div>

        <template v-if="Needy">
            <div class="form-row with-icon">
                <input type="file" class="input-ui pr-2 pt-1" name="needy_file">
                <i class="mdi mdi-file-check-outline"></i>
            </div>
            <div class="form-footer text-right">
                <a class="d-inline-block mr-1 mt-1 small">جهت تایید صلاحیت مدرک معتبر خود را آپلود نمایید.</a>
            </div>
        </template>
    </div>
</template>

<script>
    export default {
        name: "ImNeedy",
        props: ['needy'],
        data() {

            return {
                Needy: this.needy
            }
        },
        methods: {
            check() {
                console.log('change');
            }
        }
    }
</script>

<style scoped>

</style>