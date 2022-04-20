<template>
    <div class="map-view">
        <h3 v-if="$store.getters.isMapVisible || $store.getters.isMapTilesVisible" class="map-view__title">Your own map</h3>
        <div v-if="$store.getters.isMapVisible" class="one-file-map">
            <img :src="$store.state.map.meta.mapOneFileImg + '?' + Date.now()" alt="map">
        </div>
        <div v-if="$store.getters.isMapTilesVisible" class="map-view__tiles">
            <div v-for="row in $store.state.map.map.tiles" class="tiles__row">
                <div class="tile" v-for="tile in row">
                    <img  :src="tile.img + '?' + Date.now()" alt="tile">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {

            }
        },
        mounted() {

        },
        methods: {

        },
        watch: {

        }
    }
</script>
