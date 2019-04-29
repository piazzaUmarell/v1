import axios from "axios";
import Router from "../../../api/Router";
import Constants from "../../../Constants";
import KeywordCollection from "../../../api/KeywordCollection";

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
        let router = new Router();
        let route = router.route(
            Constants.API_EPISODE_INDEX,
            {
                page,
                filter: context.getters.keywords
            }
        );

        axios.get(route)
            .then(({data}) => {
                context.commit('refresh', data);
            })
    },

    filter: (context) => {
        let router = new Router();
        let route = router.route(
            Constants.API_EPISODE_INDEX,
            {filter: context.getters.keywords}
        );

        axios.get(route)
            .then(({data}) => {
                context.commit('refresh', data);
            });
    },

    applyKeywords: (context, keywords) => {
        if(typeof keywords === "string") {
            keywords = new KeywordCollection(keywords)
        }
        if(!keywords instanceof KeywordCollection) {
            throw new Error("Invalid keywords passed");
        }
        context.commit("applyKeywords", keywords);
        context.dispatch("filter");
    },

    init: (context, startingPage) => {
        if(context.getters.ready) return;
        startingPage = startingPage ? startingPage : 1;
        let router = new Router();
        axios
            .get(router.route(Constants.API_EPISODE_INDEX, {page: startingPage}))
            .then(({data}) => {
                context.commit('refresh', data);
            })
    }
}