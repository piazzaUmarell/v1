import getters from "./user/getters";
import mutations from "./user/mutations";
import actions from "./user/actions";

export default {
    namespaced: true,

    state: {
        token: '',
        refreshToken: '',
        object: {},
    },

    getters,
    mutations,
    actions
}