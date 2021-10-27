<template>
    <nav class="bg-gray-700 fixed w-full z-10">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button-->
                    <button  @click="nav_is_active = !nav_is_active" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>

                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>

                        <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="hidden sm:block sm:ml-6">
                        <div class="flex space-x-4">
                            <nuxt-link to="/" class="bg-white text-gray-700 hover:bg-gray-100 hover:text-gray-600 px-3 py-2 font-bold rounded-md text-sm font-medium" aria-current="page">Home</nuxt-link>
                        </div>
                    </div>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">

                    <div v-if="this.$auth.loggedIn" class="hidden sm:block text-gray-100">
                        <nuxt-link to="posts/create" class="text-yellow-400 hover:text-white"><i class="material-icons align-top">add_circle_outline</i> 新增貼文</nuxt-link>
                    </div>

                    <!-- Profile dropdown -->

                    <div class="ml-3 relative">
                        <div v-if="this.$auth.loggedIn">
                            <div class="relative inline-block text-left">
                                <div @click="is_active = !is_active">
                                    <button type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" id="menu-button" aria-expanded="true" aria-haspopup="true">
                                        <client-only>
                                            <i class="material-icons px-1">directions_bike</i> {{this.$auth.user.name}}
                                        </client-only>
                                        <!-- Heroicon name: solid/chevron-down -->
                                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>

                                <div v-show="is_active" class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                    <div class="py-1" role="none">
                                        <button @click="logout()" class="text-gray-700 block w-full text-left px-4 py-2 text-sm" role="menuitem" tabindex="-1" id="menu-item-3">
                                        Sign out
                                        </button>
                                    </div>
                                </div>
                                </div>


                            </div>
                        <div v-else>
                            <nuxt-link to="login" class="bg-white hover:bg-gray-100 hover:text-gray-600 py-2 px-4 rounded">Login</nuxt-link>
                            <nuxt-link to="register" class="bg-white hover:bg-gray-100 hover:text-gray-600 py-2 px-4 rounded">Register</nuxt-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile menu, show/hide based on menu state. -->
        <div v-show="nav_is_active" class="sm:hidden " id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 text-white">
               <nuxt-link to="posts/create" class="text-yellow-400 hover:text-white"><i class="material-icons align-top">add_circle_outline</i> 新增貼文</nuxt-link>
            </div>
        </div>
    </nav>

</template>
<script>
export default {
    head() {
        return {
            link: [
                { rel: 'stylesheet', href: 'https://fonts.googleapis.com/icon?family=Material+Icons' }
            ],
        }
    },
    data() {
        return {
            is_active : false,
            nav_is_active : false
        }
    },
    methods: {
        logout: function(){
            this.is_active = false;
            this.$auth.logout();
        }
    }
}
</script>
