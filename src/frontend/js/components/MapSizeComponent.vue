<template>
    <div class="map-size">
        <div class="row">
            <div class="col-md-6 mt-3 mt-md-0">
                <div class="row">
                    <div class="col-md-3">
                        <b-form-input v-model="width" id="input-width" size="sm" :formatter="formatter" :lazy-formatter="true" @keyup="filterNum($event)"></b-form-input>
                    </div>
                    <div class="col-md-9">
                        <label for="input-width" class="map-size__title">map width</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-8">
                        <input v-model="width" type="range" :min="min" :max="max" step="1" class="range">
                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-5 mt-md-0">
                <div class="row">
                    <div class="col-md-3">
                        <b-form-input v-model="height" id="input-height" size="sm" :formatter="formatter" :lazy-formatter="true" @keyup="filterNum($event)"></b-form-input>
                    </div>
                    <div class="col-md-9">
                        <label for="input-height" class="map-size__title">map height</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-8">
                        <input v-model="height" type="range" :min="min" :max="max" step="1" class="range">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                width: 5,
                height: 5,
                min: 2,
                max: 10,
            }
        },
        mounted() {
            this.changeWidth();
            this.changeHeight();
        },
        methods: {
            filterNum(event){
                event.target.value = event.target.value.replace(new RegExp(/[^0-9]/), '');
            },
            formatter(value){
                value = parseInt(value);

                if(isNaN(value)){
                    value = this.min;
                }else if(value > this.max){
                    value = this.max;
                }else if(value < this.min){
                    value = this.min;
                }

                return value;
            },
            changeWidth(){
                this.$store.commit('changeMapWidth', {
                    value: this.width
                });
            },
            changeHeight(){
                this.$store.commit('changeMapHeight', {
                    value: this.height
                });
            },
        },
        watch: {
            width() {
                this.changeWidth();
            },
            height() {
                this.changeHeight();
            },
        }
    }
</script>
