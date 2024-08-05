import { createRouter, createWebHistory } from 'vue-router';

import Home from '../components/HomePage.vue';
import City from '../components/CityPage.vue';
import NotFound from '../components/NotFoundPage.vue';

const routes = [
    {
        path: '/',
        component: Home
    },
    {
        path: '/city/:name',
        name: 'CityPage',
        component: City,
        props: true
    },
    {
        path: '/:pathMatch(.*)*',
        component: NotFound
    },
]

const router = createRouter({
    history: createWebHistory(),
    linkExactActiveClass: 'active',
    routes,
})

export default router;
