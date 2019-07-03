<template>
    <div class="select-wrap">
        <select name="take">
            <option value="12">12 مورد</option>
            <option value="24">24 مورد</option>
            <option value="48">48 مورد</option>
        </select>
        <span class="icon-arrow-down"></span>
    </div>
</template>

<script>
    export default {
        props: ['params'],
        data() {
            return {
                take: null
            }
        },
        created: function () {
            this.fetchTips();
        },

        methods: {
            fetchTips() {
                let params = this.params;
                this.take = _.has(params, 'take') ? params.take : null;
            }

        }
    };
</script>
