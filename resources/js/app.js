import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
require('mediaelement');
let Vue = require('vue');
var VueScrollTo = require('vue-scrollto');

Vue.use(VueScrollTo);
Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('piazza-home', require('./components/PiazzaHome.vue'));

let app = new Vue({
    el: '#root',
})