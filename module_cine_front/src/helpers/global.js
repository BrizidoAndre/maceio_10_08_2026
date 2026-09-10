import {reactive, ref, watch} from "vue";

export const side = ref(false);
export const loading = ref(false);
export const token = ref(null);
export const user = ref(null);
export const globalSelectedSeats = ref([]);
export const globalCombo = ref([]);

export const movies = ref([]);

syncStorage(token, 'token');
syncStorage(user, 'user');
syncStorage(globalSelectedSeats, 'selected_seats');
syncStorage(globalCombo, 'combo');

// sync values to storage
export function syncStorage(value, local) {
    const localKey = local + '_BR_2026';
    if (localStorage[localKey]) {
        value.value = JSON.parse(localStorage[localKey]);
    }
    watch(value, value => {
        localStorage[localKey] = JSON.stringify(value);
    }, {
        deep: true,
    })
}

// helper functions
export function formatStringDate(dateString) {
    if (!dateString) {
        return '';
    }
    return dateString.slice(0, 10) + ' ' + dateString.slice(11, 16)
}
export function formatValueToPrice(value) {
    if(value=== 0){
        return `R$0`;
    }
    value = String(value);
    const decimal = value.slice(value.length-2);
    const integers = value.slice(0,value.length-2);
    return `R$${integers},${decimal}`;
}