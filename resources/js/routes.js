import Vue from 'vue'
import VueRouter from 'vue-router'
import store from "./store.js";

Vue.use(VueRouter)

/**
 * 引入组件路由
 */

import Home from "./view/Home";
import Article from "./view/Article";
import Login from "./view/layouts/Login";
import Register from "./view/layouts/Register";
import Tag from "./view/Tag";

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
