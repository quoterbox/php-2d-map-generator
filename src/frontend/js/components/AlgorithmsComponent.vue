<template>
    <div class="algorithms">
        <h3 class="algorithms__title">Algorithm</h3>
        <b-tabs pills class="algorithms__tabs" v-model="algorithmId">
            <b-tab :active="algorithm.id === 0" v-for="(algorithm, index) in algorithms" :title="algorithm.title" :key="index">
                <div class="algorithms__desc desc">
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
                algorithms: [
                    {id: 0, name: "", title: "", desc: ""}
                ],
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
                    this.changeAlgorithm();
                    this.commitToStore();
                });
            },
            changeAlgorithm(){
                let algorithm = this.algorithms.find(record => this.algorithmId === record.id);

                if(algorithm){
                    this.algorithmName = algorithm.name;
                }
            },
            commitToStore(){
                this.$store.commit('selectAlgorithm', {
                    name: this.algorithmName
                });
            }
        },
        watch: {
            algorithmId() {
                if(this.algorithmName){
                    this.changeAlgorithm();
                    this.commitToStore();
                }
            }
        }
    }
</script>
