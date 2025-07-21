import { createRouter, createWebHistory } from 'vue-router'
import Home from '../pages/Home.vue'
import LearnMore from '../components/LearnMoreSection.vue'
import About from '../components/AboutSection.vue'
import Products from '../components/ProductsSection.vue'
import News from '../components/NewsSection.vue'
import Careers from '../components/CareersSection.vue'
import JobCareers from '../components/JobCareers.vue'
import FeaturedNews from '../components/FeaturedNews.vue'
<<<<<<< HEAD
=======
import CareerDetail from '../components/CareersSection.vue'
>>>>>>> 748e7bf2a6124eb797a98944b39b92ba233f718c

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
<<<<<<< HEAD
    }
=======
    },
    {
        path: '/careers-job',
        name: 'career-detail',
        component: CareerDetail
    },
>>>>>>> 748e7bf2a6124eb797a98944b39b92ba233f718c
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