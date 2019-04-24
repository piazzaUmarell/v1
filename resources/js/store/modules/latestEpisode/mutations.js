import Episode from "../../../model/Episode";

export default {
    refresh: (state, data) => {
        state.ready = true;
        state.model = new Episode(data);
        state._links._self = data._links._self;
    },
}