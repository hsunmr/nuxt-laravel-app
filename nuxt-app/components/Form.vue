<template>
    <div class="relative container mx-auto h-full w-full sm:w-5/6 md:w-3/6 bg-gray-100 pt-10" style="top:70px">
        <div class="p-3 w-full space-y-8">
            <div>
                <h2 class="text-center text-3xl font-extrabold text-gray-900">
                    {{page_title}}
                </h2>
            </div>
            <div class="rounded-md shadow-sm -space-y-px">
                <div class="mt-3 mb-3">
                    <label for="title" class="pb-5">title</label>
                    <input v-model="title" id="title" name="title" type="text" autocomplete="title" required=""
                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="title"
                    />
                </div>
                <div class="mt-3 mb-3">
                    <label for="content">content</label>
                    <textarea v-model="content" id="content" name="content"  required=""
                        class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm"
                        placeholder="content"
                        rows="20"
                    />
                </div>
            </div>

            <div>
                <button @click="submit()"  class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gray-700 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Submit
                </button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        page_title: String,
        title     : String,
        content   : String,
        submit    : Function
    },
    methods: {
        submit(){
            this.$emit('confirm', this.title, this.content);
        }
    }
}
</script>