import Episode from "../../../model/Episode";

export default {
    set: (state, episode) => {
        state.episode = new Episode(episode);
    },
}