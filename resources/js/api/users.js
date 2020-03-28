//postSignInByOauth

import {ROAST_CONFIG} from '../config.js';



export default {
    postSignInByOauth: function (token) {
        axios.defaults.headers.common['Authorization'] = token;
        return axios.get(ROAST_CONFIG.API_URL + '/user', {
        });
    },
    //authorizations
    deleteSignInByOauth: function (token) {
        axios.defaults.headers.common['Authorization'] = token;
        return axios.delete(ROAST_CONFIG.API_URL + '/authorizations', {
        });
    },

}
