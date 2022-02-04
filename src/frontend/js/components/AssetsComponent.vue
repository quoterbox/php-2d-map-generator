<template>
    <div class="assets">
        <b-tabs pills class="assets__tabs" v-model="tabIndex">
            <b-tab :active="index === 0" v-for="(assetPack, index) in assetPacks" :title="assetPack.name" :key="index">
                <div class="assets__list">
                    <img v-for="asset in assetPack.assets" :src="asset.path" :alt="asset.name">
                </div>
                <div class="assets__desc">
                    <h4>Description</h4>
                    <p>{{ assetPack.desc }}</p>
                </div>
            </b-tab>
        </b-tabs>
        Selected pack: {{ selectedPackName }} right now nn
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
        computed: {
            selectedPackName(){
                return this.assetPacks[this.tabIndex] ? this.assetPacks[this.tabIndex].name : '';
            }
        },
        mounted() {
            this.getPacks();
        },
        methods: {
            getPacks(){
                axios.get('/api/assets/').then((response) => {
                    this.assetPacks = response.data;
                });
            },
        }
    }
</script>
