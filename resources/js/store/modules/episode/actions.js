import axios from "axios";
import Router from "../../../api/Router";
import Constants from "../../../Constants";

export default {
    init: (context, identifier) => {
        let router = new Router();

        axios
            .get(
                router.route(
                    Constants.API_EPISODE_SHOW,
                    {"episode_id" : identifier}
                )
            )
            .then(({data}) => {
                context.commit("set", data);
            })
        ;
    },
}