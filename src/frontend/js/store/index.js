import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        mapProps: {
            packName: '',
            algorithmName: '',
            mapWidth: 0,
            mapHeight: 0,
        },
        map: {},
        divideMapIntoTiles: false,
        generating: false,
    },
    mutations: {
        selectPackName(state, payload){
            state.mapProps.packName = payload.name;
        },
        selectAlgorithm(state, payload){
            state.mapProps.algorithmName = payload.name;
        },
        changeMapWidth(state, payload){
            state.mapProps.mapWidth = payload.value;
        },
        changeMapHeight(state, payload){
            state.mapProps.mapHeight = payload.value;
        },
        changeDivideMapOption(state, payload){
            state.divideMapIntoTiles = payload.value;
        },
        loadMap(state, payload){
            state.map = payload.map;
        }
    },
    actions: {
        async generateMap({ commit, state }){

            state.generating = true;
            let requestUrl = '/api/map-one-file/';

            if(state.divideMapIntoTiles){
                requestUrl = '/api/map-many-files/';
            }

            console.log('state:');
            console.log(state);

            axios({
                method: 'post',
                url: requestUrl,
                data: state.mapProps
            }).then((response) => {
                commit('loadMap', {
                    map: response.data
                });
                state.generating = false;
            });
        }
    }
})
