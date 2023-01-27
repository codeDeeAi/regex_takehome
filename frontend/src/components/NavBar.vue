<script setup>
import useAuthStore from '../stores/auth';
</script>

<template>
    <nav
        class="bg-white px-2 sm:px-4 py-2.5 dark:bg-gray-900 fixed w-full z-20 top-0 left-0 border-b border-gray-200 dark:border-gray-600">
        <div class="container flex flex-wrap items-center justify-between mx-auto">
            <router-link to="/" class="flex items-center">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-6 mr-3 sm:h-9" alt="Logo">
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">PROJECT NAME</span>
            </router-link>
            <div class="flex gap-2">
                <p v-if="useAuthStore().isLoggedIn">
                    {{ (useAuthStore().getUser.id) ? useAuthStore().getUser : '' }}
                </p>
                <router-link to="favourites"
                    class="py-2 px-5 text-sm font-medium inline-flex gap-3 text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 uppercase">
                    <span class="my-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                        </svg>

                    </span>
                    <span class="my-auto">favorites</span>
                </router-link>
                <router-link to="image-moderation" v-if="useAuthStore().canAdminAccess"
                    class="py-2 px-5 text-sm font-medium text-center text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 uppercase">
                    Moderation
                </router-link>
                <router-link to="upload-image"
                    class="py-2 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-gray-200 rounded-lg border border-gray-200 hover:bg-gray-300 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 uppercase">upload</router-link>
                <router-link to="login" v-if="!useAuthStore().isLoggedIn"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 focus:outline-none uppercase">login</router-link>
                <button v-if="useAuthStore().isLoggedIn" type="button" @click="useAuthStore().logout"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 focus:outline-none uppercase">logout</button>
            </div>
        </div>
    </nav>
</template>