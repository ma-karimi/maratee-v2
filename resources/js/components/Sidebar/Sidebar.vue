<template>

    <aside class="sidebar product--sidebar">
        <form :action="url" method="get">
            <div class="sidebar-card card--filter">
                <a class="card-title" data-toggle="collapse" href="#collapse8" role="button"
                   aria-expanded="false" aria-controls="collapse8">
                    <h5>نام سرویس دهنده
                        <span class="icon-arrow-down"></span>
                    </h5>
                </a>
                <div class="collapse show collapsible-content" id="collapse8">
                    <div class="custom-control custom-checkbox">
                        <span class="icon  icon-magnifier"></span>
                        <input type="text" v-model="keyword" name="keyword">

                    </div>
                </div>
            </div>
            <div class="sidebar-card card--filter">
                <a class="card-title" data-toggle="collapse" href="#collapse2" role="button"
                   aria-expanded="false" aria-controls="collapse2">
                    <h5>سرویس
                        <span class="icon-arrow-down"></span>
                    </h5>
                </a>
                <div class="collapse show collapsible-content" id="collapse2">
                    <ul class="card-content" style="height: 300px;scroll-behavior: smooth;overflow-y: auto">
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
            </div>
            <div class="sidebar-card card--filter">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" v-model="nearest_location"
                           id="nearest_location" name="nearest_location"
                           :checked="nearest_location" class="custom-control-input">
                    <label class="custom-control-label" for="nearest_location">فقط سرویس دهنده های نزدیک</label>
                </div>
            </div>
            <div class="sidebar-card card--filter">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" v-model="promotion"
                           id="promotion" name="promotion"
                           :checked="promotion" class="custom-control-input">
                    <label class="custom-control-label" for="promotion">فقط پروموشن ها</label>
                </div>
            </div>
            <div class="sidebar-card card--filter">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" v-model="created_at"
                           id="created_at_desc" name="created_at" value="desc" :true-value="'desc'" :false-value="null"
                           :checked="created_at" class="custom-control-input">
                    <label class="custom-control-label" for="created_at_desc">جدیدترین</label>
                </div>
            </div>
            <div class="sidebar-card card--filter">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" v-model="created_at"
                           id="created_at_asc" name="created_at" value="asc" :true-value="'asc'" :false-value="null"
                           :checked="created_at" class="custom-control-input">
                    <label class="custom-control-label" for="created_at_asc">قدیمی ترین</label>
                </div>
            </div>
            <div class="sidebar-card card--filter">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" v-model="service_price"
                           id="service_price_desc" name="service_price" value="desc" :true-value="'desc'" :false-value="null"
                           :checked="service_price" class="custom-control-input">
                    <label class="custom-control-label" for="service_price_desc">گران ترین</label>
                </div>
            </div>
            <div class="sidebar-card card--filter">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" v-model="service_price"
                           id="service_price_asc" name="service_price" value="asc" :true-value="'asc'" :false-value="null"
                           :checked="service_price" class="custom-control-input">
                    <label class="custom-control-label" for="service_price_asc">ارزان ترین</label>
                </div>
            </div>
            <div class="sidebar-card card--filter">
                <a class="card-title" data-toggle="collapse" href="#collapse1" role="button"
                   aria-expanded="false" aria-controls="collapse1">
                    <h5>الگو
                        <span class="icon-arrow-down"></span>
                    </h5>
                </a>
                <div class="collapse show collapsible-content" id="collapse1">
                    <ul class="card-content" style="height: 300px;scroll-behavior: smooth;overflow-y: auto">
                        <li v-for="pattern in patternsData">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" v-model="patterns"
                                       :id="'pattern'+pattern.id" :value="pattern.id" name="patterns[]"
                                       :checked="_.includes(patterns, pattern.id)" class="custom-control-input">
                                <label class="custom-control-label"
                                       :for="'pattern'+pattern.id">{{pattern.title}}</label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="sidebar-card card--filter">
                <a class="card-title" data-toggle="collapse" href="#collapse3" role="button"
                   aria-expanded="false" aria-controls="collapse3">
                    <h5>محله ها
                        <span class="icon-arrow-down"></span>
                    </h5>
                </a>
                <div class="collapse show collapsible-content" id="collapse3">
                    <ul class="card-content" style="height: 300px;scroll-behavior: smooth;overflow-y: auto">
                        <li v-for="neighborhood in neighborhoodsData">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" v-model="neighborhoods"
                                       :id="'neighborhood'+neighborhood.id" :value="neighborhood.id"
                                       name="neighborhoods[]"
                                       :checked="_.includes(neighborhoods, neighborhood.id)"
                                       class="custom-control-input">
                                <label class="custom-control-label" :for="'neighborhood'+neighborhood.id">{{neighborhood.name}}</label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="sidebar-card card--slider">
                <a class="card-title" data-toggle="collapse" href="#collapse9" role="button"
                   aria-expanded="false" aria-controls="collapse9">
                    <h5>مسافت
                        <span class="icon-arrow-down"></span>
                    </h5>
                </a>
                <div class="collapse show collapsible-content" id="collapse9">
                    <div class="card-content">
                        <ul class="card-content">
                            <li v-for="item in distances">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox"
                                           v-model="distance"
                                           name="distance"
                                           :value="item" :id="'distance'+item" :true-value="item" :false-value="null"
                                           class="custom-control-input">
                                    <label class="custom-control-label" :for="'distance'+item">{{item + ' کیلومتر'}}</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="search-update">
                <button type="submit" href="" class="btn btn-sm btn-primary">جستجو</button>
            </div>
        </form>
    </aside>
</template>

<script>
    export default {
        props: ['citiesData', 'params', 'neighborhoodsData', 'patternsData', 'servicesData'],
        data() {
            return {
                distances: [5, 10, 15],
                url: null,
                keyword: null,
                patterns: [],
                neighborhoods: [],
                services: [],
                promotion: false,
                nearest_location: false,
                created_at: null,
                service_price: null,
                distance: null,
            }
        },
        created: function () {
            this.url = window.location.pathname;
            this.fetchTips();
        },

        methods: {
            fetchTips() {
                let params = this.params;
                this.city_id = _.has(params, 'city_id') ? params.city_id : null;
                this.services = _.has(params, 'services') ? params.services : [];
                this.neighborhoods = _.has(params, 'neighborhoods') ? params.neighborhoods : [];
                this.patterns = _.has(params, 'patterns') ? params.patterns : [];
                this.keyword = _.has(params, 'keyword') ? params.keyword : null;
                this.promotion = _.has(params, 'promotion');
                this.distance = _.has(params, 'distance') ? params.distance : null;
                this.created_at = _.has(params, 'created_at') ? params.created_at : null;
                this.service_price = _.has(params, 'service_price') ? params.service_price : null;
            }

        }
    };
</script>
