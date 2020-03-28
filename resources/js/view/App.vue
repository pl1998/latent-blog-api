<template>
    <div>
        <Categories></Categories>
        <HeadNav v-if="$route.path.slice(-6)!=='/login' && $route.path.slice(-9)!=='/register' " ></HeadNav>
        <div class="container">
            <router-view></router-view>
        </div>
        <Footer></Footer>
    </div>
</template>
<script>
    import Categories from "./Categories";
    import HeadNav from "./HeadNav";
    import Footer from "./Footer";
    export default {
        components: {HeadNav, Categories, Footer},
        created() {
            if (sessionStorage.getItem("store") ) {
                this.$store.replaceState(Object.assign({}, this.$store.state,JSON.parse(sessionStorage.getItem("store"))))
            }
            //在页面刷新时将vuex里的信息保存到sessionStorage里
            window.addEventListener("beforeunload",()=>{
                sessionStorage.setItem("store",JSON.stringify(this.$store.state))
            })
        }
    }
</script>

