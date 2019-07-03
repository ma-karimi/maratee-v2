<template>
    <no-ssr>
        <form :action="url" method="get" class="filter-bar" ref="form" @change="formOnChange">
            <div class="filter__option filter--dropdown">
                <a href="#" id="drop1" class="dropdown-trigger dropdown-toggle" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">سرویس ها
                    <span class="icon-arrow-down"></span>
                </a>
                <ul class="custom_dropdown custom_drop2 dropdown-menu" aria-labelledby="drop1">
                    <li v-for="service in servicesData">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" v-model="services"
                                   :id="'service'+service.id" :value="service.id" name="services[]"
                                   :checked="_.includes(services, service.id)" class="custom-control-input">
                            <label class="custom-control-label" :for="'service'+service.id">{{service.name}}</label>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- end /.filter__option -->

            <div class="filter__option filter--dropdown">
                <a href="#" id="drop2" class="dropdown-trigger dropdown-toggle" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">فیلتر بر اساس
                    <span class="icon-arrow-down"></span>
                </a>
                <ul class="custom_dropdown dropdown-menu" aria-labelledby="drop2">
                    <li>
                        <input type="checkbox" v-model="created_at"
                               id="created_at_desc" name="created_at" value="desc" :true-value="'desc'"
                               :false-value="null"
                               :checked="created_at" class="custom-control-input">
                        <label class="custom-control-label" for="created_at_desc">جدیدترین</label>
                    </li>
                    <li>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" v-model="created_at"
                                   id="created_at_asc" name="created_at" value="asc" :true-value="'asc'"
                                   :false-value="null"
                                   :checked="created_at" class="custom-control-input">
                            <label class="custom-control-label" for="created_at_asc">قدیمی ترین</label>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- end /.filter__option -->

            <div class="filter__option filter--dropdown">
                <a href="#" id="drop3" class="dropdown-trigger dropdown-toggle" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">{{takeCheck()}}
                    <span class="icon-arrow-down"></span>
                </a>
                <ul class="custom_dropdown custom_drop2 dropdown-menu" aria-labelledby="drop3">
                    <li v-for="item in takes">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" v-model="take"
                                   :id="'take'+item" :value="item" name="take"
                                   :true-value="item" :false-value="null"
                                   :checked="take" class="custom-control-input">
                            <label class="custom-control-label" :for="'take'+item">{{item +' مورد در برگه'}}</label>
                        </div>
                    </li>
                </ul>
            </div>
            <button type="submit" class="submit_button"></button>
        </form>
    </no-ssr>
</template>

<script>
    import NoSSR from 'vue-no-ssr'

    export default {
        props: ['params', 'servicesData'],
        components: {
            'no-ssr': NoSSR
        },
        data() {
            return {
                url: null,
                services: [],
                created_at: null,
                take: null,
                takes: [12, 24, 48]
            }
        },
        created: function () {
            this.url = window.location.pathname;
            this.fetchTips();
        },

        methods: {
            fetchTips() {
                let params = this.params;
                this.services = _.has(params, 'services') ? params.services : [];
                this.created_at = _.has(params, 'created_at') ? params.created_at : null;
                this.take = _.has(params, 'take') ? params.take : null;
            },
            formOnChange() {
                this.$refs.form.submit()
            },
            takeCheck(){
                let take = this.take;
                return !_.isNull(take) ? take +' مورد در برگه' : 'تعداد';
            }

        }
    }
</script>

<style scoped>
    .submit_button{
        display:none;
    }
</style>