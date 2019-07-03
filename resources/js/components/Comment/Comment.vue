<template>
    <div class="message_composer composing">

        <div class="composer_field">
        <star-rating v-model="stars" :star-size="25"  :show-rating="false" v-validate name="stars"
                     data-vv-rules="required" data-vv-as="انتخاب امتیاز ..."></star-rating>
        </div>
        <span>{{ errors.first('stars') }}</span>

        <div class="composer_field">
            <textarea v-model="body" cols="30" rows="10"  v-validate name="body"
                      data-vv-rules="required|min:3" data-vv-as="متن نظر " placeholder="نظر خود را وارد کنید."></textarea>
        </div>

        <div class="btns">
            <button class="btn send btn--sm btn-primary" @click.prevent="submitComment">ارسال</button>
            <a :href="'/reserve/'+reserve_id" class="btn btn--sm cancel_btn btn-secondary">بازگشت</a>
        </div>
        <!-- end /.message_composer -->
    </div>
</template>

<script>
    import StarRating from 'vue-star-rating'


    export default {
        props: ['reserve_id', 'provider_id'],
        data() {
            return {
                stars: null,
                body: null,
                error_message:null
            }
        },
        components: {
            StarRating
        },
        methods: {
            submitComment() {
                this.$validator.validateAll().then(result => {
                    if (result) {
                        axios.put('/comment/' + this.reserve_id, {
                            stars: this.stars,
                            body: this.body,
                            provider_id: this.provider_id
                        })
                            .then(response => {
                                this.error_message = null;
                                location.reload('/reserve/' + this.reserve_id);
                            }).catch(function (error) {
                            this.error_message = 'لطفا چند لحظه دیگر درخواست کد یکبار مصرف نمائید.';
                        });
                    }
                })
            }

        }
    };
</script>
