<template>
    <div>
        <label class="block">Email</label>
        <input type="text" class="border border-gray-900" v-model="email"/>

        <br>

        <label class="block">Password</label>
        <input type="password" class="border border-gray-900" v-model="password"/>

        <br>
        <br>

        <button v-on:click="login()" class="cursor border border-gray-900 p-2">Login</button>
    </div>
</template>
<script>
export default {
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
