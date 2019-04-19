import Episode from "../../../model/Episode";

export default {
    refresh: (state, data) => {
        state.collection = data._embedded.episodes.map(
            (episode) => {
                return new Episode(episode);
            }
        );
        state._links.self = data._links.self;
        state._links.first = data._links.first;
        state._links.previous = data._links.previous;
        state._links.next = data._links.next;
        state._links.last = data._links.last;
        state.currentPage = data.page;
        state.totalPages = data.pages;
    }
}