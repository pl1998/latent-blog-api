import {ROAST_CONFIG} from '../config.js';



export default {
    getLikes: function () {
        return axios.get(ROAST_CONFIG.API_URL + '/likes', {

        });
    },
    addLikes: function (like) {
        return axios.post(ROAST_CONFIG.API_URL + '/likes',like)
    }
}
