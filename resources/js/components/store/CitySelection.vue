<template>
    <div class="col-12">
    <div class="row">
        <div class="col-md-6 col-sm-12 mb-2">
            <div class="form-row-title">
                <h4>
                    استان
                </h4>
            </div>
            <div class="form-row">
                <div class="custom-select-ui">
                    <select class="right" name="state_id">
                        <option value="0" selected disabled>
                            انتخاب استان...
                        </option>

                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 mb-2">
            <div class="form-row-title">
                <h4>
                    شهر
                </h4>
            </div>
            <div class="form-row">
                <div class="custom-select-ui">
                    <select class="right">
                        <option value="bojnourd">
                            بجنورد
                        </option>
                        <option value="garme">
                            گرمه
                        </option>
                        <option value="shirvan">
                            شیروان
                        </option>
                        <option value="mane">
                            مانه و سملقان
                        </option>
                        <option value="esfarayen">
                            اسفراین
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
    export default {
        name: "CitySelection",
        props:['state_id','city_id']
    }
</script>

<style scoped>

</style>