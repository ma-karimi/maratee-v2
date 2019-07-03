<template>
    <div class="dashboard_contents section--padding">
        <div class="container">
            <div class="setting_form">
                <div class="row">


                    <div class="col-md-6 offset-md-3 col-xs-12">
                        <div class="information_module">
                            <div class="toggle_title">
                                <h4>اطلاعات شخصی</h4>
                            </div>

                            <div class="information__set">
                                <div class="information_wrapper form--fields row">


                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="usrname">نام کاربری
                                                <sup>*</sup>
                                            </label>
                                            <input type="text" id="usrname" class="text_field" placeholder="نام کاربری"
                                                   v-model="userName" data-vv-rules="required|userName">
                                        </div>
                                    </div>


                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="password">پسورد
                                            </label>
                                            <input type="password"
                                                   class="text_field"
                                                   id="password"
                                                   placeholder="پسورد"
                                                   v-model="password"
                                                   v-validate="'min:6|max:35'"
                                                   data-vv-as="رمز عبور "
                                                   name="password"
                                                   ref="password"
                                            />
                                        </div>

                                        <div>
                                            <span>{{ errors.first('password') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="conpassword">دوباره نویسی پسورد
                                            </label>
                                            <input type="password"
                                                   id="conpassword"
                                                   class="text_field"
                                                   placeholder="دوباره نویسی پسورد"
                                                   v-model="confirmPassword"
                                                   data-vv-as="تکرار پسورد "                                        v-validate="'confirmed:password'"
                                                   name="confirm_password"/>

                                        </div>
                                        <div>
                                            <span>{{ errors.first('confirm_password') }}</span>
                                        </div>
<!--                                        <div class="alert alert-danger" v-show="errors.any()">-->
<!--                                            <div v-if="errors.has('password')">-->
<!--                                                {{ errors.first('password') }}-->
<!--                                            </div>-->
<!--                                            <div v-if="errors.has('password_confirmation')">-->
<!--                                                {{ errors.first('password_confirmation') }}-->
<!--                                            </div>-->
<!--                                        </div>-->
                                    </div>


                                </div>
                                <!-- end /.information_wrapper -->
                            </div>
                            <!-- end /.information__set -->
                        </div>
                        <!-- end /.information_module -->
                    </div><!-- ends: .col-md-12 -->


                    <div class="col-6 offset-3">
                        <div class="dashboard_setting_btn">
                            <button type="submit" @click.prevent="submit" class="btn btn--md btn-nailo">ذخیره تغییرات</button>
<!--                            <button type="reset" class="btn btn-md btn-nailo">لغو</button>-->
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->
            </div>
            <!-- end /form -->
        </div>
        <!-- end /.container -->
    </div>
</template>

<script>
    export default {
        props: ['user'],
        data() {
            return {
                userName: !_.isEmpty(this.user.name) ? this.user.name : null,
                password: null,
                confirmPassword: null,
                errorsUserName: false,
            }
        },
        methods: {
            submit() {
                this.$validator.validateAll().then(result => {
                    if (result) {
                        if (this.userName && this.password) {
                            axios.post('/profile', {name: this.userName, password: this.password})
                                .then(response => {
                                    location.reload();
                                }).catch(function (error) {
                                console.log(error);
                                this.error_message = 'لطفا مجدد تلاش کنید.';
                            });
                        } else if (this.userName) {
                            axios.post('/profile', {name: this.userName})
                                .then(response => {
                                    // this.send_token = true
                                    location.reload();
                                }).catch(function (error) {
                                console.log(error);
                                this.error_message = 'لطفا مجدد تلاش کنید.';
                            });
                        }
                    }
                });
            },
        }
    };
</script>
