import axios from "axios";

export default {
    refresh: context => {
        axios
            .get(context.getters.currentPageUrl)
                .then(({data}) => {
                    context.commit('refresh', data);
                })
    },

    first: context => {
        axios.get(context.getters.firstPageUrl)
            .then(({data}) => {
                context.commit('refresh', data);
            })
    },

    last: context => {
        axios.get(context.getters.lastPageUrl)
            .then(({data}) => {
                context.commit('refresh', data);
            })
    },

    next: context => {
        axios.get(context.getters.nextPageUrl)
            .then(({data}) => {
                context.commit('refresh', data);
            })
    },

    previous: context => {
        axios.get(context.getters.previousPageUrl)
            .then(({data}) => {
                context.commit('refresh', data);
            })
    },

    page: (context, page) => {
        axios.get(context.getters.urlForPage(page))
            .then(({data}) => {
                context.commit('refresh', data);
            })
    },

    init: context => {
        if(context.getters.ready) return;
        axios
            .get(context.getters.currentPageUrl)
            .then(({data}) => {
                context.commit('refresh', data);
            })
    }
}