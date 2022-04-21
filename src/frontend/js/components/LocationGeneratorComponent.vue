<template>
    <div class="location-generator">
        <assets-component></assets-component>
        <algorithms-component></algorithms-component>
        <map-size-component></map-size-component>

        <div class="map-split-option">
            <b-form-checkbox v-model="divideMap" name="check-button" switch>divide the map into tiles</b-form-checkbox>
        </div>

        <div class="d-flex justify-content-center">
            <b-overlay :show="$store.state.generating" class="d-inline-block mt-3">
                <b-button :disabled="$store.state.generating" variant="secondary" @click="generateMap" class="generate-button">Generate</b-button>
            </b-overlay>
        </div>

        <map-view-component></map-view-component>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                divideMap: false,
            }
        },
        methods: {
            generateMap(){
                this.$store.dispatch('generateMap');
            }
        },
        watch: {
            divideMap() {
                this.$store.commit('changeDivideMapOption', {
                    value: this.divideMap
                });
            }
        }
    }
</script>
