import axios from "axios";
import Router from "../../../api/Router";
import Constants from "../../../Constants";

export default {
    login: (context, data) => {
        let router = new Router();

        return new Promise((resolve, reject) => {
            axios.post(
                router.route(Constants.API_ADMIN_BACK_OFFICE_LOGIN),
                data,
                {
                    headers: {
                        'Content-Type': "application/json"
                    }
                }
            )
                .then((response) => {
                    context.commit('login', response.data);
                    if(resolve) {
                        resolve(response);
                    }
                })
                .catch(error => {
                    context.commit('logout', null);
                    if(reject) {
                        reject(error);
                    }
                });
        });
    },

    init: (context) => {
        console.log(context);
        if(context.getters.isLogged || !Constants.DEVELOPMENT_MODE) return;
        return context.dispatch("refresh");

    },

    refresh: (context) => {
        let router = new Router();
        let refresh_token = context.getters.refreshToken;
        refresh_token = refresh_token ? refresh_token : window.localStorage.getItem(Constants.LOCAL_REFRESH_TOKEN);

        if((!Constants.DEVELOPMENT_MODE && !context.getters.isLogged) || !refresh_token ) return null;

        return new Promise(((resolve, reject) => {
            axios.post(
                router.route(Constants.API_ADMIN_BACK_OFFICE_REFRESH_TOKEN),
                {refresh_token},
                {
                    headers: {
                        'Content-Type': "application/json"
                    }
                }
            )
                .then((response) => {
                    context.commit('login', response.data);
                    resolve(response)
                })
                .catch(error => {
                    context.commit('logout', null);
                    reject(error);
                })
        }));
    },

    logout: (context) => {
        this.commit('logout');
    },
}