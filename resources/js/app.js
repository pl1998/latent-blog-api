
require('./bootstrap');


// axios.interceptors.request.use(
//     config => {
//         if (localStorage.getItem('Authorization')) {
//             config.headers.Authorization = localStorage.getItem('Authorization');
//         }
//         return config;
//     },
//     error => {
//         return Promise.reject(error);
//     });
// let token = document.head.querySelector('meta[name="csrf-token"]');
//
// if (token) {
//     window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
// } else {
//     console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
// }
//

import Vue from 'vue'
import router from "./routes.js";
import store from "./store.js";

import swal from "sweetalert";



// var user =  JSON.parse(localStorage.getItem('login_users'));
// console.log(user.name)
// 路由值守

import animated from 'animate.css'
Vue.use(animated)
//验证器
import './src/directives/index'
import hljs from 'highlight.js';
import axios from 'axios'
window.axios = axios
window.hljs = hljs
window.swal = swal

Vue.directive('highlight',function (el) {
    let blocks = el.querySelectorAll('pre code');
    blocks.forEach((block)=>{
        hljs.highlightBlock(block)
    })
})



import App from './view/App'

router.beforeEach((to, from, next) => {
    if(JSON.parse(sessionStorage.getItem('stare'))){ //判断本地是否存在access_token

        if(sessionStorage.setItem('store')){
            next()
        }else {
            next({
                path:'/login'
            })
        }

        if (to.meta.requireAuth) { // 判断该路由是否需要登录权限
            next({
                path:'/login'
            })
        }else {
            next()
        }
    }
    else {
        next();
    }
    /*如果本地 存在 token 则 不允许直接跳转到 登录页面*/
    if(to.fullPath == "/login"){
        if(JSON.parse(localStorage.getItem('islogin'))){
            next({
                path:from.fullPath
            });
        }else {
            next();
        }
    }
});

/**
 * 注册组件
 */
// Vue.component('Categories',require('./view/Categories.vue').default);
// Vue.component('Home',require('./view/Home.vue').default);
// Vue.component('HeadNav',require('./view/HeadNav.vue').default);
// Vue.component('Footer',require('./view/Footer.vue').default);
// Vue.component('NavCategory',require('./view/layouts/NavCategory.vue').default);
// Vue.component('Pagination',require('./view/Pagination.vue').default);
// Vue.component('Likes',require('./view/Likes.vue').default);
// Vue.component('Login',require('./view/layouts/Login.vue').default);
//




const app = new Vue({
    el: '#app',
    components: { App },
    router,
    store
});
