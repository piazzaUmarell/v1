import jwtDecoder from "jwt-decode";
import Constants from "../../../Constants";

export default {
    login: (state, data) => {
        state.token = data.token;
        state.refreshToken = data.refresh_token;
        if(Constants.DEVELOPMENT_MODE) {
            window.localStorage.setItem(Constants.LOCAL_REFRESH_TOKEN, data.refresh_token);
        }
        if(data.token) {
            state.object = jwtDecoder(data.token);
        }
    },

    logout: (state) => {
        state.token = null;
        state.refresh = null;

        if(Constants.DEVELOPMENT_MODE) {
            window.localStorage.removeItem(Constants.LOCAL_REFRESH_TOKEN);
        }
    }
}