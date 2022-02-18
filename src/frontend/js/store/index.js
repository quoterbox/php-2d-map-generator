import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        packName: '',
        algorithmName: '',
        mapWidth: 0,
        mapHeight: 0,
        divideMapIntoTiles: false
    },
    mutations: {
        selectPackName(state, payload){
            state.packName = payload.name;
        },
        selectAlgorithm(state, payload){
            state.algorithmName = payload.name;
        },
        changeMapWidth(state, payload){
            state.mapWidth = payload.value;
            console.log(state.mapWidth);
        },
        changeMapHeight(state, payload){
            state.mapHeight = payload.value;
            console.log(state.mapHeight);
        },
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
