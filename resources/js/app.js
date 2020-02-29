
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


import Vue from 'vue'
import router from "./routes.js";
import store from "./store.js";

import swal from "sweetalert";



axios.interceptors.response.use((response) => {
    var token = response.headers.authorization;
    if (token) {
        store.dispatch('refreshToken',{
            token:token
        });
    }
    return response;
});

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




// import App from './view/App'
// import Home from './view/Home'
// import Article from './view/Article'
// import Login from './view/layouts/Login'
// import Register from './view/layouts/Register'
// import Tag from './view/Tag'
// import Down from './view/Down'
// import Categories from './view/Categories'
// import HeadNav from './view/HeadNav'
// import Footer from './view/Footer'
// import NavCategory from './view/layouts/NavCategory'
// import Pagination from './view/Pagination'
// import Likes from './view/Likes'

/**
 * 注册组件
 */

Vue.component('Categories',require('./view/Categories.vue').default);
Vue.component('Home',require('./view/Home.vue').default);
Vue.component('HeadNav',require('./view/HeadNav.vue').default);
Vue.component('Footers',require('./view/Footer.vue').default);
Vue.component('NavCategory',require('./view/layouts/NavCategory.vue').default);
Vue.component('Pagination',require('./view/Pagination.vue').default);
Vue.component('Likes',require('./view/Likes.vue').default);



const app = new Vue({
    el: '#app',
    router,
    store,
});
// const app = new Vue({
//     // el: '#app',
//     // components: { App },
//     router,
//     store
// }).$mount('#app')
