/*
 |-------------------------------------------------------------------------------
 | VUEX modules/articles.js
 |-------------------------------------------------------------------------------
 | The Vuex data store for the articles
 */

import LikesApi from '../api/likes.js';


export const likes = {
    /**
     * Defines the state being monitored for the module.
     */
    state: {
        likes: {},
        likesLoadStatus: 0,
    },
    /**
     * Defines the actions used to retrieve the data.
     */
    actions: {
        loadLikes( { commit } ){
            commit( 'setLikesLoadStatus', 1 );
            LikesApi.getLikes()
                .then( function( response ){
                    commit( 'setLikes', response.data );
                    commit( 'setLikesLoadStatus', 2 );
                })
                .catch( function(){
                    commit( 'setLikes', [] );
                    commit( 'setLikesLoadStatus', 3 );
                });
        },

    },
    /**
     * Defines the mutations used
     */
    mutations: {
        setLikesLoadStatus( state, status ){
            state.likesLoadStatus = status;
        },

        setLikes( state, likes ){
            state.likes = likes;
        },

    },
    /**
     * Defines the getters used by the module
     */
    getters: {
        getLikesLoadStatus( state ){
            return state.likesLoadStatus;
        },
        getLikes( state ){
            return state.likes;
        },

    }
};
