/*
 |-------------------------------------------------------------------------------
 | VUEX modules/articles.js
 |-------------------------------------------------------------------------------
 | The Vuex data store for the articles
 */

import ArticlesAPI from '../api/articles.js';
import SimpleMDE from 'simplemde'


export const articles = {
    /**
     * Defines the state being monitored for the module.
     */
    state: {
        articles: {},
        total:0,
        articlesLoadStatus: 0,
        pageSize:10,
        article: {},
        articleLoadStatus: 0
    },
    /**
     * Defines the actions used to retrieve the data.
     */
    actions: {
        loadArticles( { commit },page ){
            commit( 'setArticlesLoadStatus', 1 );

            ArticlesAPI.getArticles(page,10)
                .then( function( response ){
                    commit( 'setArticles', response.data );
                    commit( 'setTotal', response.data.total );
                    commit( 'setPageSize', response.data.per_page);
                    commit( 'setArticlesLoadStatus', 2 );
                })
                .catch( function(){
                    commit( 'setArticles', [] );
                    commit( 'setArticlesLoadStatus', 3 );
                });
        },

        loadArticle( { commit }, data ){
            commit( 'setArticleLoadStatus', 1 );
            ArticlesAPI.getArticle(data.id,data.slug)
                .then( function( response ){
                    const article = response.data;
                    article.content = SimpleMDE.prototype.markdown(article.content)
                    commit( 'setArticle',article);
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
            state.articlesLoadStatus = status;
        },

        setArticles( state, articles ){
            state.articles = articles;
        },
        setTotal(state,total) {
            state.total = total
        },
        setPageSize(state,pageSize) {
            state.pageSize = pageSize
        },

        setArticleLoadStatus( state, status ){

            state.articleLoadStatus = status;
        },
        setArticle( state, article ){

            state.article = article;
        }
    },
    /**
     * Defines the getters used by the module
     */
    getters: {
        getArticlesLoadStatus( state ){
            return state.articlesLoadStatus;
        },
        getArticles( state ){
            return state.articles;
        },
        getTotal( state ){
            return state.total;
        },
        getPageSize( state ){
            return state.pageSize;
        },
        getArticleLoadStatus( state ){
            return state.articleLoadStatus;
        },
        getArticle(state){
            return state.article;
        }
    }
};
