
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
Vue.component('media-textarea', require('./components/Textarea.vue'));
Vue.component('flash-message', require('./components/FlashMessage.vue'));

const app = new Vue({
    el: '#app',

    data: {
        is_burguer_open: false
    },

    methods: {
        toggleBurguer() {
            this.is_burguer_open = !this.is_burguer_open
        }
    }
});
