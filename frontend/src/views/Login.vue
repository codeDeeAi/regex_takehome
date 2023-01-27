<script setup>
import { ref } from 'vue';
import axios from '../config/axios';
import { notify } from '../config/notification';
import useAuthStore from '../stores/auth';
import { useRouter } from 'vue-router'

const router = useRouter();
const isLoginTab = ref(true);
const isSigningUp = ref(false);
const isLoggingIn = ref(false);
const loginForm = ref({
    email: "",
    password: ""
});
const signupForm = ref({
    email: "",
    password: "",
    password_confirmation: "",
    is_admin: false
});

const signUp = async () => {
    // Validations
    if (signupForm.value.email.trim().length == 0) return notify('Email is required', 'error');
    if (signupForm.value.password.trim().length == 0) return notify('Password is required', 'error');
    if (signupForm.value.password.trim().length < 6) return notify('Password cannot be less than 6 characters', 'error');
    if (signupForm.value.password_confirmation !== signupForm.value.password) return notify('passwords should be identical', 'error');

    // Load Parameters
    isSigningUp.value = true;
    await axios
        .post("api/register", signupForm.value)
        .then((response) => {
            notify("User created sucessfully!", "success");
            signupForm.value = {
                email: "",
                password: "",
                password_confirmation: "",
                is_admin: false
            };
        })
        .catch((error) => {
            var message = "Something went wrong !";
            if (error && error.response.status == 422) {
                let errs = error.response.data.errors;
                for (let i in errs) {
                    var err = errs[i][0];
                    notify(err, "error");
                }
                return;
            }
            notify(message, 'error');
        }).finally(() => {
            isSigningUp.value = false;
        });
}

const login = async () => {
    // Validations
    if (loginForm.value.email.trim().length == 0) return notify('Email is required', 'error');
    if (loginForm.value.password.trim().length == 0) return notify('Password is required', 'error');

    // Load Parameters
    isLoggingIn.value = true;
    await axios
        .post("api/login", loginForm.value)
        .then((response) => {
            useAuthStore().setUser(response.data.data);
            notify("Logged in sucessfully!", "success");
            router.push({ name: 'home' })          
        })
        .catch((error) => {
            var message = "Something went wrong !";
            if (error && error.response.status == 422) {
                let errs = error.response.data.errors;
                for (let i in errs) {
                    var err = errs[i][0];
                    notify(err, "error");
                }
                return;
            }
            notify(message, 'error');
        }).finally(() => {
            isLoggingIn.value = false;
        });
}

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
                    <label class="block mb-2 font-medium text-center uppercase text-gray-900 dark:text-white">
                        email</label>
                    <input type="email"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="email@xyz.com" v-model="loginForm.email" required>
                </div>
                <div class="mb-6">
                    <label class="block mb-2 font-medium text-center uppercase text-gray-900 dark:text-white">
                        password</label>
                    <input type="password"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        v-model="loginForm.password" required autocomplete="password">
                </div>
                <button type="button"
                    class="text-white w-full bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full uppercase px-5 py-2.5 mr-2 mb-2"
                    :disabled="isLoggingIn"
                    @click="login()">
                    {{ (isLoggingIn) ? 'Loading ...' : 'Sign In' }}</button>
            </form>
        </div>
        <!-- Signup form -->
        <div v-if="!isLoginTab" class="flex justify-center my-6">
            <form class="w w-64">
                <div class="mb-6">
                    <label class="block mb-2 font-medium text-center uppercase text-gray-900 dark:text-white">
                        email</label>
                    <input type="email"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="email@xyz.com" v-model="signupForm.email" required>
                </div>
                <div class="mb-6">
                    <label class="block mb-2 font-medium text-center uppercase text-gray-900 dark:text-white">
                        password</label>
                    <input type="password"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        v-model="signupForm.password" required>
                </div>
                <div class="mb-6">
                    <label class="block mb-2 font-medium text-center uppercase text-gray-900 dark:text-white">Repeat
                        password</label>
                    <input type="password"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        v-model="signupForm.password_confirmation" required autocomplete="new-password">
                </div>
                <div class="flex items-start mb-6">
                    <div class="flex items-center h-5">
                        <input id="is_admin" type="checkbox"
                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-blue-300"
                            v-model="signupForm.is_admin" required autocomplete="new-password">
                    </div>
                    <label for="is_admin" class="ml-2 text-sm font-medium text-gray-900 uppercase">is admin</label>
                </div>
                <button type="button" @click="signUp()" :disabled="isSigningUp"
                    class="text-white w-full bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full uppercase px-5 py-2.5 mr-2 mb-2">
                    {{ (isSigningUp) ? 'Loading ...' : 'Sign Up' }}</button>
            </form>
        </div>
    </section>
</template>
