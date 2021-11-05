<template>
    <div class="relative container mx-auto h-full w-full sm:w-5/6 md:w-3/6 bg-gray-100 pt-10" style="top:70px">
        <div class="p-3 w-full space-y-8">
            <div>
                <h2 class="text-center text-3xl font-extrabold text-gray-900">
                    {{page_title}}
                </h2>
            </div>
            <ValidationObserver ref="form" v-slot="{ handleSubmit }">
                <form @submit.prevent="handleSubmit(send)">
                    <div class="rounded-md space-y-px">
                        <ValidationProvider vid="title" rules="required" v-slot="{ classes, errors }">
                        <div class="mt-3 mb-3">
                            <div class="input_field" :class="classes">
                                <label for="title" class="pb-5">title</label>
                                <input v-model="new_title" id="title" name="title" type="text" autocomplete="title"
                                    class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                    placeholder="title"
                                />
                                <span class="error_message">{{ errors[0] }}</span>
                            </div>
                        </div>
                        </ValidationProvider>
                        <ValidationProvider vid="content" rules="required" v-slot="{ classes, errors }">
                        <div class="mt-3 mb-3">
                            <div class="input_field" :class="classes">
                                <label for="content">content</label>
                                <textarea v-model="new_content" id="content" name="content"  required=""
                                    class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                                    placeholder="content"
                                    rows="20"
                                />
                                <span class="error_message">{{ errors[0] }}</span>
                            </div>
                        </div>
                        </ValidationProvider>
                    </div>

                    <div>
                        <button class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gray-700 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Submit
                        </button>
                    </div>
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
    props: {
        page_title: String,
        title     : String,
        content   : String,
        submit    : Function
    },
    data(){
        return {
            new_title : this.title,
            new_content : this.content,
        }
    },
    methods: {
        send(){
            this.$emit('confirm', this.new_title, this.new_content);
        },
        setErrors(error){
            this.$refs.form.setErrors(error);
        }
    }
}
</script>