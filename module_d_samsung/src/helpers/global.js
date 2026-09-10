import {ref, watch} from "vue";
import trainingRaw from '@/assets/data/training.json';
import collectionRaw from '@/assets/data/collection.json';

export const training = ref(trainingRaw);
export const collection = ref(collectionRaw);

export const darkTheme = ref(false);

syncStorage(darkTheme, 'dark');

// watch every dark theme change
watch(darkTheme, value => {
    document.body.dataset.bsTheme = value ? 'dark' : 'light';
}, {
    immediate: true,
})

syncStorage(training, 'training')
syncStorage(collection, 'collection')

// syncs values to local storage
export function syncStorage(value, key) {
    const localKey = 'br_2026_' + key;
    if (localStorage[localKey]) {
        value.value = JSON.parse(localStorage[localKey]);
    }

    watch(value, value => {
        localStorage[localKey] = JSON.stringify(value);
    }, {
        deep: true,
    })
}

// quick date formatter
export function formatDate(date, format) {
    return date.toLocaleDateString('en', format);
}

// date to string helpers
export function stringToDate(string) {
    const [year, month, day] = string.split('-').map(Number);
    return new Date(year, month - 1, day);
}

export function dateToString(date = new Date()) {
    return date.toISOString().slice(0, 10);
}

export function getRelatedCollection(eventName) {
    return collection.value.find(c => {
        return c.name === eventName
    });
}

export function getEventsFromDay(stringDate) {
    const days = training.value.days;
    let indexDay = null;
    const day = days.find((d, i) => {
        indexDay = i;
        return d.date === stringDate;
    });
    if (day === undefined) {
        return [[], null];
    }
    return [day.events, indexDay];
}