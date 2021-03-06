
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import VueChart from 'vue-chart-js';
window.Vue = require('vue');
Vue.use(VueChart);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('home', require('./components/Home.vue'));
Vue.component('nav-voting', require('./components/Nav.vue'));
Vue.component('polls', require('./components/Polls.vue'));
Vue.component('poll', require('./components/Poll.vue'));
Vue.component('profile', require('./components/Profile.vue'));

import { store } from './store'

const app = new Vue({
    el: '#app',
    store
});
