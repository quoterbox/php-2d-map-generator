<template>
    <div class="map-view">
        <div v-if="$store.getters.isMapVisible" class="one-file-map">
            <img :src="$store.state.map.meta.mapOneFileImg" alt="map">
        </div>
        <div v-if="$store.getters.isMapTilesVisible" class="tiles">
            <div v-for="row in $store.state.map.map.tiles" class="tiles__row">
                <img v-for="tile in row" :src="tile.img" alt="tile">
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
