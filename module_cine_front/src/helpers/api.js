import {computed} from "vue";
import {loading, token} from "@/helpers/global.js";
import {addAlert} from "@/helpers/addAlert.js";

export const api_url = 'http://10.83.10.119/cinema_api/public/api/';
const apiHeaders = computed(() => {
    const headers = new Headers();
    headers.append('Accept', 'application/json');
    headers.append('Content-type', 'application/json');
    if (token.value) {
        headers.append('Authorization', 'Bearer ' + token.value);
    }
    return headers;
});

export async function request(url, options) {
    loading.value = true;
    try {
        const res = await fetch(api_url + url, {
            headers: apiHeaders.value,
            ...options,
        })
        let data = null;
        if (res.status !== 204) {
            data = await res.json();
        }
        console.log(data);
        if (!res.ok) {
            if (data.message) {
                addAlert(data.message, 'danger');
            }
            return [null, null];
        }
        return [res, data];
    } catch (e) {
        return [null, null];
    } finally {
        loading.value = false;
    }
}

export const api = {
    get: async (url) => {
        return await request(url, {
            method: 'GET'
        });
    },
    post: async (url, body) => {
        return await request(url, {
            body: JSON.stringify(body),
            method: 'POST',
        })
    },
}