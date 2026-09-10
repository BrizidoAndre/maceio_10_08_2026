import {createRouter, createWebHistory} from 'vue-router'
import HomeView from '../views/HomeView.vue'
import KanbanView from "@/views/KanbanView.vue";
import StatisticsView from "@/views/StatisticsView.vue";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomeView,
        },
        {
            path: '/kanban',
            name: 'kanban',
            component: KanbanView,
        },
        {
            path: '/statistics',
            name: 'statistics',
            component: StatisticsView,
        },
    ],
    linkActiveClass: 'text-bg-primary'
})

export default router
