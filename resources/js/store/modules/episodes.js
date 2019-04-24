import getters from "./episodes/getters";
import actions from "./episodes/actions";
import mutations from "./episodes/mutations";

export default {
    namespaced: true,

    state: {
        collection: [],
        keywords: [],
        ready: false,
        _links: {
            self: '',
            first: '',
            previous: '',
            next: '',
            last: ''
        },
        currentPage: 1,
        totalPages: 1,
    },

    mutations,
    actions,
    getters
}