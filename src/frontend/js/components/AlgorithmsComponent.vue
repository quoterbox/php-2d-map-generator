<template>
    <div class="algorithms">
        <b-tabs pills class="algorithms__tabs" v-model="algorithmId">
            <b-tab :active="index === 0" v-for="(algorithm, index) in algorithms" :title="algorithm.title" :key="index">
                <div class="algorithms__desc">
                    <h4>Description</h4>
                    <p>{{ algorithm.desc }}</p>
                </div>
            </b-tab>
        </b-tabs>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                algorithms: [],
                algorithmName: '',
                algorithmId: 0,
            }
        },
        mounted() {
            this.getAlgorithms();
        },
        methods: {
            async getAlgorithms(){
                axios.get('/api/algorithms/').then((response) => {
                    this.algorithms = response.data;
                });
            },
            changeAlgorithm(){
                let algorithms = this.algorithms.filter(record => {
                    return this.algorithmId === record.id ? record : false;
                });

                if(algorithms.length){
                    this.algorithmName = algorithms.pop().name;
                }
            }
        },
        watch: {
            algorithmId() {

                this.changeAlgorithm();

                this.$store.commit('selectAlgorithm', {
                    name: this.algorithmName
                });
            }
        }
    }
</script>
