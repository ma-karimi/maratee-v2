<template>
    <no-ssr>
        <div v-masonry transition-duration="0.3s" item-selector=".item" fit-width="true"  class="masonry-container">
            <div v-masonry-tile class="item m-2"  v-for="item in patterns">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" :src="item.imageMedium" :alt="item.title">
                    <div class="card-body">
                        <h5 class="card-title"><strong>{{ item.title }}</strong></h5>
                        <p class="card-text">{{ !_.isNull(item.description) ? item.description : '' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </no-ssr>
</template>


<script>
    import NoSSR from 'vue-no-ssr'

    export default {
        props: ['patternsData', 'pageData'],
        data() {
            return {
                'patterns':{}
            }
        },
        components: {
            'no-ssr': NoSSR
        },
        mounted() {
            if (typeof this.$redrawVueMasonry === 'function') {
                this.$redrawVueMasonry()
            }
            this.checkPatternsData()
        },
        created() {
            window.addEventListener('scroll', this.handleScroll);
        },
        methods: {
            checkPatternsData(){
                if(this.pageData == 'pattern'){
                    this.patterns = this.patternsData.data
                }else{
                    this.patterns = this.patternsData
                }
            },
            handleScroll() {
                let scrollHeight = window.scrollY
                let maxHeight = window.document.body.scrollHeight - window.document.documentElement.clientHeight


                if (scrollHeight >= maxHeight - 200) {
                    this.patterns
                }
            },
            smartTrim(string, maxLength) {
                var trimmedString = string.substr(0, maxLength);
                return trimmedString.substr(0, Math.min(trimmedString.length, trimmedString.lastIndexOf(" ")))
            }
        }
    }
</script>
<style>
    #test{
        width: 100px;
    }
</style>