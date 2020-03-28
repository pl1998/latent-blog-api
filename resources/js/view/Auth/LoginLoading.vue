<template>
    <div>
        <p>登录中.....</p>
    </div>
</template>

<script>
    export default {
        name: "LoginLoading.vue",
        created() {
           this.getToken();
        },
        computed:{
            // categoriesLoadStatus(){
            //     return this.$store.getters.getCategoriesLoadStatus;
            // },
            // categories()
            // {
            //     return this.$store.getters.getCategories;
            // }

        },
        methods:{
            getToken()
            {
                alert(11111)
            }
        }
    }
</script>

<style scoped>

</style>
