<template>
    <div class="Login">
        <div class="login--form">
            <div class="form-group" v-show="!send_token">
                <label for="cellphone">تلفن همراه</label>
                <input id="cellphone" type="tel" class="text_field" placeholder="تلفن همراه خود را وارد کنید"
                       v-model="cellphone">
            </div>
            <div class="form-group" v-if="send_token && has_password == 0">
                <label for="password">کد ارسال شده</label>
                <input id="password" v-model="password" type="text" class="text_field"
                       placeholder="">
            </div>
            <div class="form-group" v-if="send_token && has_password == 1">
                <label for="password1">پسورد</label>
                <input id="password1" v-model="password" type="password" class="text_field"
                       placeholder="">
            </div>

            <div class="form-group">
                <div class="custom_checkbox">
                    <label>
                        <span class="label_text" v-show="error_message">{{error_message}}</span>
                    </label>
                </div>
            </div>

            <button class="btn btn--md btn-nailo" type="button" autofocus @click.prevent="send_token ? login() : token()">
                {{!send_token ? 'کد یکبار مصرف' : 'ورود'}}
            </button>
            <button class="btn btn--md resend-btn" type="button" autofocus v-if="send_token" @click.prevent="resendToken">
                ارسال کد یکبار مصرف
            </button>
        </div>
    </div>
</template>

<script>
    import user from '../../web';

    export default {
        data() {
            return {
                cellphone: null,
                app_mode: 'customer',
                password: null,
                send_token: false,
                error_message: null,
                has_password: 0

            }
        },
        methods: {
            token() {
                this.$validator.validateAll().then(result => {
                    if (result) {
                        axios.put('/token/', {cellphone: this.cellphone, app_mode:this.app_mode})
                            .then(response => {
                                this.send_token = true
                                this.has_password = _.isNull(response.data.has_password) ? 0 : response.data.has_password;
                            }).catch(function (error) {
                            console.log(error);
                            this.error_message = 'لطفا چند لحظه دیگر درخواست کد یکبار مصرف نمائید.';
                        });
                    }
                });
            },
            resendToken() {
                this.$validator.validateAll().then(result => {
                    if (result) {
                        axios.put('/resend/token/', {cellphone: this.cellphone, app_mode:this.app_mode})
                            .then(response => {
                                this.send_token = true
                                this.has_password = response.data.has_password
                            }).catch(function (error) {
                            console.log(error);
                            this.error_message = 'لطفا چند لحظه دیگر درخواست کد یکبار مصرف نمائید.';
                        });
                    }
                });
            },
            login() {
                this.$validator.validateAll().then(result => {
                    if (result) {
                        user.dispatch('login', {
                            cellphone: this.cellphone,
                            app_mode: this.app_mode,
                            password: this.password
                        }).then(response => {
                            // this.clearInputs();
                            // this.send_token = true

                            window.location.href = "/";
                        }).catch(error => {
                            this.error_message = 'لطفا چند لحظه دیگر درخواست کد یکبار مصرف نمائید.';
                        });
                    }
                });
            },
            clearInputs() {
                this.cellphone = this.error_message = this.password = null;
            }
        }
    }

</script>
<style>

    input[type=text]{
         letter-spacing: 75px !important;
     }
    input[type=password]{
         text-align: center;
        letter-spacing: 20px !important;
     }

</style>
