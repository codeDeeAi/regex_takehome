import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

/**
 * Notify Toast 
 * @param {String} message 
 * @param {optionsType} type 
 */
const notify = (message, type = 'success') => {
    const config = {
        autoClose: 2000,
    };

    switch (type) {
        case 'success':
            toast.success(message, config)
            break;
        case 'info':
            toast.info(message, config)
            break;
        case 'warn':
            toast.warn(message, config)
            break;
        case 'error':
            toast.error(message, config)
            break;

        default:
            toast.success(message, config)
            break;
    }
};

/**
 * Clear Notification 
 */
const notifyClear = () => {
    toast.remove();
}

/**
 * Clear Notifications
 */
const notifyClearAll = () => {
    toast.clearAll();
}

export {
    notify,
    notifyClear,
    notifyClearAll
};