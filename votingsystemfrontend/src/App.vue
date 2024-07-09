<template>
  <div>
    <AuthNavbar />
    <router-view />
  </div>
</template>

<script>
import AuthNavbar from "./components/AuthNavbar.vue";

export default {
  name: "App",
  components: {
    AuthNavbar,
  },
};
</script>

<style>
/* Add your styles here */
</style>
