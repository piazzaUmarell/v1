import Router from "../../../api/Router";
import Constants from "../../../Constants";

export default {

    ready: (state) => {
        return state.ready;
    },

    episodes: (state) => {
        return state.collection;
    },

    isFirstPage: state => {
        return state.currentPage === 1;
    },

    isLastPage: state => {
        return state.currentPage === state.totalPages;
    },

    currentPage: state => {
        return state.currentPage;
    },

    lastPage: state => {
        return state.totalPages;
    },

    keywords: state => {
        return state.keywords;
    },

    latestEpisode: (state) => {
        if(state.collection.length === 0) {
            return null;
        }

        let latestEpisode = state.collection[0];

        for(let i = 1; i < state.collection.length; i++) {
            let episode = state.collection[i];
            if(!latestEpisode.isPublishedAfter(episode)) {
                latestEpisode = episode;
            }
        }
        return latestEpisode;
    },

    currentPageUrl: (state) => {
        let router = new Router();
        let defaultRoute = router.route(Constants.API_EPISODE_INDEX, {filter: state.keywords});
        return state._links.self !== '' ? state._links.self.href : defaultRoute;
    },

    firstPageUrl: (state) => {
        let router = new Router();
        let defaultRoute = router.route(Constants.API_EPISODE_INDEX, {filter: state.keywords});
        return state._links.first !== '' ? state._links.first.href : defaultRoute;
    },

    lastPageUrl: (state) => {
        let router = new Router();
        let defaultRoute = router.route(Constants.API_EPISODE_INDEX, {filter: state.keywords});
        return state._links.last !== '' ? state._links.last.href : defaultRoute;
    },

    previousPageUrl: (state) => {
        let router = new Router();
        let defaultRoute = router.route(Constants.API_EPISODE_INDEX, {filter: state.keywords});
        if(state.currentPage === 1) return state._links.first !== '' ? state._links.first.href : defaultRoute;
        return state._links.previous !== '' ? state._links.previous.href : defaultRoute;
    },

    nextPageUrl: (state) => {
        let router = new Router();
        let defaultRoute = router.route(Constants.API_EPISODE_INDEX, {filter: state.keywords});
        if(state.currentPage === state.totalPages) return state._links.self !== '' ? state._links.self.href : defaultRoute;
        return state._links.next !== '' ? state._links.next.href : defaultRoute;
    }

}