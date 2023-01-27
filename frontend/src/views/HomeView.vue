<script setup>
import { ref } from 'vue';
import axios from '../config/axios';
import ProductCard from '../components/ProductCard.vue';

const blogs = ref([]);
const isLoading = ref(false);

// Get all Blogs
const getBlogs = async () => {
  isLoading.value = true;
  await axios
    .get(`api/blogs`)
    .then((response) => {
      blogs.value = response.data;
    })
    .catch((error) => {
    }).finally(() => {
      isLoading.value = false;
    });
};

getBlogs();
</script>

<template>
  <section>
    <div class="grid gap-2 grid-cols-6 p-4">
      <ProductCard v-for="(post, index) in blogs" :key="index" :data="post" />
    </div>
  </section>
</template>
