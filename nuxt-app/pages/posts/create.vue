<template>
    <div>
        <Form page_title="新增貼文" :title="title" :content="content" @confirm="submit" ref="post_form"/>
    </div>
</template>
<script>
import { ValidationProvider, ValidationObserver } from 'vee-validate';
export default {
    components: {
    ValidationProvider,
    ValidationObserver
  },
    data(){
        return {
            title  : '',
            content: ''
        }
    },
    methods: {
        submit(title, content){
            let _this = this;
            this.$axios
                .post(`${process.env.backend_url}/api/posts`, {
                    title  : title,
                    content: content,
                })
                .then(function (response) {
                    _this.swal.fire({
                        title            : '新增成功',
                        confirmButtonText: '確定',
                        icon             : 'success'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.href = '/';
                        }
                    });
                })
                .catch(function (error) {
                    if (error.response.data.errors) {
                        _this.$refs.post_form.setErrors(error.response.data.errors);
                        return;
                    }
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