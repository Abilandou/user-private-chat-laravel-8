
require('./bootstrap');

window.Vue = require('vue');
import Vuex from 'vuex';
import storeVuex from './store/index';
// import filter from './filter';

Vue.use(Vuex);

const store = new Vuex.Store(storeVuex);

window.moment = require('moment');
import Vue from 'vue'

import VueChatScroll from 'vue-chat-scroll'
Vue.use(VueChatScroll)

Vue.component('main-app', require('./components/MainApp.vue').default);

const app = new Vue({
    el: '#app',
    store
});

