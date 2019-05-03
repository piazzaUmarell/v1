require("./bootstrap");

import Vue from "vue";
import Vuex from "vuex";
import 'es6-promise/auto';
import routes from "./routes";
import VueRouter from 'vue-router'
import storeDefinition from "./store/store";
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import UserAccessor from "./mixins/UserAccessor";

Vue.use(Vuex);
Vue.use(VueRouter);
Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.config.productionTip = false;


let router = new VueRouter({
    mode: 'history',
    routes
});

let store = new Vuex.Store(storeDefinition);

let app = new Vue({
    el: "#app",
    router,
    store,
    mixins:[UserAccessor],

    created() {
        setInterval(this.refreshLogin.bind(this), 15 * 60 * 1000)
    },

    methods: {
        refreshLogin() {
            if(!this.isLogged) return;
            this.$store.dispatch("user/refresh")
        }
    }
});