import { LATENTAPI } from '../config.js';



export default {
    getCategories:function () {
        return axios.get(LATENTAPI.API_URL+'/categories',{

        });
    },

}
