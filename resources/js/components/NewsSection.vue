<template>
    <!-- News Section -->
    <section id="news" class="bg-white py-10">
        <div class="container mx-auto px-12 mt-22">
            <h2 class="text-3xl sm:text-5xl md:text-5xl lg:text-5xl font-extrabold mb-20 text-center text-[#2E7D32]"
                style="letter-spacing: 2px;">FEATURED NEWS</h2>

            <BubbleLoader v-if="loading" />

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
  <div v-for="news in newsList.slice(0, 3)" :key="news.id"
       class="bg-[#2E7D32] rounded-2xl overflow-hidden shadow-lg flex flex-col h-full">

    <img :src="news.featured_image_url || '/public/images/newsimg.png'" :alt="news.title"
         class="w-11/12 h-32 sm:h-40 md:h-48 lg:h-48 object-cover rounded-2xl mx-auto mt-4">

    <div class="p-4 sm:p-6 flex flex-col flex-1">
      <h3 class="text-sm sm:text-base md:text-base font-bold mb-2 sm:mb-4 text-white uppercase">
        {{ news.title }}
      </h3>
      <RichTextContent
        :content="news.content"
        :max-length="250"
        class="text-xs sm:text-sm md:text-base mb-4 flex-1 text-white news-description-clamp break-words max-w-full min-w-0"
      />
<button @click="$emit('show-news-article', news)"
        class="news-learnmore-btn cursor-pointer self-start underline">
  LEARN MORE.
</button>

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
import BubbleLoader from './BubbleLoader.vue';
import RichTextContent from './RichTextContent.vue';

export default {
    name: 'NewsSection',
    components: { BubbleLoader, RichTextContent },
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
                const response = await axios.get('https://admin.leadsagri.com/api/news');
                // Ensure we have an array and sort by published date (newest first).
                const data = Array.isArray(response.data) ? response.data : [];
                this.newsList = data.sort((a, b) => {
                    const da = new Date(a.published_at || a.created_at || 0).getTime();
                    const db = new Date(b.published_at || b.created_at || 0).getTime();
                    return db - da;
                });
            } catch (error) {
                console.error('Failed to fetch news:', error);
            } finally {
                this.loading = false;
            }
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
