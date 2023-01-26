import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import Login from '../views/Login.vue'
import Favourites from '../views/Favourites.vue'
import UploadImage from '../views/UploadImage.vue'
import ImageModeration from '../views/ImageModeration.vue'

const router = createRouter({
    history: createWebHistory(
        import.meta.env.BASE_URL),
    routes: [{
            path: '/',
            name: 'home',
            component: HomeView
        },
        {
            path: '/login',
            name: 'login',
            component: Login
        },
        {
            path: '/favourites',
            name: 'favourites',
            component: Favourites
        },
        {
            path: '/upload-image',
            name: 'upload-image',
            component: UploadImage
        },
        {
            path: '/image-moderation',
            name: 'image-moderation',
            component: ImageModeration
        },
    ]
})

export default router