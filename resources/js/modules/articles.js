/*
 |-------------------------------------------------------------------------------
 | VUEX modules/articles.js
 |-------------------------------------------------------------------------------
 | The Vuex data store for the articles
 */

import ArticlesAPI from '../api/articles.js';

export const articles = {
    /**
     * Defines the state being monitored for the module.
     */
    state: {
        articles: [],
        articlesLoadStatus: 0,

        article: {},
        articleLoadStatus: 0
    },
    /**
     * Defines the actions used to retrieve the data.
     */
    actions: {
        loadArticles( { commit } ){
            commit( 'setArticlesLoadStatus', 1 );

            ArticlesAPI.getArticles()
                .then( function( response ){
                    commit( 'setArticles', response.data );
                    commit( 'setArticlesLoadStatus', 2 );
                })
                .catch( function(){
                    commit( 'setArticles', [] );
                    commit( 'setArticlesLoadStatus', 3 );
                });
        },

        loadArticle( { commit }, data ){
            commit( 'setArticleLoadStatus', 1 );

            ArticlesAPI.getArticle( data.id )
                .then( function( response ){
                    commit( 'setArticle', response.data );
                    commit( 'setArticleLoadStatus', 2 );
                })
                .catch( function(){
                    commit( 'setArticle', {} );
                    commit( 'setArticleLoadStatus', 3 );
                });

        }
    },
    /**
     * Defines the mutations used
     */
    mutations: {
        setArticlesLoadStatus( state, status ){
            state.ArticlesLoadStatus = status;
        },

        setArticles( state, articles ){
            state.Articles = Articles;
        },

        setArticleLoadStatus( state, status ){
            state.ArticleStatus = status;
        },

        setArticle( state, Article ){
            state.article = article;
        }
    },
    /**
     * Defines the getters used by the module
     */
    getters: {
        getArticlesLoadStatus( state ){
            return state.ArticlesLoadStatus;
        },

        getArticles( state ){
            return state.articles;
        },

        getArticleLoadStatus( state ){
            return state.ArticleLoadStatus;
        },

        getArticle( state ){
            return state.Article;
        }
    }
};
