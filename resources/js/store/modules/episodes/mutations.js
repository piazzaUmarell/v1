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

        if(typeof state._links.self === "object" && state._links.self.hasOwnProperty('href')) {
            state._links.self.href = state._links.self.href.replace("%5B","[").replace("%5D","]");
        }

        if(typeof state._links.first === "object" &&state._links.first.hasOwnProperty('href')) {
            state._links.first.href = state._links.first.href.replace("%5B","[").replace("%5D","]");
        }

        if(typeof state._links.previous === "object" &&state._links.previous.hasOwnProperty('href')) {
            state._links.previous.href = state._links.previous.href.replace("%5B", "[").replace("%5D", "]");
        }

        if(typeof state._links.next === "object" && state._links.next.hasOwnProperty('href')) {
            state._links.next.href = state._links.next.href.replace("%5B","[").replace("%5D","]");
        }

        if(typeof state._links.last === "object" && state._links.last.hasOwnProperty('href')) {
            state._links.last.href = state._links.last.href.replace("%5B","[").replace("%5D","]");
        }

        state.currentPage = data.page;
        state.totalPages = data.pages;
    },

    applyKeywords: (state, keywords) => {
        state.keywords = keywords;
    }
}