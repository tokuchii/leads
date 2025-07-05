<template>
    <!-- News Section -->
    <section id="news" class="bg-white py-10">
        <div class="container mx-auto px-12 mt-22">
            <h2 class="text-3xl sm:text-5xl md:text-5xl lg:text-5xl font-extrabold mb-20 text-center text-[#2E7D32]" style="letter-spacing: 2px;">FEATURED NEWS</h2>
            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                <div class="bg-[#2E7D32] rounded-2xl overflow-hidden shadow-lg flex flex-col h-full">
                    <img src="https://images.unsplash.com/photo-1625246333195-78d9c38ad449?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                         alt="News 1"
                         class="w-11/12 h-48 object-cover rounded-2xl mx-auto mt-4">
                    <div class="p-6 flex flex-col flex-1">
                        <h3 class="text-base font-bold mb-4 text-white uppercase">LAPC PARTICIPATES IN GLOBE BUSINESS' MINDHIVE 2024</h3>
                        <p class="text-white text-base mb-4 flex-1 news-description-clamp">
                            On November 13th, 2025, Leads Agricultural Products Corporation (LAPC) had the privilege of being invited to participate in the highly anticipated Globe Business Mindhive Innovation Bootcamp 2024.
                        </p>
                        <a href="#" @click.prevent="$emit('show-featured-news')" class="news-learnmore-btn self-start text-xs sm:text-sm md:text-base">LEARN MORE.</a>
                    </div>
                </div>
                <div class="bg-[#2E7D32] rounded-2xl overflow-hidden shadow-lg flex flex-col h-full">
                    <img src="https://images.unsplash.com/photo-1523741543316-beb7fc7023d8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                         alt="News 2"
                         class="w-11/12 h-48 object-cover rounded-2xl mx-auto mt-4">
                    <div class="p-6 flex flex-col flex-1">
                        <h3 class="text-base font-bold mb-4 text-white uppercase">SUSTAINABLE FARMING PRACTICES</h3>
                        <p class="text-white text-base mb-4 flex-1 news-description-clamp">
                            Discover how our new sustainable farming practices are helping farmers reduce environmental impact and improve crop yields for a greener future.
                        </p>
                        <a href="#" @click.prevent="$emit('show-featured-news')" class="news-learnmore-btn self-start text-xs sm:text-sm md:text-base">LEARN MORE.</a>
                    </div>
                </div>
                <div class="bg-[#2E7D32] rounded-2xl overflow-hidden shadow-lg flex flex-col h-full">
                    <img src="https://images.unsplash.com/photo-1625246333195-78d9c38ad449?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80"
                         alt="News 3"
                         class="w-11/12 h-48 object-cover rounded-2xl mx-auto mt-4">
                    <div class="p-6 flex flex-col flex-1">
                        <h3 class="text-base font-bold mb-4 text-white uppercase">AI IN AGRICULTURE</h3>
                        <p class="text-white text-base mb-4 flex-1 news-description-clamp">
                            Exploring the impact of artificial intelligence on modern agricultural practices and future trends in the industry.
                        </p>
                        <a href="#" @click.prevent="$emit('show-featured-news')" class="news-learnmore-btn self-start text-xs sm:text-sm md:text-base">LEARN MORE.</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
export default {
    name: 'NewsSection',
};
</script> 