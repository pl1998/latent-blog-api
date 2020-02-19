<template>
    <div>
        <Nav></Nav>
        <HeadNav></HeadNav>
        <div class="container">
            <router-view></router-view>
        </div>
        <Footer></Footer>
<!--        <a id="scrollUp" href="#top" style="position: fixed; z-index: 2147483647; display: block;">Scroll to top</a>-->
    </div>
</template>
<!--<script src="https://cdn.bootcss.com/scrollup/2.4.1/jquery.scrollUp.js"></script>-->
<script>
    import Nav from "./Nav";
    import HeadNav from "./HeadNav";
    import Footer from "./Footer";
    export default {
        components: {HeadNav, Nav, Footer}
    }
</script>

