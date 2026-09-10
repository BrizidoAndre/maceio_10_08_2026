import {createRouter, createWebHistory} from 'vue-router'
import LoginView from '../views/LoginView.vue'
import AboutView from "@/views/AboutView.vue";
import {token} from "@/helpers/global.js";
import HomeView from "@/views/HomeView.vue";
import CustomerWalletView from "@/views/CustomerWalletView.vue";
import MyProfileView from "@/views/MyProfileView.vue";
import MyCartView from "@/views/MyCartView.vue";
import MovieSingle from "@/views/MovieSingle.vue";
import SessionSingleView from "@/views/SessionSingleView.vue";
import CombosView from "@/views/CombosView.vue";
import OrdersView from "@/views/OrdersView.vue";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'Home',
            component: HomeView,
            meta: {
                login: true,
            }
        },
        {
            path: '/movies/:id',
            name: 'movie_single',
            component: MovieSingle,
            meta: {
                login: true,
            },
            props: true,
        },
        {
            path: '/sessions/:id',
            name: 'session_single',
            component: SessionSingleView,
            meta: {
                login: true,
            },
            props: true,
        },
        {
            path: '/sessions/:id/combos',
            name: 'combos',
            component: CombosView,
            meta: {
                login: true,
            },
            props: true,
        },
        {
            path: '/login',
            name: 'Login',
            component: LoginView,
        },
        {
            path: '/about',
            name: 'about',
            component: AboutView,
            meta: {
                login: true,
            }
        },
        {
            path: '/wallet/:id',
            name: 'wallet',
            component: CustomerWalletView,
            meta: {
                login: true,
            },
            props: true,
        },
        {
            path: '/orders',
            name: 'orders',
            component: OrdersView,
            meta: {
                login: true,
            },
            props: true,
        },
        {
            path: '/profile',
            name: 'profile',
            component: MyProfileView,
            meta: {
                login: true,
            }
        },
        {
            path: '/cart/:id',
            name: 'cart',
            component: MyCartView,
            meta: {
                login: true,
            },
            props: true,
        },
    ],
})

router.beforeEach((to, from) => {
    if (to.meta?.login && !token.value) {
        return {
            name: 'Login',
        }
    }
    return true;
})

export default router
