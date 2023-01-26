<script setup>
import { RouterLink, RouterView } from 'vue-router'
import { notify } from './config/notification';
import NavBar from './components/NavBar.vue'

notify('Heloo');
</script>

<template>
  <NavBar />
  <main class="mt-16 container items-center mx-auto">
    <RouterView />
  </main>
</template>

<style scoped>

</style>
