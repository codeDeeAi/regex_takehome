<script setup>
import { ref } from 'vue';
import axios from '../config/axios';
import { notify } from '../config/notification';

const formData = ref({
    title: '',
    description: '',
});

const image = ref(null);
const uploading = ref(false);
const upload_error = ref(false);
const preview = ref(false);
const preview_image = ref(null);
const open_preview_modal = ref(false);



// Select Images
const onFileSelected = (event) => {
    if (!event.target.files || event.target.files.length > 1) return;
    let selected = event.target.files[0];
    if (selected.size && selected.size > 5000000) return [notify('Image size too large (Size <= 5Mb)', 'error'), clearImage()] // Image size shouldn't exceed 2Mb (2*10^6 bytes)
    image.value = selected;
    return readImage(selected);
};

// Clear Image and Reader
const clearImage = () => {
    image.value = null;
    return;
};

// Image Reader
const readImage = (image) => {
    let reader = new FileReader();
    reader.readAsDataURL(image);
    reader.onload = (event) => {
        preview_image.value = event.target.result;
    };
    preview.value = true;
    return;
};

// Create Blog
const createBlog = async () => {
    // Validations
    if (formData.value.title.trim().length == 0) return notify('Title is required', 'error');
    if (formData.value.description.trim().length == 0) return notify('Description is required', 'error');
    if (!image.value) return (notify('Image is required !', 'error'));

    let form = new FormData();
    form.append("image", image.value);
    form.append("title", formData.value.title);
    form.append("description", formData.value.description);

    // Load Parameters
    uploading.value = true;
    upload_error.value = false
    await axios
        .post("api/blog", form, {
            onUploadProgress: (event) => {
            },
        })
        .then((response) => {
            console.log(response)
            notify("Post created !", "success");
            uploading.value = false;
            clearImage();
            return;

        })
        .catch((error) => {
            upload_error.value = true
            uploading.value = false
            var message = "Something went wrong !";
            if (error && error.response.status == 422) {
                let errs = error.response.data.errors;
                for (let i in errs) {
                    var err = errs[i][0];
                    notify(err, "error");
                }
                return;
            }
            return notify(message, 'error');
        }).finally(() => {
            uploading.value = false;
        });
};
</script>

<template>
    <section>
        <h1 class="text-center text-2xl font-bold uppercase pt-6">
            <span>upload your image</span>
        </h1>

        <!-- Upload form -->
        <div class="flex justify-center my-6">
            <form class="w-64">
                <!-- Preview Image -->
                <button type="button" @click="open_preview_modal = !open_preview_modal" v-if="preview"
                    class="mb-6 flex justify-center">
                    <img class="inline-block w-72 h-64" :src="(preview_image) ? preview_image : 'images/avatar.svg'" />
                </button>
                <!-- Image -->
                <div class="mb-6">
                    <label for="image"
                        class="block mb-2 font-medium text-center uppercase text-gray-900 dark:text-white">
                        upload image</label>
                    <input type="file" accept="image/*" ref="file" id="image" @change="onFileSelected"
                        class="shadow-sm bg-zinc-400  text-sm rounded-lg block w-full p-2.5" required>
                </div>

                <!-- Title -->
                <div class="mb-6">
                    <label for="title"
                        class="block mb-2 font-medium text-center uppercase text-gray-900 dark:text-white">
                        Title</label>
                    <input type="text" id="title" v-model="formData.title"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description"
                        class="block mb-2 font-medium text-center uppercase text-gray-900 dark:text-white">
                        description</label>
                    <input type="text" id="description" v-model="formData.description"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                </div>

                <!-- Submit -->
                <button type="button" @click="createBlog()" :disabled="uploading"
                    class="text-white w-full bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full uppercase px-5 py-2.5 mr-2 mb-2">{{
                    (uploading) ? 'uploading ...' : 'upload' }}</button>
            </form>
        </div>

        <!--Modal  -->
        <div v-if="open_preview_modal" class="relative z-10" aria-labelledby="modal-title" role="dialog"
            aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div
                        class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <div class="mb-6 flex justify-center">
                                        <img class="inline-block w-full h-full"
                                            :src="(preview_image) ? preview_image : 'images/avatar.svg'" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                            <button type="button" @click="open_preview_modal = !open_preview_modal"
                                class="mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-white px-4 py-2 text-base font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Modal Ends  -->
    </section>
</template>
