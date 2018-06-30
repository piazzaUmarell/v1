import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import infiniteScroll from 'vue-infinite-scroll'

require('mediaelement');
let Vue = require('vue');
var VueScrollTo = require('vue-scrollto');

Vue.use(VueScrollTo);
Vue.use(infiniteScroll)
Vue.component('font-awesome-icon', FontAwesomeIcon);
Vue.component('piazza-home', require('./components/PiazzaHome.vue'));

Vue.prototype.$ENV = ENV;

let app = new Vue({
    el: '#root',
})