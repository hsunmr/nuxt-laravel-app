<template>
    <div>
        <Form page_title="新增貼文" :title="title" :content="content" @confirm="submit"/>
    </div>
</template>
<script>
export default {
    data(){
        return {
            title  : '',
            content: ''
        }
    },
    methods: {
        submit(title, content){
            this.$axios
                .post(`${process.env.backend_url}/api/posts`, {
                    title  : title,
                    content: content,
                })
                .then(function (response) {
                    alert('新增成功');
                    location.href = '/';
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    },
    middleware({ store, redirect }) {
        if (!store.state.auth.loggedIn) {
            return redirect('/login')
        }
    }
}
</script>