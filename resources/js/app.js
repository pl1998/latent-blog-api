// /**
//  * First we will load all of this project's JavaScript dependencies which
//  * includes Vue and other libraries. It is a great starting point when
//  * building robust, powerful web applications using Vue and Laravel.
//  */
//
// require('./bootstrap');
//
// window.Vue = require('vue');
//
// /**
//  * 引入vue-router
//  */
//
// import Vue from 'vue'
//
// import VueRouter from 'vue-router'
//
// Vue.use(VueRouter)
//
// import Home from "./components/Home";
//
//
//
// /**
//  * 引入element-ui组件
//  */
//
// import ElementUI from 'element-ui';
// import 'element-ui/lib/theme-chalk/index.css';
// Vue.use(ElementUI);
//
// /**
//  * The following block of code may be used to automatically register your
//  * Vue components. It will recursively scan this directory for the Vue
//  * components and automatically register them with their "basename".
//  *
//  * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
//  */
//
// // const files = require.context('./', true, /\.vue$/i);
// // files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
//
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('index', require('./components/Index').default);
//
// const router = new VueRouter({
//     mode: 'history',
//     routes: [
//         {
//             path: '/',
//             name: 'home',
//             component: Home
//         },
//     ],
// });
//
// /**
//  * Next, we will create a fresh Vue application instance and attach it to
//  * the page. Then, you may begin adding components to this application
//  * or customize the JavaScript scaffolding to fit your unique needs.
//  */
//
// const app = new Vue({
//     el: '#app',
//     components: { App },
//     router,
// });


import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter);

/**
 * 引入element-ui组件
 */

import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
Vue.use(ElementUI);


/**
 * 代码高亮
 */
import hljs from 'highlight.js'

/**
 * 添加全局
 * @type {*}
 */
window.hljs = hljs;



import App from './view/App'
import Home from './view/Home'
import Article from './view/Article'
import Login from './view/layouts/Login'
import Register from './view/layouts/Register'
/**
 * 注册组件
 */

Vue.component('Nav',require('./view/Nav.vue').default);
Vue.component('HeadNav',require('./view/HeadNav.vue').default);
Vue.component('Footer',require('./view/Footer.vue').default);



const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/article',
            name: 'article',
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
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
