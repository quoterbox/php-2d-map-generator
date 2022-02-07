window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Vue from 'vue'

// Vuex

import store from './store'


// BootstrapVue

import { BootstrapVue } from 'bootstrap-vue'

Vue.use(BootstrapVue)

// import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
// Vue.use(BootstrapVue)
// Vue.use(IconsPlugin)

// import { TabsPlugin } from 'bootstrap-vue'
// Vue.use(TabsPlugin)





Vue.component('assets-component', require('./components/AssetsComponent.vue').default);
Vue.component('algorithms-component', require('./components/AlgorithmsComponent.vue').default);
Vue.component('location-generator-component', require('./components/LocationGeneratorComponent.vue').default);

const app = new Vue({
    el: '#app',
    store
});
