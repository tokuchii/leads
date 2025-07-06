import { createRouter, createWebHistory } from 'vue-router'
import Home from '../pages/Home.vue'
import LearnMore from '../LearnMore.vue'
import Hero from '../components/Hero.vue'
import About from '../components/About.vue'
import Products from '../components/Products.vue'
import News from '../components/News.vue'
import Careers from '../components/Careers.vue'
import JobCareers from '../components/JobCareers.vue'
import FeaturedNews from '../components/FeaturedNews.vue'
import CareerDetail from '../components/CareerDetail.vue'

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home
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
    },
    {
        path: '/learn-more',
        name: 'learn-more',
        component: LearnMore
    },
    {
        path: '/job-careers',
        name: 'job-careers',
        component: JobCareers
    },
    {
        path: '/featured-news',
        name: 'featured-news',
        component: FeaturedNews
    },
    {
        path: '/careers-job',
        name: 'career-detail',
        component: CareerDetail
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