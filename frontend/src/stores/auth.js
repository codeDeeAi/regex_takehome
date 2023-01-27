import { ref, computed } from 'vue';
import { defineStore } from 'pinia';
import { useRouter } from 'vue-router';
import axios from '../config/axios';
import { notify } from '../config/notification';

const router = useRouter();

const useAuthStore = defineStore('auth', () => {
    const user = ref(null);

    const logout = async() => {
        await axios
            .get("api/logout")
            .then(() => {
                setUser(null);
                notify("Logged out sucessfully!", "success");
                router.push({ name: 'home' })
            })
            .catch((error) => {}).finally(() => {});

    };

    const getBearerToken = computed(() => {
        if (user.value !== null) {
            return user.value.token;
        }
        return '';
    });

    const getUser = computed(() => {
        return user.value;
    });

    const isLoggedIn = computed(() => {
        return (user.value !== null) ? true : false;
    });

    const setUser = (data) => {
        user.value = data;
        return;
    };

    const canAdminAccess = computed(() => {
        return (user.value !== null && user.value.role == 'admin') ? true : false;
    });

    return { logout, setUser, getBearerToken, getUser, isLoggedIn, canAdminAccess }
}, {
    persist: true,
}, );


export default useAuthStore;