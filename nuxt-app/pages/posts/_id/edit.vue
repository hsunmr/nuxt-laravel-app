<template>
    <div>
        <Form page_title="編輯貼文" :title="title" :content="content" @confirm="submit"/>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    data(){
        return {
            title  : '',
            content: ''
        }
    },
    async asyncData({ store, redirect, route, env }) {
        let { data } = await axios.get(`${env.backend_url}/api/posts/${route.params.id}`);

        // not user
        if (store.state.auth.user.id != data.user.id) {
           return redirect('/')
        }

        return {
            title  : data.title,
            content: data.content
        }
    },
    methods: {
        submit(title, content){
            this.$axios
                .put(`${process.env.backend_url}/api/posts/${this.$route.params.id}`, {
                    title  : title,
                    content: content,
                })
                .then(function (response) {
                    alert('更新成功');
                    location.href = '/';
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    },
    middleware({ store, redirect, route }) {
        if (!store.state.auth.loggedIn) {
            return redirect('/login')
        }
    }
}
</script>