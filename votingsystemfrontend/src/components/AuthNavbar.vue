<template>
  <nav class="bg-gray-800 p-4">
    <div class="container mx-auto">
      <div class="flex justify-between items-center">
        <h1 class="text-white text-lg">Voting System</h1>
        <div>
          <router-link to="/login" class="text-white px-3">Login</router-link>
          <router-link to="/register" class="text-white px-3"
            >Register</router-link
          >
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: "AuthNavbar",
};
</script>
