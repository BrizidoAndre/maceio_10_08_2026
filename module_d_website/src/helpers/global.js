import {ref, watch} from "vue";
import localRaw from '@/data/locals.json';
import informationRaw from '@/data/informations.json';

export const information = ref(informationRaw);
export const local = ref(localRaw);

export const trips = ref([]);
syncStorage(trips, 'trips');

export function getRelatedInfo(local) {
    return information.value.find(i => i['country-code'] === local.code)
}

function syncStorage(value, key) {
    const localKey = key + '_andre_module_d';
    if (localStorage[localKey]) {
        value.value = JSON.parse(localStorage[localKey]);
    }
    watch(value, value => {
        localStorage[localKey] = JSON.stringify(value);
    }, {
        deep:true,
    })
}