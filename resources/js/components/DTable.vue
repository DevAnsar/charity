<template>
    <div>
        <!--<h2>-->
            <!--سلام-->
        <!--</h2>-->
        <datatable :columns="columns" :data="rows"></datatable>
    </div>
</template>

<script>

    export default {
        name: "DTable",
        props:['table_columns','rows'],
        data() {
            return{
                columns: this.table_columns,
                rows: [

                    {
                        id: 1,
                        user: {
                            username: "dprice0",
                            firstName: "Daniel",
                            lastName: "Price",
                            email: "dprice0@blogs.com"
                        },
                        address: "3 Toban Park",
                        city: "Pocatello",
                        state: "Idaho"
                    }

                ]
            }

        }
    }
</script>

<style scoped>

</style>