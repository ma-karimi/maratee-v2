import service from '../../api/service';

const state = {
    itemServices: service.getItemServices() ? service.getItemServices() : [],
    services: service.getServices() ? service.getServices() : [],
    provider_id: service.getProvider() ? service.getProvider() : null,
    date: null,
    time: null,
};

const getters = {
    currentProvider: state => {
        return state.provider_id;
    },
    currentItemServices: state => {
        return state.itemServices;
    },
    currentServices: state => {
        return state.services;
    },
    currentPrice: state => {
        return service.serviceTotalPrice(state.itemServices);
    },
    reservedServiceFilter: state => {
        return service.reservedServiceFilter(state.itemServices);
    },
};

const actions = {
    setReserve({commit}, serviceData) {
        return new Promise((resolve, reject) => {
            service.setReserve(serviceData).then(response => {
                commit('setAuth', response.data.user);
                resolve(response);
            }).catch(error => {
                reject(error);
            })
        });
    },

    setDate({commit}, serviceData) {
        return new Promise((resolve, reject) => {
            service.checkDate(serviceData).then(response => {
                let times = response.data.times;
                if (times.length > 0) {
                    commit('setTimes', response.data.times);
                } else {
                    commit('setEmptyTimes');
                }
                resolve(response);
            }).catch(error => {
                reject(error);
            })
        });
    },

    setTime({commit}, serviceData) {
        return new Promise((resolve, reject) => {
            service.provisionOfServices(serviceData).then(response => {
                let state = response.data.state;
                if (state == 'fail') {
                    commit('setFail', 'لطفا زمان دیگری برای دریافت خدمات انتخاب کنید.');
                } else {
                    commit('setAccept');
                }
                resolve(response);
            }).catch(error => {
                reject(error);
            })
        });
    },
    getCurrentItemServices({commit}) {
        return state.itemServices;
    },
    getCurrentServices({commit}) {
        return state.services;
    },
    getCurrentProvider({commit}) {
        return state.provider_id;
    },
    setServices({commit}, serviceData) {
        service.setServices(serviceData)
        service.setItemServices(serviceData);
    },
    setProvider({commit}, provider_id) {
        service.setProvider(provider_id);
    }
};

const mutations = {
    setTimes(state, times) {
        state.times = times;
        state.first_time = times[0];
        state.end_time = times[times.length - 1];
    },
    setServices(state, services) {
        state.services = services;
        state.itemServices = services;
    },
    setProvider(state, provider_id){
        state.provider_id = provider_id;
    },
    setEmptyTimes(state) {
        state.times = [];
        state.first_time = null;
        state.end_time = null;
    },
    setFail(state, message) {
        state.message = message;
        state.state = 'fail';
    },
    setAccept(state) {
        state.message = null;
        state.state = 'accept';
    },
    setUrlToken(state, token) {
        state.urlToken = token;
    }
};

export default {
    state,
    getters,
    actions,
    mutations
};