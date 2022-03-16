import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        packName: '',
        algorithmName: '',
        mapWidth: 0,
        mapHeight: 0,
        divideMapIntoTiles: false,
        map: {
            oneFile: {
                src: ''
            },
            manyFiles: []
        }
    },
    mutations: {

        selectPackName(state, payload){
            state.packName = payload.name;

            console.log(state.packName);
            console.log(state.algorithmName);
            console.log(state.mapWidth);
            console.log(state.mapHeight);
            console.log(state.divideMapIntoTiles);
        },
        selectAlgorithm(state, payload){
            state.algorithmName = payload.name;

            console.log(state.algorithmName);
        },
        changeMapWidth(state, payload){
            state.mapWidth = payload.value;

            console.log(state.mapWidth);
        },
        changeMapHeight(state, payload){
            state.mapHeight = payload.value;

            console.log(state.mapHeight);
        },
        changeDivideMapOption(state, payload){
            state.divideMapIntoTiles = payload.value;

            console.log(state.divideMapIntoTiles);
        },
        loadMap(state, payload){

            console.log('Start -> Index.js -> mutations -> loadMap');

            state.map = payload.map;

            console.log(state.map);
        }
    },
    actions: {

        async generateMap({ commit, state }){

            console.log('Start -> Index.js -> actions -> generateMap');


            let requestUrl = '/api/map-one-file/';

            if(state.divideMapIntoTiles){
                requestUrl = '/api/map-many-files/';
            }

            console.log('state:');
            console.log(state);



            axios({
                method: 'post',
                // headers: {
                //     'Content-Type': 'application/x-www-form-urlencoded'
                // },
                url: requestUrl,
                // data: 'title=new_title&body=new_body&userId=userid'
                // params: {
                //     title: 'new_title',
                //     body: 'new_body',
                //     userId: 'userid'
                // },
                data: state
                // data: {
                //     title: 'new_title',
                //     body: 'new_body',
                //     userId: 'userid'
                // },
            }).then((response) => {
                commit('loadMap', {
                    map: response.data
                })
            });


            // axios.post(requestUrl, {
            //     firstName: 'Fred',
            //     lastName: 'Flintstone'
            // }, '').then((response) => {
            //     commit('loadMap', {
            //         map: response.data
            //     })
            // });

        }

    }

})
