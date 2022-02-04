<template>
    <div class="location-generator">
        <assets-component></assets-component>


        <b-form-group>
            <b-form-input
                :value="priceFormatted"
                @keydown="validateInput"
                @input="updateInput"
                placeholder="Введите число">
            </b-form-input>
        </b-form-group>
        <b-form-group>
            <b-button variant="success">Return raw text</b-button>
        </b-form-group>
        <div class="mt-2">Your text as is: {{ priceRaw }}</div>
        <div class="mt-2">Your text as is: {{ priceFormatted }}</div>
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
                if ( !/\d+/gi.test(e.key) ) {
                    e.preventDefault();
                }
            },
            updateInput(value){
                this.priceRaw = this.removeMask(value);
            },
            addMask(value){
                return new Intl.NumberFormat('ru-RU', { style: 'currency', currency: 'RUB', maximumFractionDigits: 0 }).format(value);
            },
            removeMask(value){
                return value.replace(/\D+/gi, "");
            },
        }
    }
</script>
