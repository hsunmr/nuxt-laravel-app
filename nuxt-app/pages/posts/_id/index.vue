<template>
    <div class="relative container mx-auto h-full w-full sm:w-5/6 md:w-3/6 bg-gray-100" style="top:70px">
        <div class="p-5">
            <h3 class="text-xl font-bold">{{post.title}}</h3>
            <div class="author text-right">{{post.user.name}}</div>
            <div class="content pt-5">
                {{post.content}}
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    data(){
        return {
            post: []
        }
    },
    async asyncData({ route, env }) {
        let { data } = await axios.get(`${env.backend_url}/api/posts/${route.params.id}`);

        return {
            post : data
        }

    },
}
</script>