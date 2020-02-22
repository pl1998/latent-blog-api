<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-static-top">
        <div class="container">
            <router-link class="navbar-brand" :to="{ name: '/' }"> Latent</router-link>

            <ul class="navbar-nav mr-auto">
                <li v-for="nav in navList" class="nav-item  dropdown">
                    <a href="#" v-if="!nav.children " class="nav-link " data-toggle="dropdown " aria-haspopup="true"
                       aria-expanded="false" >{{nav.name}}</a>
                    <a href="#" v-else class="nav-link dropdown-toggle " data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false" >{{nav.name}}</a>
                    <ul v-if="nav.children" class="dropdown-menu" aria-labelledby="categoryTree">
                        <NavCategory v-for="(item,index) in nav.children" :synClass="item" :key="index"></NavCategory>
                    </ul>
                </li>

            </ul>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <input type="text" class="nav-search-box-input form-control ds-input" aria-label="search" placeholder="搜索"
                   value>
            <i class="el-icon-search nav-search"></i>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                </ul>
                <ul class="navbar-nav navbar-right">
                    <router-link class="nav-link" :to="{ name: 'login' }"> 登 录</router-link>
                    <router-link class="nav-link" :to="{ name: 'register' }">注 册</router-link>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    import NavCategory from "./layouts/NavCategory";
    export default {
        name: "Nav",
        components: {NavCategory},
        data() {
            return {
                type:['success','info','warning','danger'],
            }
        },
        computed:{
            cafesLoadStatus(){
                return this.$store.getters.getCategoriesLoadStatus;
            },
        },
        created() {
           this.$store.dispatch('categoriesLoadStatus');
        },
        methods: {
            fetchData() {
                this.error = this.users = null;
                axios
                    .get('/api/v1/getCategoryTree')
                    .then(response => {
                        var i = 0;
                        this.navList = response.data;
                    });
            }
        }
    }
</script>

<style scoped>

</style>
