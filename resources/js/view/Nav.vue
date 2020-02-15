<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-static-top">
        <div class="container">
            <a class="navbar-brand " href="">
                Latent
            </a>
            <ul class="navbar-nav mr-auto">
                <li v-for="item in navList" class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="categoryTree">{{item}}</a>
<!--                    <ul class="dropdown-menu" aria-labelledby="categoryTree"></ul>-->
                </li>
<!--                <li class="nav-item dropdown">-->
<!--                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >收藏文章 </a>-->
<!--                    <ul class="dropdown-menu" aria-labelledby="categoryTree">-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li class="nav-item dropdown">-->
<!--                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >分类 </a>-->
<!--                    <ul class="dropdown-menu" aria-labelledby="categoryTree">-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li class="nav-item dropdown">-->
<!--                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >友情标签 </a>-->
<!--                    <ul class="dropdown-menu" aria-labelledby="categoryTree">-->
<!--                    </ul>-->
<!--                </li>-->
            </ul>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <input type="text" class="nav-search-box-input form-control ds-input" aria-label="search" placeholder="搜索" value>
            <i class="el-icon-search nav-search"></i>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                </ul>
                <ul class="navbar-nav navbar-right">
                    <router-link class="nav-link" :to="{ name: 'login' }"><i class="fa fa-user"></i> 登 录</router-link>
                    <router-link class="nav-link" :to="{ name: 'register' }"> <i class="fa fa-user-plus"></i> 注 册</router-link>
<!--                    <li class="nav-item"><a class="nav-link" href="">register</a></li>-->
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        name: "Nav",
        data() {
            return {
                navList: ['关于我', '文章', '友链', '记叙','php','laravel','go','网络']
            }
        },
        methods: {
            open() {
                this.$alert('这是一段内容', '标题名称', {
                    confirmButtonText: '确定',
                    callback: action => {
                        this.$message({
                            type: 'info',
                            message: `action: ${ action }`
                        });
                    }
                });
            }
        }
    }
</script>

<style scoped>

</style>
