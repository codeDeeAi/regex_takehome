import { ref, computed } from 'vue'
import { defineStore } from 'pinia'

const useAuthStore = defineStore('blogs', () => {
    const blogs = ref([]);
    const uploading = ref(false);

    const isUploading = computed(() => {
        return uploading.value;
    });

    const getBlogs = computed(() => {
        return blogs.value;
    });

    return { getBlogs, isUploading }
}, {
    persist: true,
}, );


export default useAuthStore;