
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

window.Vue = require('vue');
window.axios = require('axios');

import Moment from 'moment';
import { extendMoment } from 'moment-range';

window.moment = extendMoment(Moment);

Vue.component('plans-modal', require('./components/Modal.vue'));
Vue.component('plans-nav', require('./components/Nav.vue'));
Vue.component('nav-item', require('./components/NavItem.vue'));
Vue.component('media-textarea', require('./components/TextArea.vue'));
Vue.component('flash-message', require('./components/FlashMessage.vue'));

const nav = new Vue({
    el: '#nav'
});

const app = new Vue({
    el: '#global-vue'
});
