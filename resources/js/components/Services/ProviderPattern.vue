<template>
    <div>
        <masonry
                :cols="{default: 3, 1000: 3, 700: 2, 400: 1}"
                :gutter="{default: '10px'}"
        >
            <div v-for="(item, index) in patternsData" :key="index" class="p-2">
                <div class="card">
                    <img class="card-img-top" :src="item.imageMedium" :alt="item.title">
                    <div class="card-body">
                        <h5 class="card-title"><strong>{{ item.title }}</strong></h5>
                        <p class="card-text">{{ !_.isNull(item.description) ? item.description : '' }}</p>
                    </div>
                </div>
            </div>
        </masonry>
    </div>
</template>

<script>
    import NoSSR from 'vue-no-ssr'

    export default {
        // name: "ProviderPattern",
        props: ['patternsData'],
        data() {
            return {
                'patterns': {}
            }
        },
        components: {
            'no-ssr': NoSSR
        },
        methods: {}
    }
</script>

<style scoped>

</style>