<script setup>

const API_HOST = import.meta.env.VITE_API_HOST;
const props = defineProps({
    data: Object,
});

</script>

<template>
    <div class="overflow-hidden transition-shadow duration-300 bg-white">
        <img :src="API_HOST + props.data?.image" class="object-cover w-full h-64" alt="" />
        <div class="py-5">
            <h4
                class="inline-block mb-3 text-lg font-bold leading-5 transition-colors duration-200 hover:text-deep-purple-accent-700">
                {{ props.data?.title }}</h4>
            <p class="mb-2 text-gray-700 text-sm">
                {{ props.data?.description }}
            </p>
            <button type="button" @click="$emit('allowPost', props.data.id)"
                class="py-2.5 w-full px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 uppercase">allow</button>
        </div>
    </div>
</template>