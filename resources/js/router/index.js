import { createRouter, createWebHistory } from 'vue-router'
import Hero from '../components/Hero.vue'
import About from '../components/About.vue'
import Products from '../components/Products.vue'
import News from '../components/News.vue'
import Careers from '../components/Careers.vue'

const routes = [
    {
        path: '/',
        name: 'home',
        component: Hero
    },
    {
        path: '/about',
        name: 'about',
        component: About
    },
    {
        path: '/products',
        name: 'products',
        component: Products
    },
    {
        path: '/news',
        name: 'news',
        component: News
    },
    {
        path: '/careers',
        name: 'careers',
        component: Careers
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition
        } else if (to.hash) {
            return {
                el: to.hash,
                behavior: 'smooth'
            }
        } else {
            return { top: 0, behavior: 'smooth' }
        }
    }
})

export default router 