/*
|-------------------------------------------------------------------------------
| VUEX modules/users.js
|-------------------------------------------------------------------------------
| The Vuex data store for the Users
*/

import UserAPI from '../api/users';

/**
 status = 0 -> 数据尚未加载
 status = 1 -> 数据开始加载
 status = 2 -> 数据加载成功
 status = 3 -> 数据加载失败
 */

export const users = {
    state: {
        //登录状态
        loginStatus:0,
        loginErrors:'',
        // 存储token
        Authorization: localStorage.getItem('Authorization') ? localStorage.getItem('Authorization') : '',
        user: {
            data:{
                id:2,
                name:'latent',
                email:null,
                avatar:'',
                bound_oauth:'github',
                created_at:'2020-03-13 21:26:11',
                updated_at:'2020-03-13 21:26:11',
                introduction:'',
            }
        },
        userLoadStatus:0,
        logoutStatus:0,
        userProfileUpdateStatus:'',
        userProfileUpdateMessages:'',
        other:'',
        otherLoadStatus:'',
    },
    actions: {
        // login({commit},data){
        //     commit('setLoginStatus',1);
        //     UserAPI.postSignUp( data.username,data.password)
        //         .then(function ( response ) {
        //             commit('setUser' , response.data);
        //             commit('setUserLoadStatus',2);
        //             commit('setLoginToken','Bearer ' + response.data.meta.access_token);
        //             commit('setLoginStatus' , 2);
        //         })
        //         .catch(function (error) {
        //             commit('setUser' ,'');
        //             commit('setUserLoadStatus',3);
        //             commit('setLoginStatus',3);
        //             commit('setLoginErrors',error.response.data.message !== '' ? error.response.data.message: '未知错误');
        //         })
        // },

        loginByOauth({commit}){
            commit('setLoginStatus',1);
            UserAPI.postSignInByOauth(store.Authorization)
                console.log(11)
                console.log(store.Authorization)
                .then(function ( response ) {
                    commit('setLoginToken','Bearer ' + store.Authorization);
                    commit('setUser' , response.data);
                    commit('setUserLoadStatus',2);
                    commit('setLoginStatus' , 2);
                })
                .catch(function (error) {
                    localStorage.removeItem('Authorization');
                    commit('setLoginToken','');
                    commit('setUser' ,'');
                    commit('setLoginStatus',3);
                    commit('setUserLoadStatus',3);
                    commit('setLoginErrors',error.response.data.message !== '' ? error.response.data.message: '未知错误');
                });
        },
        loadUser({commit}){
            commit('setUserLoadStatus',1);
            UserAPI.getLoadUser()
                .then(function (response) {
                    commit('setUserLoadStatus',2);
                    commit('setUser' , response.data.data);
                })
                .catch(function (error) {

                    localStorage.removeItem('Authorization');
                    commit('setLoginToken','');

                    commit('setUser' ,'');
                    commit('setUserLoadStatus',3);
                });
        },
        loadOther({commit},data){
            commit('setOtherLoadStatus',1);
            UserAPI.getLoadOther(data)
                .then(function (response) {
                    if(response.data.data !== ''){
                        commit('setOtherLoadStatus',2);
                        commit('setOther' , response.data.data);
                    }
                    else{
                        commit('setOtherLoadStatus',3);
                    }
                })
                .catch(function (error){
                    commit('setOther' ,'');
                    commit('setOtherLoadStatus',3);
                });
        },
        logout({commit,dispatch}){
            commit('setLogoutStatus',1);
            try {
                localStorage.removeItem('Authorization');
                commit('setLoginToken', '');
                dispatch('loadUser');
                commit('setLogoutStatus', 2);
                commit('setLoginStatus',0);
            }catch (e) {
                commit('setLogoutStatus', 3);
            }
        },

        refreshToken({commit},data){
            commit('setLoginToken', data.token);
        }
    },
    mutations:{
        setLoginStatus(state , status){
            state.loginStatus = status;
        },
        setLogoutStatus(state , status){
            state.logoutStatus = status;
        },
        setLoginErrors(state , status){
            state.loginErrors = status;
        },
        // 修改token，并将token存入localStorage
        setLoginToken (state, access_token) {
            state.Authorization = access_token;
            localStorage.setItem('Authorization', access_token);
        },
        setUser (state, data) {
            state.user = data;
        },
        setUserLoadStatus(state,status){
            state.userLoadStatus = status;
        },
        setOther (state, data) {
            state.other = data;
        },
        setOtherLoadStatus(state,status){
            state.otherLoadStatus = status;
        },
        setUserProfileUpdateStatus(state,status){
            state.userProfileUpdateStatus = status;
        } ,
        setUserProfileUpdateMessages(state,error){
            state.userProfileUpdateMessages = error;
        },
    },
    getters:{

        getLoginStatus( state ){
            return function () {
                return state.loginStatus;
            }
        },
        getLoginErrors(state ){
            return function () {
                return state.loginErrors;
            }
        },
        getLoginToken( state ){
            return state.Authorization;
        },
        getUser(state){
            return state.user;
        },
        getUserLoadStatus(state){
            return function(){
                return state.userLoadStatus;
            }
        },
        getOther(state){
            return state.other;
        },
        getOtherLoadStatus(state){
            return state.otherLoadStatus;
        },
        getUserProfileUpdateStatus(state){
            return function() {
                return state.userProfileUpdateStatus;
            }
        } ,
        getUserProfileUpdateMessages(state){
            return function() {
                return state.userProfileUpdateMessages;
            }
        },
        getLogoutStatus(state){
            return state.logoutStatus;
        }
    }
};
