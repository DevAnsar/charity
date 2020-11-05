<template>
    <div>
        <!--<label class="typo__label">Simple select / dropdown</label>-->
        <multiselect
                v-model="value"
                :options="options"
                :multiple="true"
                :close-on-select="false"
                :clear-on-select="false"
                :preserve-search="true"
                placeholder="انتخاب کنید"
                label="name" track-by="name"
                :preselect-first="false">

            <template slot="selection"
                      slot-scope="{ values, search, isOpen }">
                <span class="multiselect__single" v-if="values.length &amp;&amp; !isOpen">{{ values.length }} گزینه انتخاب شده</span>
            </template>
        </multiselect>
        <input name="selected_roles"  :value="selectedRoles" type="hidden"/>
        <!--<pre class="language-json"><code>{{ value  }}</code></pre>-->
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect'

    export default {
        name: "MultiRole",
        components: {
            Multiselect
        },
        props:['roles','roles_selected'],
        data () {
            return {
                value: this.roles_selected?this.roles_selected:[],
                options: this.roles
            }
        },
        computed:{
            selectedRoles(){
                let r=[];
                return this.value.map((v,index)=>{
                    return r[index]=v.id;
                });
            }
        }
    }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>

</style>