<template>
    <div>
        <!--<label class="typo__label">Simple select / dropdown</label>-->
        <multiselect
                v-model="selected"
                :options="options"
                :multiple="false"
                :close-on-select="true"
                :clear-on-select="true"
                :preserve-search="true"
                placeholder="انتخاب کنید"
                :label="this.input_label" :track-by="this.input_name"
                :preselect-first="false">

            <!--<template slot="selection"-->
                      <!--slot-scope="{ values, search, isOpen }">-->
                <!--<span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values }}</span>-->
            <!--</template>-->
        </multiselect>
        <input :name="this.input_name"  :value="selectedValue" type="hidden"/>
        <!--<pre class="language-json"><code>{{ value  }}</code></pre>-->
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect'

    export default {
        name: "VueSelect",
        components: {
            Multiselect
        },
        props:['input_name','input_label','data_options','data_selected'],
        data () {
            return {
                selected: this.data_selected?this.data_selected:'',
                options: this.data_options
            }
        },
        computed:{
            selectedValue(){
                return this.selected?this.selected.id:'';
            }
        }
    }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>

</style>