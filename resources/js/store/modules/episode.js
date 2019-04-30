import getters from "./episode/getters";
import actions from "./episode/actions";
import mutations from "./episode/mutations";

export default {
    namespaced: true,

    state: {
        episode: null,
        ready: false,
    },

    mutations,
    actions,
    getters
}