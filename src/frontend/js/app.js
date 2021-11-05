import Vue from 'vue'

import { BootstrapVue } from 'bootstrap-vue'
Vue.use(BootstrapVue)

// import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
// Vue.use(BootstrapVue)
// Vue.use(IconsPlugin)

Vue.component('assets', require('./components/AssetsComponent.vue').default);
Vue.component('location-generator', require('./components/LocationGeneratorComponent.vue').default);

const app = new Vue({
    el: '#app',
});
