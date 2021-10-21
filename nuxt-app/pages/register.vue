<template>

  <div class="min-h-full flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
      <div>
        <h2 class="mt-36 md:mt-52  text-center text-3xl font-extrabold text-gray-900">
          Register
        </h2>
      </div>
      <div class="rounded-md shadow-sm">
        <div class="mt-3 mb-3">
          <label for="name">Name</label>
          <input v-model="name" id="name" name="name" type="text" autocomplete="name" required="" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Name" />
        </div>
        <div class="mt-3 mb-3">
          <label for="email-address" >Email address</label>
          <input v-model="email" id="email" name="email" type="email" autocomplete="email" required="" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email address" />
        </div>
        <div class="mt-3 mb-3">
          <label for="password">Password</label>
          <input v-model="password" id="password" name="password" type="password" autocomplete="current-password" required="" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password" />
        </div>
        <div class="mt-3 mb-3">
          <label for="password confirm">Password confirm</label>
          <input v-model="password_confirmation" id="password_confirmation" name="password_confirmation" type="password" required="" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password confirmation" />
        </div>
      </div>

      <button @click="register()" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
        </span>
        Submit
      </button>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  data(){
    return {
      name                 : '',
      email                : '',
      password             : '',
      password_confirmation: ''
    }
  },
  methods: {
    register(){
      axios
        .post('http://localhost:8000/api/auth/register', {
          name                 : this.name,
          email                : this.email,
          password             : this.password,
          password_confirmation: this.password_confirmation
        })
        .then(function (response) {
          alert('註冊成功');
          location.href = '/login';
        })
        .catch(function (error) {
          console.log(error);
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