
require('./bootstrap');

import Vue from 'vue'
import router from "./routes.js";
import store from "./store.js";

import swal from "sweetalert";

// 路由值守

import animated from 'animate.css'
Vue.use(animated)

//全局指令
import './src/directives/index'

import hljs from 'highlight.js';
import axios from 'axios'
window.axios = axios
window.hljs = hljs
window.swal = swal

/**
 * 注册一个全局指令
 */

Vue.directive('highlight',function (el) {
    let blocks = el.querySelectorAll('pre code');
    blocks.forEach((block)=>{
        hljs.highlightBlock(block)
    })
})




import App from './view/App'

// router.beforeEach((to, from, next) => {
//     if(localStorage.getItem('Authorization')!=null){ //判断本地是否存在access_token
//
//         if(localStorage.getItem('Authorization')){
//             next()
//         }else {
//             next({
//                 path:'/login'
//             })
//         }
//
//         if (to.meta.requireAuth) { // 判断该路由是否需要登录权限
//             next({
//                 path:'/login'
//             })
//         }else {
//             next()
//         }
//     }
//     else {
//         next();
//     }
//     /*如果本地 存在 token 则 不允许直接跳转到 登录页面*/
//     if(to.fullPath == "/login"){
//         if(JSON.parse(localStorage.getItem('islogin'))){
//             next({
//                 path:from.fullPath
//             });
//         }else {
//             next();
//         }
//     }
// });





const app = new Vue({
    el: '#app',
    components: { App },
    router,
    store
});
