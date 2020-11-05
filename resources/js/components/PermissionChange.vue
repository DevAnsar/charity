<template>
    <div>
        <div class="custom-control custom-switch mb-2" dir="rtl" v-if="!loading">
            <input type="checkbox" class="custom-control-input"
                   :id="id"
                   :checked="Checked"
                   @change="getChange"
            >
            <label class="custom-control-label" :for="id"></label>
        </div>

        <div class="pb-1" v-else>
            <div class="spinner-border text-secondary m-1 spinner-border-sm" role="status" >
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "PermissionChange",
        props: ['permission', 'permission_id', 'role_id', 'is_checked'],
        data() {
            return {
                Permission: this.permission,
                PermissionId: this.permission_id,
                RoleId: this.role_id,
                loading: false,
                Checked: this.is_checked
            }
        },
        computed: {
            id() {
                return `customSwitch_${this.PermissionId}_${this.RoleId}`;
            },
        },
        methods: {
            getChange() {
                console.log('changed');
                this.loading = true;
                let url = '';
                if (this.Checked) {
                    url = `/panel/permissions/revoke-permission-to-role`;
                } else {
                    url = `/panel/permissions/give-permission-to-role`;
                }

                axios.post(url, {
                    roleId: this.RoleId,
                    permission: this.Permission
                })
                    .then(response => {
                        this.loading = false;
                        console.log(response.data);
                        if (response.data.status) {
                            this.Checked = !this.Checked
                        }
                    }).catch(err => {
                    console.log(err)
                });
            }
        }
    }
</script>

<style scoped>

</style>