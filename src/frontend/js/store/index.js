import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        selectedPackName: ''
    },
    mutations: {
        selectPack(state, payload){
            state.selectedPackName = payload.name;

            console.log('Store -> mutations -> selectPack');
            console.log(state.selectedPackName);
        }
    }
})
