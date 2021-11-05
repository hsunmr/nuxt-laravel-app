<template>
    <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-36 md:mt-52  text-center text-3xl font-extrabold text-gray-900">
                    Sign in to your account
                </h2>
            </div>
            <ValidationObserver ref="form" v-slot="{ handleSubmit }">
                <form @submit.prevent="handleSubmit(login)">
                    <div class="rounded-md space-y-px">
                        <ValidationProvider vid="email" rules="required|email" v-slot="{ classes, errors }">
                        <div class="mt-3 mb-3">
                            <div class="input_field" :class="classes">
                                <label for="email" class="pb-5">Email address</label>
                                <input v-model="email" id="email" name="email" type="email" autocomplete="email" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email address">
                                <span class="error_message">{{ errors[0] }}</span>
                            </div>
                        </div>
                        </ValidationProvider>

                        <ValidationProvider vid="password" rules="required" v-slot="{ classes, errors }">
                        <div class="mt-3 mb-3">
                            <div class="input_field" :class="classes">
                                <label for="password">Password</label>
                                <input v-model="password" id="password" name="password" type="password" autocomplete="current-password" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
                                <span class="error_message">{{ errors[0] }}</span>
                            </div>
                        </div>
                        </ValidationProvider>
                    </div>

                    <div>
                        <button class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gray-700 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Sign in
                        </button>
                    </div>
                </form>
            </ValidationObserver>
        </div>

    </div>
</template>
<style>
.error_message {
    color:red;
    font-size: 14px;
}
.input_field.invalid input{
    color: red;
    border: 1px solid red;
}
</style>
<script>
import { ValidationProvider, ValidationObserver } from 'vee-validate';

export default {
    components: {
        ValidationProvider,
        ValidationObserver
    },
    layout: 'blank',
    data(){
        return {
            email: '',
            password: '',
        }
    },
    methods: {
        login(){

            let _this = this;
            this.$auth.loginWith('laravelJWT', {
                data: {
                    email: this.email,
                    password: this.password
                }
            })
            .catch(function(error){
                switch (error.response.status) {
                    case 401:
                        _this.$refs.form.setErrors({
                            email : ['帳號或密碼輸入錯誤。'],
                            password: ['帳號或密碼輸入錯誤。']
                        });
                        break;
                    default:
                        if (error.response.data.errors) {
                            _this.$refs.form.setErrors(error.response.data.errors);
                            return;
                        }
                        break;
                }

            });
        }
    },
    middleware({ store, redirect }) {
        if (store.state.auth.loggedIn) {
            return redirect('/')
        }
    }
}
</script>
