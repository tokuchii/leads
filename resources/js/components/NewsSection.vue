<template>
    <!-- News Section -->
    <section id="news" class="bg-white py-10">
        <div class="container mx-auto px-12 mt-22">
            <h2 class="text-3xl sm:text-5xl md:text-5xl lg:text-5xl font-extrabold mb-20 text-center text-[#2E7D32]"
                style="letter-spacing: 2px;">FEATURED NEWS</h2>

     <!-- Loader while fetching -->
            <div v-if="loading" class="flex justify-center items-center py-16">
                <div class="flex space-x-2">
                    <div class="w-3 h-3 bg-green-600 rounded-full animate-bounce"></div>
                    <div class="w-3 h-3 bg-green-600 rounded-full animate-bounce [animation-delay:-0.2s]"></div>
                    <div class="w-3 h-3 bg-green-600 rounded-full animate-bounce [animation-delay:-0.4s]"></div>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                <div v-for="news in newsList.slice(0, 3)" :key="news.id"
                    class="bg-[#2E7D32] rounded-2xl overflow-hidden shadow-lg flex flex-col h-full">

                    <img :src="news.featured_image_url || '/public/images/newsimg.png'" :alt="news.title"
                        class="w-11/12 h-48 object-cover rounded-2xl mx-auto mt-4">
                    <div class="p-6 flex flex-col flex-1">
                        <h3 class="text-base font-bold mb-4 text-white uppercase">{{ news.title }}</h3>
                        <p class="text-white text-base mb-4 flex-1 news-description-clamp">
                            {{ trimContent(news.content) }}
                        </p>
                        <button @click="$emit('show-news-article', news)"
                            class="news-learnmore-btn cursor-pointer self-start text-xs sm:text-sm md:text-base underline">LEARN
                            MORE.</button>
                    </div>
                </div>
            </div>
            <div class="text-center mt-10">
                <button @click="$emit('show-featured-news')"
                    class="bg-[#2E7D32] hover:bg-[#27692b] text-white font-bold py-2 px-6 rounded-lg cursor-pointer transition duration-200 text-sm sm:text-base">
                    SEE MORE
                </button>
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
            loading: true,
            pollInterval: null,
        };
    },
    computed: {
        limitedNewsList() {
            return this.newsList.slice(0, 3);
        }
    },
    methods: {
        async fetchNews() {
            try {
                const response = await axios.get('https://admin.leadsagri.site/api/news');
                this.newsList = response.data;
            } catch (error) {
                console.error('Failed to fetch news:', error);
            } finally {
                this.loading = false;
            }
        },
        trimContent(content) {
            if (!content) return '';
            const maxLength = 250;
            return content.length > maxLength ? content.slice(0, maxLength) + '...' : content;
        },
        goToArticle(id) {
            this.$router.push({ name: 'news-article', params: { id } });
        },
    },
    mounted() {
        this.fetchNews();
    },
    beforeUnmount() {
        if (this.pollInterval) clearInterval(this.pollInterval);
    },
};
</script>
