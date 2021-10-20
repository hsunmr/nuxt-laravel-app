<template>
  <div>
    <div v-if="this.$auth.loggedIn">
      <b>Hi {{this.$auth.user.name}}</b>
      <nuxt-link to="login">登入</nuxt-link>
    </div>
    <div v-else>
      <nuxt-link to="login">登入</nuxt-link>
    </div>
  </div>


</template>

<script>
export default {
}
</script>
