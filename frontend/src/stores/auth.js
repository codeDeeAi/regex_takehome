import { ref, computed } from 'vue'
import { defineStore } from 'pinia'

const useAuthStore = defineStore('auth', () => {
    const user = ref(null);

    const login = () => {};
    const logout = () => {};

    const getBearerToken = computed(() => {
        if (typeof user.value === 'object') {
            return user.value.token;
        }
        return null;
    });

    const getUser = computed(() => {
        return user.value;
    });

    const isLoggedIn = computed(() => {
        return (user.value !== null) ? true : false;
    });

    return { login, logout, getBearerToken, getUser, isLoggedIn }
}, {
    persist: true,
}, );


export default useAuthStore;