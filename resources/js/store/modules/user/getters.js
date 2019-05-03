export default {

    token: (state) => {
        return state.token;
    },

    refreshToken: (state) => {
        return state.refreshToken;
    },

    isLogged: (state) => {
        return !!state.token;
    }
}