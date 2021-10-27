<template>
  <div class="relative container mx-auto h-full w-full sm:w-5/6 md:w-3/6 bg-gray-100 pt-10" style="min-height:calc(100vh - 64px);top:70px">
    <div v-for="(post, index) in posts" :key="index" class="w-full justify-center items-center bg-white shadow-lg rounded-lg border-2 mt-2 mb-2">
      <nuxt-link :to="`posts/${post.id}`">
        <div class="w-full p-4">
          <h1 class="border-b-2 border-yellow-400 font-bold">{{post.title}}</h1>
          <p class="my-4 post_content">{{post.content}}</p>
          <div class="post_info">
            <p class="text-right">{{post.user.name}}</p>
          </div>
        </div>
      </nuxt-link>
    </div>
  </div>
</template>
<style>
.post_content{
  display           : -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 6;
  text-overflow     : ellipsis;
  overflow          : hidden;
}
</style>
<script>
import axios from 'axios';
export default {
  data() {
    return {
      posts : []
    }
  },
  async asyncData() {
    let { data } = await axios.get('http://localhost:8000/api/posts');

    return {
      posts : data
    }
  }
}
</script>
