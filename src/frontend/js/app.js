window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Vue from 'vue'
import VueLazyload from 'vue-lazyload'
Vue.use(VueLazyload)

// Storage with Vuex
import store from './store'

// BootstrapVue
import { BootstrapVue } from 'bootstrap-vue'
Vue.use(BootstrapVue)

// Components
Vue.component('assets-component', require('./components/AssetsComponent.vue').default);
Vue.component('algorithms-component', require('./components/AlgorithmsComponent.vue').default);
Vue.component('map-size-component', require('./components/MapSizeComponent.vue').default);
Vue.component('location-generator-component', require('./components/LocationGeneratorComponent.vue').default);
Vue.component('map-view-component', require('./components/MapViewComponent.vue').default);

const app = new Vue({
    el: '#app',
    store
});
