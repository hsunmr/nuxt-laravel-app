<template>
    <div class="min-h-full flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <div>
                <h2 class="mt-36 md:mt-52  text-center text-3xl font-extrabold text-gray-900">
                    Sign in to your account
                </h2>
            </div>
            <div class="rounded-md shadow-sm -space-y-px">
                <div class="mt-3 mb-3">
                    <label for="email-address" class="pb-5">Email address</label>
                    <input v-model="email" id="email-address" name="email" type="email" autocomplete="email" required="" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email address" />
                </div>
                <div class="mt-3 mb-3">
                    <label for="password">Password</label>
                    <input v-model="password" id="password" name="password" type="password" autocomplete="current-password" required="" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password" />
                </div>
            </div>

            <div>
                <button @click="login()"  class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gray-700 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Sign in
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    layout: 'blank',
    data(){
        return {
            email: '',
            password: ''
        }
    },
    methods: {
        login(){
            this.$auth.loginWith('laravelJWT', {
                data: {
                    email: this.email,
                    password: this.password
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
