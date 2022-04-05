<template>
    <div class="location-generator">
        <assets-component></assets-component>
        <algorithms-component></algorithms-component>
        <map-size-component></map-size-component>

        <div class="map-split-option">
            <b-form-checkbox v-model="divideMap" name="check-button" switch size="lg">divide the map into tiles</b-form-checkbox>
        </div>

        <b-overlay :show="$store.state.generating" rounded="sm">
            <div class="d-flex justify-content-center">
                <b-button variant="secondary" size="lg" @click="generateMap">Generate</b-button>
            </div>
        </b-overlay>

        <map-view-component v-if="showMap"></map-view-component>
        <div style="height: 200px;"></div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                divideMap: false,
                showMap: false
            }
        },
        methods: {
            generateMap(){
                this.$store.dispatch('generateMap');
            }
        },
        watch: {
            showMap(){
                if("meta" in this.$store.state.map && "mapOneFileImg" in this.$store.state.map.meta){

                }
            },
            divideMap() {
                this.$store.commit('changeDivideMapOption', {
                    value: this.divideMap
                });
            }
        }
    }
</script>
