<template>
    <div class="row">
        <div class="col-md-12">
            <b-card no-body>
                <b-tabs card>
                    <b-tab title="Asset Pack 1dddd" active>
                        <b-card-text>Tab contents 1</b-card-text>
                    </b-tab>
                    <b-tab title="Asset Pack 2">
                        <b-card-text>Tab contents 2</b-card-text>
                    </b-tab>
                </b-tabs>
            </b-card>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {


                priceRaw: "",
            }
        },
        computed: {
            priceFormatted(){
                return this.addMask(this.priceRaw);
            }
        },
        methods: {
            validateInput(e){

            },
            updateInput(value){

            },
            addMask(value){

            },
            removeMask(value){

            },
        }
    }
</script>
