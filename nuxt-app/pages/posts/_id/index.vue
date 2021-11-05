<template>
    <div class="relative container mx-auto h-full w-full sm:w-5/6 md:w-3/6 bg-gray-100" style="top:70px">
        <div class="p-5">
            <h3 class="text-xl font-bold">{{post.title}}</h3>
            <div class="author text-right">{{post.user.name}}</div>
            <div class="content pt-5">
                {{post.content}}
            </div>
            <div v-if="this.$auth.loggedIn && (this.$auth.user.id == post.user.id)" class="grid grid-cols-2 gap-4 mt-10">
                <nuxt-link :to="{ name: 'posts-id-edit', params: { id: post.id }}"><div class="p-6 bg-yellow-300 hover:bg-yellow-200 text-gray-700 rounded text-center">編輯</div></nuxt-link>
                <button @click="delete_post()" class="p-6 bg-red-300 hover:bg-red-200 text-gray-700 rounded text-center">刪除</button>
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
    methods: {
        delete_post(){
            let _this = this;
            this.swal.fire({
                title            : '確定要刪除此貼文?',
                confirmButtonText: '確定',
                cancelButtonText : '取消',
                icon             : 'question',
                showCancelButton : true,
            }).then(function (result) {
                if (result.isConfirmed) {
                    _this.$axios
                        .delete(`${process.env.backend_url}/api/posts/${_this.$route.params.id}`)
                        .then(function (response) {
                            _this.swal.fire({
                                title            : '刪除成功',
                                confirmButtonText: '確定',
                                icon             : 'success'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.href = '/';
                                }
                            });
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            })
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