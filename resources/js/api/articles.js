import {ROAST_CONFIG} from '../config.js';
import SimpleMDE from 'simplemde'
import hljs from 'highlight.js'


export default {
    getArticles: function (page,pageSize) {
        return axios.get(ROAST_CONFIG.API_URL + '/articles' + '?page=' + page+'&pageSize='+pageSize, {

        });
    },
    getArticle: function (id, slug) {

        return axios.get(ROAST_CONFIG.API_URL + '/article/' + id + '/' + slug,{})
    }
}
