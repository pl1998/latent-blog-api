import { LATENTAPI } from '../config.js';



export default {
    getArticles:function (page) {
        return axios.get(LATENTAPI.API_URL+'/getArticleList'+'?page='+page,{

        });
    },
    getArticle:function (id,slug) {
        return axios.get(LATENTAPI.API_URL+'/article/'+id+'/'+slug,{

        });
    }
}
