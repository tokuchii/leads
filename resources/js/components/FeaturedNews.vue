<template>
    <div class="featured-news relative w-full mt-26 px-8 py-8">
        <div class="relative">
            <img 
                src="/public/images/newsimg.png" 
                class="featured-image w-full h-[350px] sm:h-[400px] md:h-[500px] lg:h-[600px] object-cover object-top z-0"
            >
            <div class="absolute inset-0 bg-[#004E27] opacity-55 z-10"></div>
            <div class="absolute inset-0 flex items-center justify-center z-20">
                <h1 class="text-white text-4xl sm:text-4xl md:text-4xl lg:text-6xl xl:text-6xl leading-tight text-center font-helvetica-heavy">
                    FEATURED NEWS
                </h1>
            </div>
        </div>
        <div class="mt-8 font-light text-sm sm:text-sm md:text-sm lg:text-sm xl:text-sm text-start text-[#2E7D32]">
            <h3 class="text-xs sm:text-sm md:text-base">STAY UPDATED WITH ALL THINGS LEADS AGRI </h3>
            <h3 class="font-extrabold text-[#2E7D32] leading-tight text-4xl sm:text-xl md:text-5xl lg:text-5xl xl:text-5xl text-start">LATEST STORIES</h3>
        </div>
        <div class="mt-8 px-4">
            <div v-if="newsList.length" class="flex flex-col lg:flex-row gap-8 lg:gap-24 w-full justify-center max-w-7xl mx-auto">
                <!-- Left Column -->
                <div class="flex-1 flex flex-col gap-4 sm:gap-6 items-center lg:items-start min-h-[300px] sm:min-h-[400px] md:min-h-[500px]">
                    <div v-for="news in leftColumn" :key="news.id" class="w-full max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl relative mb-0">
                        <img :src="news.featured_image_url || '/public/images/newsimg.png'" alt="Story Image" class="w-full shadow-md rounded-tl-[20px] sm:rounded-tl-[30px] md:rounded-tl-[40px] rounded-br-[20px] sm:rounded-br-[30px] md:rounded-br-[40px] no-hover-effect" />
                        <div class="absolute left-0 news-featured-img bg-green-800 text-white text-center py-1 sm:py-2 px-4 sm:px-7 bottom-8 sm:bottom-10 md:bottom-12 min-w-[250px] sm:min-w-[300px]">
                        <h2 class="text-sm sm:text-base md:text-lg lg:text-xl font-bold">{{ news.title }}</h2>
                        </div>

                        <div class="w-full flex flex-col items-start -mt-6 sm:-mt-8 mb-0">
                            <span class="text-green-900 font-bold text-xs sm:text-sm md:text-base">{{ formatMonthYear(news.published_at) }}</span>
                            <div class="w-16 sm:w-20 md:w-25 h-0.5 mt-1 mb-2 sm:mb-4 rounded" style="background-color: #D3AF37;"></div>
                        </div>
                        <p class="text-xs sm:text-sm md:text-base font-light text-green-900 mb-2 text-start uppercase" v-html="trimContent(news.content)"></p>
                        <button
                          @click="$emit('show-news-article', news)"
                          class="text-[#D3AF37] text-xs sm:text-sm md:text-base font-medium hover:underline relative bg-transparent border-none cursor-pointer p-0"
                        >
                          READ MORE.
                        </button>
                    </div>
                </div>
                <!-- Right Column -->
                <div class="flex-1 flex flex-col gap-4 sm:gap-6 relative items-center lg:items-start min-h-[300px] sm:min-h-[400px] md:min-h-[500px]">
                    <div v-for="news in rightColumn" :key="news.id" class="w-full max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl relative mb-0">
                        <img :src="news.featured_image_url || '/public/images/newsimg.png'" alt="Story Image" class="w-full shadow-md rounded-tl-[20px] sm:rounded-tl-[30px] md:rounded-tl-[40px] rounded-br-[20px] sm:rounded-br-[30px] md:rounded-br-[40px] no-hover-effect" />
                        <div class="absolute left-0 news-featured-img bg-green-800 text-white text-center py-1 sm:py-2 px-2 sm:px-4 bottom-8 sm:bottom-10 md:bottom-12">
                            <h2 class="text-sm sm:text-base md:text-lg lg:text-xl font-bold">{{ news.title }}</h2>
                        </div>
                        <div class="w-full flex flex-col items-start -mt-6 sm:-mt-8 mb-0">
                            <span class="text-green-900 font-bold text-xs sm:text-sm md:text-base">{{ formatMonthYear(news.published_at) }}</span>
                            <div class="w-16 sm:w-20 md:w-25 h-0.5 mt-1 mb-2 sm:mb-4 rounded" style="background-color: #D3AF37;"></div>
                        </div>
                        <p class="text-xs sm:text-sm md:text-base font-light text-green-900 mb-2 text-start uppercase" v-html="trimContent(news.content)"></p>
                        <button
                          @click="$emit('show-news-article', news)"
                          class="text-[#D3AF37] text-xs sm:text-sm md:text-base font-medium hover:underline relative bg-transparent border-none cursor-pointer p-0"
                        >
                          READ MORE.
                        </button>
                    </div>
                    <!-- Overlay image at the bottom -->
                    <img v-if="showPandoy" src="/public/images/pandoy101.png" alt="pandoy101"
                         class="absolute left-1/2 -translate-x-1/2 bottom-[-16px] sm:bottom-[-24px] md:bottom-[-32px] w-full max-w-[200px] lg:max-w-[350px] xl:max-w-[350px] h-auto object-contain pointer-events-none z-20" />
                </div>
            </div>
            <div v-else class="w-full text-center text-gray-500 py-8">
                <p>No news found.</p>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    name: 'FeaturedNews',
    data() {
        return {
            newsList: [],
            screenWidth: window.innerWidth,
            pollInterval: null,
        };
    },
    computed: {
        leftColumn() {
            // Even indices: 0, 2, 4, ...
            return this.newsList.filter((_, idx) => idx % 2 === 0);
        },
        rightColumn() {
            // Odd indices: 1, 3, 5, ...
            return this.newsList.filter((_, idx) => idx % 2 === 1);
        },
        showPandoy() {
            // Show if newsList is odd and screenWidth >= 1025
            return this.newsList.length % 2 === 1 && this.screenWidth >= 1024;
        }
    },
    mounted() {
        this.fetchNews();
        window.addEventListener('resize', this.handleResize);
        this.pollInterval = setInterval(this.fetchNews, 2000); // fetch every 2 seconds
    },
    beforeUnmount() {
        window.removeEventListener('resize', this.handleResize);
        if (this.pollInterval) clearInterval(this.pollInterval);
    },
    methods: {
        async fetchNews() {
            try {
                const response = await axios.get('http://127.0.0.1:8000/api/news');
                this.newsList = response.data;
            } catch (error) {
                console.error('Failed to fetch news:', error);
            }
        },
        handleResize() {
            this.screenWidth = window.innerWidth;
        },
        formatMonthYear(dateString) {
            if (!dateString) return '';
            const date = new Date(dateString);
            if (isNaN(date)) return '';
            const month = date.toLocaleString('en-US', { month: 'long' }).toUpperCase();
            const year = date.getFullYear();
            return `${month} ${year}`;
        },
        trimContent(content) {
            if (!content) return '';
            const maxLength = 250;
            let trimmed = content.length > maxLength ? content.slice(0, maxLength) + '...' : content;
            // Add a breakline after every colon
            return trimmed.replace(/:/g, ':<br>');
        },
        goToArticle(id) {
            this.$router.push({ name: 'news-article', params: { id } });
        }
    },
};
</script>