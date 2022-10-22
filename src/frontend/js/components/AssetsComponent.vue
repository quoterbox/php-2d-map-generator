<template>
    <div class="assets">
        <b-tabs pills class="assets__tabs" v-model="tabIndex">
            <b-tab :active="index === 0" v-for="(assetPack, index) in assetPacks" :title="assetPack.name" :key="index">
                <div class="assets__list">
                    <img v-lazy="asset.path" v-for="asset in assetPack.assets" :alt="asset.name" class="asset" :height="asset.height + 'px'" :width="asset.width + 'px'">
                </div>
                <div class="assets__desc desc">
                    <h4>Description</h4>
                    <p class="text">{{ assetPack.desc }}</p>
                </div>
                <div class="sample-map">
                    <h4>A sample map from this asset pack</h4>
                    <div class="wrap-image-map">
                        <img v-lazy="assetPack.sample_map_path" :alt="assetPack.name">
                    </div>
                </div>
            </b-tab>
        </b-tabs>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                assetPacks: [],
                tabIndex: 0,
            }
        },
        mounted() {
            this.getPacks();
        },
        methods: {
            async getPacks(){
                axios.get('/api/assets/').then((response) => {
                    this.assetPacks = response.data;
                    this.commitToStore();
                });
            },
            commitToStore(){

                console.log('commitToStore');

                this.$store.commit('selectPackName', {
                    name: this.assetPacks[this.tabIndex] ? this.assetPacks[this.tabIndex].name : ''
                });
            }
        },
        watch: {
            tabIndex() {
                this.commitToStore();
            }
        }
    }
</script>
