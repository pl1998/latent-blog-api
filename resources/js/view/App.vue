<template>
    <div>
        <Nav></Nav>
<!--        <HeadNav></HeadNav>-->
        <div class="container">
            <router-view></router-view>
        </div>
        <Footer></Footer>
    </div>
</template>
<script>
    import Nav from "./Nav";
    import HeadNav from "./HeadNav";
    import Footer from "./Footer";
    export default {
        components: {HeadNav, Nav, Footer}
    }
</script>

