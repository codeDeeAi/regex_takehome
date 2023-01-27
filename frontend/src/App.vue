<script setup>
import { RouterLink, RouterView } from 'vue-router'
import NavBar from './components/NavBar.vue'

</script>

<template>
  <NavBar />
  <main class="mt-16 container items-center mx-auto">
    <RouterView />
  </main>
</template>

<style scoped>

</style>
