window.axios = require('axios');

export default {
    reservedServiceFilter(serviceData){
        return _.map(serviceData, 'service_id');
    },
    serviceTotalPrice(serviceData){
        return _.sumBy(serviceData, 'price');
    },
    setReserve(serviceData) {
        return axios.put('/reservation/', serviceData);
    },

    checkDate(serviceData) {
        return axios.post('/schedule', serviceData);
    },
    provisionOfServices(serviceData) {
        return axios.post('/provision-of-services', serviceData);
    },

    services() {
        return !!localStorage.getItem('services');
    },

    getServices() {
        return JSON.parse(localStorage.getItem('services'));
    },

    setServices(serviceData) {
        let dataServices = this.reservedServiceFilter(serviceData);
        localStorage.setItem('services', JSON.stringify(dataServices))
    },

    destroyServices() {
        localStorage.removeItem('services')
    },
    provider() {
        return !!localStorage.getItem('provider');
    },

    getProvider() {
        return localStorage.getItem('provider');
    },

    setProvider(provider) {
        localStorage.setItem('provider', provider)
    },

    destroyProvider() {
        localStorage.removeItem('provider')
    },

    itemServices() {
        return !!localStorage.getItem('itemServices');
    },

    getItemServices() {
        return JSON.parse(localStorage.getItem('itemServices'));
    },

    setItemServices(serviceData) {
        localStorage.setItem('itemServices', JSON.stringify(serviceData))
    },

    destroyItemServices() {
        localStorage.removeItem('itemServices')
    }

}