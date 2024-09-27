<!-- resources/js/components/UserList.vue -->
<template>
    <div>
      <ul>
        <li v-for="user in users" :key="user.id">{{ user.name }} - {{ user.email }}</li>
      </ul>
      <button @click="loadMore">Show more</button>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  
  const users = ref([]);
  const page = ref(1);
  
  const fetchUsers = async () => {
    try {
      const response = await axios.get(`/api/users?page=${page.value}`);
      users.value = [...users.value, ...response.data.data];
    } catch (error) {
      console.error('Error fetching users:', error);
    }
  };
  
  const loadMore = () => {
    page.value++;
    fetchUsers();
  };
  
  onMounted(fetchUsers);
  </script>
  