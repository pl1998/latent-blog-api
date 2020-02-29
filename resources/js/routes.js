import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)

/**
 * 引入组件路由
 */


export default new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            components: Vue.component( 'Home', require( './view/Home.vue' ) ),
        },
        {
            path: '/article/:id/:slug',
            name: 'article.show',
            components: Vue.component( 'Article', require( './view/Article.vue' ) ),
        },
        {
            path: '/login',
            name: 'login',
            components: Vue.component( 'Login', require( './view/layouts/Login.vue' ) ),
        },
        {
            path: '/register',
            name: 'register',
            components: Vue.component( 'Register', require( './view/layouts/Register.vue' ) ),
        },
        {
            path: '/tag/:tags/',
            name: 'tag',
            components: Vue.component( 'Tag', require( './view/Tag.vue' ) ),
        },
        {
            path: '/likes',
            name: 'likes',
            components: Vue.component( 'Likes', require( './view/Likes.vue' ) ),
        }
    ],
});
