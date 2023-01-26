<script setup lang="ts">
import { ref } from 'vue';

const isLoginTab = ref(true);
const loginForm = ref({
    email: "",
    password: ""
});
const signupForm = ref({
    email: "",
    password: "",
    confirmPassword: "",
    isAdmin: false
});

</script>

<template>
    <section>
        <h1 class="text-center text-2xl font-bold uppercase pt-6">
            <span v-if="isLoginTab">login</span>
            <span v-else>signup</span>
        </h1>

        <div class="flex justify-center mt-4 uppercase">
            <ul
                class="hidden text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg shadow sm:flex">
                <li class="w-full">
                    <button type="button" @click="isLoginTab = true"
                        class="inline-block w-full px-8 py-3  rounded-l-lg  uppercase"
                        :class="{ 'text-gray-900 bg-gray-100': isLoginTab, 'hover:text-gray-700 hover:bg-gray-50 ': !isLoginTab }">Login</button>
                </li>
                <li class="w-full">
                    <button type="button" @click="isLoginTab = false"
                        class="inline-block w-full px-8 py-3 bg-white rounded-r-lg uppercase"
                        :class="{ 'text-gray-900 bg-gray-100': !isLoginTab, 'hover:text-gray-700 hover:bg-gray-50 ': isLoginTab }">Signup</button>
                </li>
            </ul>
        </div>

        <!-- Login form -->
        <div v-if="isLoginTab" class="flex justify-center my-6">
            <form class="w w-64">
                <div class="mb-6">
                    <label for="email"
                        class="block mb-2 font-medium text-center uppercase text-gray-900 dark:text-white">
                        email</label>
                    <input type="email" id="email"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="email@xyz.com" v-model="loginForm.email" required>
                </div>
                <div class="mb-6">
                    <label for="repeat-password"
                        class="block mb-2 font-medium text-center uppercase text-gray-900 dark:text-white">
                        password</label>
                    <input type="password" id="repeat-password"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        v-model="loginForm.password" required>
                </div>
                <button type="button"
                    class="text-white w-full bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full uppercase px-5 py-2.5 mr-2 mb-2">Sign
                    in</button>
            </form>
        </div>
        <!-- Signup form -->
        <div v-if="!isLoginTab" class="flex justify-center my-6">
            <form class="w w-64">
                <div class="mb-6">
                    <label for="email"
                        class="block mb-2 font-medium text-center uppercase text-gray-900 dark:text-white">
                        email</label>
                    <input type="email" id="email"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="email@xyz.com" v-model="signupForm.email" required>
                </div>
                <div class="mb-6">
                    <label for="password"
                        class="block mb-2 font-medium text-center uppercase text-gray-900 dark:text-white">
                        password</label>
                    <input type="password" id="password"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        v-model="signupForm.password" required>
                </div>
                <div class="mb-6">
                    <label for="repeat-password"
                        class="block mb-2 font-medium text-center uppercase text-gray-900 dark:text-white">Repeat
                        password</label>
                    <input type="password" id="repeat-password"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        v-model="signupForm.confirmPassword" required>
                </div>
                <div class="flex items-start mb-6">
                    <div class="flex items-center h-5">
                        <input id="is_admin" type="checkbox"
                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300"
                            v-model="signupForm.isAdmin" required>
                    </div>
                    <label for="is_admin" class="ml-2 text-sm font-medium text-gray-900 uppercase">is admin</label>
                </div>
                <button type="button"
                    class="text-white w-full bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full uppercase px-5 py-2.5 mr-2 mb-2">Sign
                    Up</button>
            </form>
        </div>
    </section>
</template>
