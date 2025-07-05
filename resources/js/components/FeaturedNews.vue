<template>
    <div class="featured-news relative w-full">
        <div class="relative">
            <!-- Responsive image height -->
            <img 
                src="/public/images/newsimg.png" 
                alt="Career Background" 
                class="featured-image w-full h-[350px] sm:h-[400px] md:h-[500px] lg:h-[600px] object-cover object-top z-0"
            >
            <div class="absolute inset-0 bg-[#004E27] opacity-55 z-10"></div>
            <div class="absolute inset-0 flex items-center justify-center z-20">
                <h1 class="text-white text-4xl sm:text-4xl md:text-4xl lg:text-6xl xl:text-6xl leading-tight text-center font-helvetica-heavy">
                    FEATURED NEWS
                </h1>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'FeaturedNews',
};
</script>