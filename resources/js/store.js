/**
 * 兼容IE11
 */
// require('es6-promise').polyfill();

import Vue from 'vue'
import Vuex from 'vuex'



Vue.use( Vuex );
import { users } from './modules/users'
import { categories } from './modules/categories'
import { articles } from './modules/articles'
import { likes } from './modules/likes'


export default new Vuex.Store({
    modules: {
        users,
        categories,
        articles,
        likes,
    }
});
