<!-- resources/js/App.vue -->
<template>
  <div id="app">
    <h1>User Management</h1>
    <user-list></user-list>
    <add-user></add-user>
  </div>
</template>

<script setup>
import UserList from './components/UserList.vue';
import AddUser from './components/AddUser.vue';
</script>

<style scoped>
/* Add global or scoped styles here if needed */
</style>
