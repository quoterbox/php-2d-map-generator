<template>
    <div class="location-generator">
        <assets-component></assets-component>
        <algorithms-component></algorithms-component>
    </div>
</template>

<script>
    export default {
        data() {
            return {

            }
        },
        computed: {
            packName() {
                return this.$store.state.packName;
            }
        },
        mounted() {

        },
        methods: {

        },
        watch: {

        }
    }
</script>
