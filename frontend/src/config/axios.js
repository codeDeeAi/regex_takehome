import axios from "axios";
import { notify } from './notification';
import useAuthStore from '../stores/auth';

axios.defaults.baseURL =
    import.meta.env.VITE_API_HOST;
axios.defaults.withCredentials = true;
axios.defaults.headers.common["Accept"] = "application/json";
axios.defaults.headers.common["Content-Type"] = "application/json";

axios.interceptors.request.use((config) => {
    const authStore = useAuthStore();
    config.headers.Authorization = `Bearer ${authStore.getBearerToken}`;
    config.headers.Accept = "application/json";
    return config;
});

// Add a response interceptor
axios.interceptors.response.use(
    function(response) {
        return response;

    },
    function(error) {
        if (error && error.response && error.response.status == 419) {
            notify("CSRF mismatch !", "error");
            return router.push({ name: "Login" });
        }
        if (error && error.response && error.response.status == 422) {
            var errs = error.response.data.errors;
            for (let i in errs) {
                var err = errs[i][0];
                // Alert User
                notify(err, "error");
            }
        }
        return Promise.reject(error);
    }
);

export default axios;