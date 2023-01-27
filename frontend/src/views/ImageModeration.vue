<script setup>
import { ref } from 'vue';
import ModerationCard from '../components/ModerationCard.vue';
import axios from '../config/axios';
import { notify } from '../config/notification';

const blogs = ref([]);

// Get all Blogs
const getBlogs = async () => {
  await axios
    .get(`api/moderation/blogs`)
    .then((response) => {
      blogs.value = response.data;
    })
    .catch((error) => {
      if (error.response.data.message) {
        notify(error.response.data?.message, 'error')
      }
      console.log(error.response)
    }).finally(() => {
    });
};

// Approve Blog
const approveBlog = async (blogId) => {
  await axios
    .patch(`api/approve/blog/${blogId}`)
    .then((response) => {
      let index = blogs.value.findIndex((item) => {
        return item.id == blogId;
      })
      blogs.value.splice(index, 1);
      notify('Post approved by admin', 'success');
      return;
    })
    .catch((error) => {
      if (error.response.data.message) {
        notify(error.response.data?.message, 'error')
      }
      notify('Error approving blog', 'error');
    }).finally(() => {
    });
};

getBlogs();

</script>

<template>
  <section>
    <div class="grid gap-2 grid-cols-6 p-4">
      <ModerationCard v-for="(post, index) in blogs" :key="index" :data="post" @allowPost="approveBlog" />
    </div>
  </section>
</template>
