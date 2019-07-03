<template>
    <div class="Services">
        <div class="panel accordion__single" v-for="item,index in services">
            <div class="single_acco_title">
                <h4>
                    <div class="collapsed">
                        <span class="provider-icon">
                            <img :src="item.service.imageSmall" :alt="item.service.name" width="30">
                        </span>
                        <div class="provider-header">
                            <span class="provider-title">
                                   {{item.service.name}}
                            </span>
                            <span class="provider-desc">
                                لولورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                            </span>

                        </div>
                        <div class="provider-content">
                            <!--<i class="dot"></i>-->
                            <!--<span class="item-capacity">-->
                            <!--ظرفیت هر ساعت-->
                            <!--{{item.capacity}}-->
                            <!--</span>-->
                            <span class="item-service-time">
مدت زمان
                            {{item.service_time}}
                                </span>

                            <span class="item-price">
                                قیمت
                            {{item.price}}
                            </span>
                        </div>
                        <br/>
                        <i class="icon icon-minus" v-if="hasProviderService(item.service_id)"
                           @click.prevent="deleteOrder(item.service_id)"></i>
                        <i class="icon icon-plus"
                           v-if="dontHaveFindProviderService(item.service_id)"
                           @click.prevent="addToOrder(index)"></i>

                    </div>
                </h4>
            </div>
        </div>
    </div>
</template>

<script>
    import service from '../../web'

    export default {
        props: ['services', 'provider_id'],
        data() {
            return {
                reserve_services: []
            }
        },
        mounted() {
            if (typeof this.$redrawVueMasonry === 'function') {
                this.$redrawVueMasonry()
            }
        },

        created() {
            this.reserve_services = service.getters.currentItemServices;
        },
        watch: {
            reserve_services: function () {
                return service.getters.currentItemServices;
            }
        },
        computed: {
            reserved_services() {
                this.reserve_services = service.getters.currentItemServices;
                return service.getters.reservedServiceFilter;
            },
            hasProvider() {
                return service.getters.currentProvider;
            }
        },
        methods: {
            addToOrder(index) {
                // const service = {id: service_id, name: name, price: price}
                this.reserve_services.push(this.services[index])
                this.setServices();
            },
            deleteOrder(service_id) {
                let reserve_services = this.reserve_services;
                this.reserve_services = reserve_services.filter(function (obj) {
                    return obj.service_id !== service_id;
                });
                this.setServices();
            },
            setServices() {
                let provider_id = this.provider_id,
                    reserve_services = this.reserve_services;
                service.dispatch('setServices', reserve_services);
                service.commit('setServices', reserve_services);
                service.dispatch('setProvider', provider_id);
                service.commit('setProvider', provider_id);
            },
            dontHaveFindProviderService(service_id) {
                let reserved_services = this.reserved_services,
                    reserve_services = this.reserve_services;
                return !_.find(reserve_services, {'service_id': service_id}) && !_.includes(reserved_services, service_id);
            },
            hasProviderService(service_id) {
                let reserve_services = this.reserve_services;
                return _.find(reserve_services, {'service_id': service_id}) && this.hasProvider == this.provider_id
            }
        }
    };
</script>
<style>
    .collapsed .provider-icon {
        height: 85%;
        width: 75px;
        display: inline-block;
        position: absolute;
        right: 10px;
        border-radius: 5px;
    }

    .collapsed .provider-icon img {
        width: inherit;
        height: inherit;
        border-radius: 5px;
    }

    .item-service-time {
        display: inline-block;
        margin-bottom: 10px;
        font-size: 13px;
    }

</style>