require('./bootstrap');
import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter);


//验证器
import './src/directives/index'

import axios from 'axios'
window.axios = axios

import App from './view/App'
import Home from './view/Home'
import Article from './view/Article'
import Login from './view/layouts/Login'
import Register from './view/layouts/Register'
import Tag from './view/Tag'
/**
 * 注册组件
 */

Vue.component('Nav',require('./view/Nav.vue').default);
Vue.component('HeadNav',require('./view/HeadNav.vue').default);
Vue.component('Footer',require('./view/Footer.vue').default);
Vue.component('NavCategory',require('./view/layouts/NavCategory.vue').default);
Vue.component('Pagination',require('./view/Pagination.vue').default);



const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/article/:id/:slug',
            name: 'article.show',
            component: Article
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        {
            path: '/tag/:tags/',
            name: 'tag',
            component: Tag
        }
    ],
});
const app = new Vue({
    el: '#app',
    components: { App },
    router
});
