<template>

  <div class="min-h-full flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
      <div>
        <h2 class="mt-36 md:mt-52  text-center text-3xl font-extrabold text-gray-900">
          Register
        </h2>
      </div>
      <ValidationObserver ref="form" v-slot="{ handleSubmit }">
        <form @submit.prevent="handleSubmit(register)">
          <div class="rounded-md shadow-sm">
            <ValidationProvider vid="name" rules="required" v-slot="{ classes, errors }">
              <div class="mt-3 mb-3">
                  <div class="input_field" :class="classes">
                    <label for="name">Name</label>
                    <input v-model="name" id="name" name="name" type="name" autocomplete="name" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Name">
                    <span class="error_message">{{ errors[0] }}</span>
                  </div>
              </div>
            </ValidationProvider>
            <ValidationProvider vid="email" rules="required|email" v-slot="{ classes, errors }">
              <div class="mt-3 mb-3">
                  <div class="input_field" :class="classes">
                    <label for="email" class="pb-5">Email address</label>
                    <input v-model="email" id="email" name="email" type="email" autocomplete="email" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email address">
                    <span class="error_message">{{ errors[0] }}</span>
                  </div>
              </div>
            </ValidationProvider>
            <ValidationProvider vid="password" rules="required|confirmed:password_confirmation" v-slot="{ classes, errors }">
              <div class="mt-3 mb-3">
                  <div class="input_field" :class="classes">
                    <label for="password">Password</label>
                    <input v-model="password" id="password" name="password" type="password" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password">
                    <span class="error_message">{{ errors[0] }}</span>
                  </div>
              </div>
            </ValidationProvider>
            <ValidationProvider vid="password_confirmation" rules="required" v-slot="{ classes, errors }">
              <div class="mt-3 mb-3">
                  <div class="input_field" :class="classes">
                    <label for="password confirm">Password confirm</label>
                    <input v-model="password_confirmation" id="password_confirmation" name="password_confirmation" type="password" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password confirmation">
                    <span class="error_message">{{ errors[0] }}</span>
                  </div>
              </div>
            </ValidationProvider>
          </div>

          <button class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gray-700 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
            </span>
            Submit
          </button>
        </form>
      </ValidationObserver>
    </div>
  </div>
</template>
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
      name                 : '',
      email                : '',
      password             : '',
      password_confirmation: ''
    }
  },
  methods: {
    register(){
      let _this = this;
      this.$axios
        .post(`${process.env.backend_url}/api/auth/register`, {
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
          if (error.response.data.errors) {
            _this.$refs.form.setErrors(error.response.data.errors);
            return;
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