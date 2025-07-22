<template>
    <!-- News Section -->
    <section id="news" class="bg-white py-10">
        <div class="container mx-auto px-12 mt-22">
            <h2 class="text-3xl sm:text-5xl md:text-5xl lg:text-5xl font-extrabold mb-20 text-center text-[#2E7D32]" style="letter-spacing: 2px;">FEATURED NEWS</h2>
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                <div v-for="news in newsList" :key="news.id" class="bg-[#2E7D32] rounded-2xl overflow-hidden shadow-lg flex flex-col h-full">
                    <img :src="news.featured_image_url || '/public/images/newsimg.png'"
                         :alt="news.title"
                         class="w-11/12 h-48 object-cover rounded-2xl mx-auto mt-4">
                    <div class="p-6 flex flex-col flex-1">
                        <h3 class="text-base font-bold mb-4 text-white uppercase">{{ news.title }}</h3>
                        <p class="text-white text-base mb-4 flex-1 news-description-clamp">
                            {{ trimContent(news.content) }}
                        </p>
                        <a href="#" @click.prevent="$emit('show-featured-news')" class="news-learnmore-btn self-start text-xs sm:text-sm md:text-base">LEARN MORE.</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
import axios from 'axios';
export default {
    name: 'NewsSection',
    data() {
        return {
            newsList: [],
            pollInterval: null,
        };
    },
    methods: {
        async fetchNews() {
            try {
                const response = await axios.get('https://admin.leadsagri.site/api/news');
                this.newsList = response.data;
            } catch (error) {
                console.error('Failed to fetch news:', error);
            }
        },
        trimContent(content) {
            if (!content) return '';
            const maxLength = 250;
            return content.length > maxLength ? content.slice(0, maxLength) + '...' : content;
        },
    },
    mounted() {
        this.fetchNews();
        this.pollInterval = setInterval(this.fetchNews, 2000); // fetch every 2 seconds
    },
    beforeUnmount() {
        if (this.pollInterval) clearInterval(this.pollInterval);
    },
};
</script>
