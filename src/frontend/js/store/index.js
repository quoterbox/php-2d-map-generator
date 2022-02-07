import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        packName: '',
        algorithmName: '',
        mapWidth: 5,
        mapHeight: 5,

    },
    mutations: {
        selectPackName(state, payload){
            state.packName = payload.name;
        },
        selectAlgorithm(state, payload){
            state.algorithmName = payload.name;
        }
    },
    actions: {
        // async getAlgorithms(context){
        //     axios.get('/api/algorithms/').then((response) => {
        //         context.commit('loadAlgorithms', {
        //             algorithms: response.data
        //         })
        //     });
        // }
    }

})
