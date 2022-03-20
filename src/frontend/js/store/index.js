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
            divideMapIntoTiles: false,
        },
        map: {
            oneFile: {
                src: ''
            },
            manyFiles: []
        }
    },
    mutations: {

        selectPackName(state, payload){
            state.mapProps.packName = payload.name;

            console.log(state.mapProps.packName);
            console.log(state.mapProps.algorithmName);
            console.log(state.mapProps.mapWidth);
            console.log(state.mapProps.mapHeight);
            console.log(state.mapProps.divideMapIntoTiles);
        },
        selectAlgorithm(state, payload){
            state.mapProps.algorithmName = payload.name;

            console.log(state.mapProps.algorithmName);
        },
        changeMapWidth(state, payload){
            state.mapProps.mapWidth = payload.value;

            console.log(state.mapProps.mapWidth);
        },
        changeMapHeight(state, payload){
            state.mapProps.mapHeight = payload.value;

            console.log(state.mapProps.mapHeight);
        },
        changeDivideMapOption(state, payload){
            state.mapProps.divideMapIntoTiles = payload.value;

            console.log(state.mapProps.divideMapIntoTiles);
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

            if(state.mapProps.divideMapIntoTiles){
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
                data: state.mapProps
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
