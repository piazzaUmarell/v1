import axios from "axios";
import Router from "../../../api/Router";
import Constants from "../../../Constants";

export default {
    refresh: context => {
        let router = new Router();

        axios
            .get(router.route(Constants.API_LATEST_EPISODE_SHOW))
            .then(({data}) => {
                context.commit('refresh', data);
            })
    },

    init: context => {
        if(context.getters.ready) return;
        context.dispatch("refresh");
    }
}