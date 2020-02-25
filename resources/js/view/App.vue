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
    }
</script>

