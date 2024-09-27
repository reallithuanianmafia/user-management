<!-- resources/js/components/AddUser.vue -->
<template>
    <form @submit.prevent="addUser">
      <input type="text" v-model="name" placeholder="Name" required />
      <input type="email" v-model="email" placeholder="Email" required />
      <input type="password" v-model="password" placeholder="Password" required />
      <input type="file" @change="handleFileUpload" />
      <button type="submit">Add User</button>
    </form>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import axios from 'axios';
  
  const name = ref('');
  const email = ref('');
  const password = ref('');
  const file = ref(null);
  
  const handleFileUpload = (event) => {
    file.value = event.target.files[0];
  };
  
  const addUser = async () => {
    const formData = new FormData();
    formData.append('name', name.value);
    formData.append('email', email.value);
    formData.append('password', password.value);
    if (file.value) {
      formData.append('profile_image', file.value);
    }
  
    try {
      await axios.post('/api/users', formData);
      alert('User added successfully!');
    } catch (error) {
      console.error('Error adding user:', error);
    }
  };
  </script>
  