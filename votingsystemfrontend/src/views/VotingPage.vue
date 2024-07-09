<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
      <h2 class="text-2xl mb-6 text-center">Vote for Your Favorite Item</h2>
      <div class="space-y-4">
        <button
          v-for="item in items"
          :key="item"
          @click="submitVote(item)"
          class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700"
        >
          {{ item }}
        </button>
      </div>
      <div v-if="message" class="mt-6 text-center text-green-600">
        {{ message }}
      </div>
      <div v-if="error" class="mt-6 text-center text-red-600">
        {{ error }}
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      items: ["Option 1", "Option 2", "Option 3", "Option 4"],
      message: "",
      error: "",
    };
  },
  methods: {
    async submitVote(choice) {
      try {
        const response = await axios.post(
          "http://localhost:8000/api/vote",
          {
            choice: choice,
          },
          {
            headers: {
              Authorization: `Bearer ${localStorage.getItem("token")}`,
            },
          }
        );
        this.message = response.data.message;
        this.error = "";
      } catch (error) {
        this.error = error.response.data.message;
        this.message = "";
      }
    },
  },
};
</script>

<style>
.button {
  width: 100%;
  background-color: #1d4ed8;
  color: white;
  padding: 0.5rem;
  border-radius: 0.375rem;
  cursor: pointer;
  text-align: center;
  transition: background-color 0.2s;
}
.button:hover {
  background-color: #2563eb;
}
</style>
