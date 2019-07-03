<template>
    <div v-if="_.isEmpty(user)" class="sidebar-card card-pricing">
        <p>جهت رزرو خدمات ابتدا در نیلو لاگین نموده سپس درخواست خود را ثبت نمایید.</p>
        <a href="/login" class="btn btn-sm btn-primary">ورود به نیلو</a>
    </div>
    <div v-else class="sidebar-card card-pricing">
        <div class="price">
            <h1>
                {{price}} <sup> تومان </sup>
            </h1>
        </div>
        <ul class="pricing-options">
            <li v-for="item in reserved_services">
                <div class="custom-radio first">
                    <span class="circle"></span>{{item.service.name}}
                    <br/>
                    <span class="pricing__opt"> {{item.price}} تومان </span>
                    <div class="close-btn1" @click="deleteOrder(item.service_id)">
                        <span class="icon icon-close"></span>
                    </div>
                </div>
            </li>
        </ul>
        <!-- end /.pricing-options -->

        <div class="purchase-button">

            <date-picker
                    v-model="date"
                    :min="verta[0]"
                    input-format="YYYY-MM-DD"
                    format="jYYYY-jMM-jDD"
                    placeholder="لطفا تاریخ را انتخاب کنید"
                    @change="changeReserveDate"
            >

            </date-picker>


            <date-picker
                    type="time"
                    :min="time_start"
                    :max="time_end"
                    v-model="time"
                    :jumpMinute="30"
                    :roundMinute="true"
                    placeholder="لطفا ساعت را انتخاب کنید"
                    @change="changeReserveTime"
            >

            </date-picker>

        </div>
        <!-- end /.purchase-button -->
        <div class="calendar-box">
            <textarea placeholder="توضیحات اضافی..." cols="30" rows="10" v-model="description"></textarea>
        </div>
        <div class="calendar-box" v-if="error_message != null">{{error_message}}</div>
        <button @click="reserve" v-if="sendToBank" class="btn btn-sm btn-nailo">رزرو خدمات</button>
        <!-- end calendar-place-->
    </div>

</template>

<script>
    import VuePersianDatetimePicker from 'vue-persian-datetime-picker'
    import service from '../../web'
    import apiServices from '../../api/service'
    import moment from 'moment-jalaali';

    export default {
        props: ['verta', 'provider_id', 'user'],
        data() {
            return {
                reserved_services: [],
                date: '',
                time: '',
                time_start: '12:00',
                time_end: '17:00',
                error_message: null,
                sendToBank: false,
                description: null
            }

        },
        mounted() {
            this.updateReservedServices();
        },
        watch: {
            providerHaveServices: function () {
                this.updateReservedServices();
            }
        },
        computed: {
            userLogged() {
                return service.getters.isLoggedIn;
            },
            providerHaveServices() {
                return service.getters.currentItemServices;
            },
            services() {
                return service.getters.reservedServiceFilter;
            },
            price() {
                return service.getters.currentPrice;
            },
            hasProvider() {
                return service.getters.currentProvider;
            }
        },
        components: {
            datePicker: VuePersianDatetimePicker,
        },
        methods: {
            changeReserveDate() {
                apiServices.checkDate({date: this.date, provider_id: this.provider_id}).then(response => {
                    this.error_message = null;
                    let times = response.data.times;
                    this.time_start = times[0].value;
                    this.time_end = times[times.length - 1].value;
                    this.time = this.time_start;

                    this.changeReserveTime();
                }).catch(error => {
                    this.error_message = 'لطفا درخواست خود را در زمان دیگری امتحان نمایید';
                    this.sendToBank = false;
                });
            },
            changeReserveTime() {
                apiServices.provisionOfServices({
                    date: this.date,
                    provider_id: this.provider_id,
                    time: this.time,
                    services: this.services,
                }).then(response => {
                    if (response.data.state == 'accept') {
                        this.error_message = null;
                        this.sendToBank = true;
                        return
                    }
                    this.sendToBank = false;
                }).catch(error => {
                    this.error_message = 'لطفا درخواست خود را در زمان دیگری امتحان نمایید';
                    this.sendToBank = false;
                });
            },
            reserve() {
                apiServices.setReserve({
                    reserve_date: moment(this.date, 'jYYYY/jMM/jDD').format('YYYY-MM-DD'),
                    provider_id: this.provider_id,
                    reserve_time: this.time,
                    services: this.services,
                    description: this.description,
                }).then(response => {
                    if (response.status == 200) {
                        localStorage.removeItem('provider')
                        localStorage.removeItem('services')
                        localStorage.removeItem('itemServices')
                        window.location = '/buy/' + response.data.payment.unique_code
                    }
                }).catch(error => {
                    this.sendToBank = false;
                    this.error_message = 'لطفا درخواست خود را در زمان دیگری امتحان نمایید';
                });
            },
            updateReservedServices() {
                this.reserved_services = service.getters.currentItemServices;
            },
            deleteOrder(service_id) {
                let reserved_services = this.reserved_services;
                this.reserved_services = reserved_services.filter(function (obj) {
                    return obj.service_id !== service_id;
                });
                this.setServices();
            },
            setServices() {
                let reserved_services = this.reserved_services;
                service.dispatch('setServices', reserved_services);
                service.commit('setServices', reserved_services);
            }
        }

    }
</script>
<style>

    .vpd-wrapper {
        position: unset;
        display: block;

    }

    .vpd-input-group {
        position: unset;
        margin-bottom: 10px;

    }


    .vpd-actions button:nth-last-child {
        display: none;
    }

</style>