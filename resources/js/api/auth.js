window.axios = require('axios');

export default {
    loginUser(userData) {
        return axios.put('/login/', {
            cellphone: userData.cellphone,
            password: userData.password,
            app_mode: userData.app_mode,
        });
    },

    getUser() {
        return axios.get('/auth/user');
    },

    loggedIn() {
        return !!localStorage.getItem('user');
    },

    setLogged(user) {
        localStorage.setItem('user', user)
    },

    destroyLogged() {
        localStorage.removeItem('user')
    }

}