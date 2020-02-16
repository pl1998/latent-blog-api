<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-static-top">
        <div class="container">
            <a class="navbar-brand " href="">
                Latent
            </a>
            <ul class="navbar-nav mr-auto">
                <li v-for="nav in navList" class="nav-item  dropdown">
<!--                    dropdown-->
                    <a href="#" v-if="!nav.children " class="nav-link " data-toggle="dropdown " aria-haspopup="true" aria-expanded="false" id="categoryTree">{{nav.name}}</a>
                    <a href="#" v-else class="nav-link dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="categoryTree">{{nav.name}}</a>
                                        <ul v-if="nav.children" class="dropdown-menu" aria-labelledby="categoryTree">
                                            <NavCategory v-for="(item,index) in nav.children" :synClass="item" :key="index" ></NavCategory>
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
                    <router-link class="nav-link" :to="{ name: 'login' }"><i class="fa fa-user"></i> 登 录</router-link>
                    <router-link class="nav-link" :to="{ name: 'register' }"><i class="fa fa-user-plus"></i> 注 册
                    </router-link>
                    <!--                    <li class="nav-item"><a class="nav-link" href="">register</a></li>-->
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    import NavCategory from "./layouts/NavCategory";
    export default {
        name: "Nav",
        components:{NavCategory},
        data() {
            return {
                navList: null
            }
        },
        created() {
            this.fetchData();
        },
        methods: {
            open() {
                this.$alert('这是一段内容', '标题名称', {
                    confirmButtonText: '确定',
                    callback: action => {
                        this.$message({
                            type: 'info',
                            message: `action: ${action}`
                        });
                    }
                });
            },
            fetchData() {
                this.error = this.users = null;


                axios
                    .get('http://blog.test/api/getCategoryTree')
                    .then(response => {
                        var i =0;
                        this.navList = response.data;
                    });
            }
        }
    }
</script>

<style scoped>

</style>
