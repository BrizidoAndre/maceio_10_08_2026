import {ref} from "vue";

export const alerts = ref([]);

export function addAlert(message, type = 'secondary') {
    const id = Math.random();
    alerts.value.push({
        id,
        message,
        type,
    })
    setTimeout(() => {
        alerts.value = alerts.value.filter(a => a.id !== id);
    }, 3000)
}