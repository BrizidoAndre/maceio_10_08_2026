import {createRouter, createWebHistory} from 'vue-router'
import HomeView from '../views/HomeView.vue'
import ListLocationsView from "@/views/ListLocationsView.vue";
import LocationView from "@/views/LocationView.vue";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomeView,
        },
        {
            path: '/locations',
            name: 'locations',
            component: ListLocationsView,
        },
        {
            path: '/locations/:id',
            name: 'location-single',
            component: LocationView,
            props: true,
        },
    ],
    linkActiveClass: 'active'
})

export default router
