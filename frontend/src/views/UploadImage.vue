<script setup lang="ts">
</script>

<template>
    <section>
        <h1 class="text-center text-2xl font-bold uppercase pt-6">
            <span>upload your image</span>
        </h1>

        <!-- Upload form -->
        <div class="flex justify-center my-6">
            <form class="w w-64">
                <div class="mb-6">
                    <label for="email"
                        class="block mb-2 font-medium text-center uppercase text-gray-900 dark:text-white">
                        email</label>
                    <input type="text" id="title"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                </div>
                <div class="mb-6">
                    <label for="description"
                        class="block mb-2 font-medium text-center uppercase text-gray-900 dark:text-white">
                        description</label>
                    <input type="text" id="description"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                </div>
                <button type="button"
                    class="text-white w-full bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full uppercase px-5 py-2.5 mr-2 mb-2">Upload</button>
            </form>
        </div>
    </section>
</template>
