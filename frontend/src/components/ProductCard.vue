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
            <p v-if="props.data.user !== null" class="mb-2 text-gray-700 text-xs text-right font-bold">
                Author: {{ props.data?.user?.email }}
            </p>
            <!-- <div class="inline-flex gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                </svg>
                <span class="my-auto">34</span>
            </div> -->
        </div>
    </div>
</template>