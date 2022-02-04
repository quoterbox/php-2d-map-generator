<template>
    <div class="location-generator">
        <assets-component></assets-component>


        <div class="mt-2">Name pack assets from Location Generator Main Component: {{ packName }}</div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                someVar: "",
            }
        },
        computed: {
            packName() {
                return this.$store.state.selectedPackName;
            }
        },
        methods: {

        }
    }
</script>
