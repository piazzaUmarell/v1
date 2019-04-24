import getters from "./latestEpisode/getters";
import mutations from "./latestEpisode/mutations";
import actions from "./latestEpisode/actions";

export default {
    namespaced: true,

    state: {
        model: null,
        ready: false,
        _links: {
            self: '',
        },
    },
    getters,
    mutations,
    actions
}