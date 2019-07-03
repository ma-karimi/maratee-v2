/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');
import Vue from 'vue';

Vue.prototype._ = _;
window.api = localStorage.getItem('api');
window.uri = localStorage.getItem('uri');
import VeeValidate, {Validator} from 'vee-validate';
import fa from 'vee-validate/dist/locale/fa';

Validator.localize('fa', fa);
const config = {
    errorBagName: 'errors', // change if property conflicts.
    fieldsBagName: 'fields',
    delay: 0,
    locale: 'fa',
    dictionary: null,
    strict: true,
    classes: false,
    classNames: {
        touched: 'touched', // the control has been blurred
        untouched: 'untouched', // the control hasn't been blurred
        valid: 'valid', // model is valid
        invalid: 'invalid', // model is invalid
        pristine: 'pristine', // control has not been interacted with
        dirty: 'dirty' // control has been interacted with
    },
    events: 'input|blur',
    inject: true,
    validity: false,
    aria: true
};

Vue.use(VeeValidate, config);
import user from './web'
import service from './web'
import {VueMasonryPlugin} from 'vue-masonry';
Vue.use(VueMasonryPlugin)
import VueMasonry from 'vue-masonry-css'
Vue.use(require('vue-moment-jalaali'));

Vue.use(VueMasonry);

Vue.component('reservation', require('./components/Reservation/Reservation.vue'), {
    name: 'reservation'
})
Vue.component('login', require('./components/Login/Login.vue'), {
    name: 'login'
})
Vue.component('services', require('./components/Services/Services.vue'), {
    name: 'services'
})
Vue.component('profile', require('./components/Profile/profile.vue'), {
    name: 'profile'
})

Vue.component('sidebar', require('./components/Sidebar/Sidebar.vue'), {
    name: 'sidebar'
})
Vue.component('patterns', require('./components/Pattern/Pattern.vue'), {
    name: 'patterns'
})
Vue.component('provider-patterns', require('./components/Services/ProviderPattern.vue'), {
    name: 'provider-patterns'
})

Vue.component('pattern-filters', require('./components/Pattern/Filter.vue'), {
    name: 'pattern-filters'
})

Vue.component('comment', require('./components/Comment/Comment.vue'), {
    name: 'comment'
})


const app = new Vue({
    el: '#app',
    user,
    service

});

