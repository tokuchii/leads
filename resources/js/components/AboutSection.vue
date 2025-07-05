<template>
    <!-- About Section -->
    <section id="about" class="relative min-h-screen bg-about bg-cover bg-center bg-no-repeat flex items-center">
        <div class="container mx-auto px-6 pt-12 pb-0">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <!-- Left Column: Text Content -->
                <div class="text-container">
                    <div class="flex items-center mb-1">
                        <span class="w-0.5 h-0.5 bg-green-200 rounded-full mr-0.5"></span>
                        <span class="w-1 h-1 bg-green-400 rounded-full mr-0.5"></span>
                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-0.5"></span>
                        <span class="w-2 h-2 bg-green-600 rounded-full mr-1"></span>
                        <h2 class="text-1xl font-bold text-[#2E7D32] tracking-widest uppercase">ABOUT US</h2>
                    </div>
                    <h3 class="text-2xl md:text-3xl lg:text-6xl font-extrabold text-[#2E7D32] leading-tight mb-2">
                        STARTED BY FILIPINOS
                    </h3>
                    <h3 class="text-2xl md:text-4xl lg:text-7xl font-extrabold outline-text leading-tight mb-6 text-[#2E7D32]">
                        FOR THE FILIPINOS
                    </h3>
                    <p class="text-[#2E7D32] text-lg mb-8 leading-relaxed">
                        Since 1997, Leads Agricultural Products Corp. (LAPC) has been the partner of Filipino farmers in sustaining their livelihood. For almost three decades now, Leads Agri has been nurturing the vision of a developed agricultural system with farmers at the forefront of its advocacies.
                    </p>
                    <a href="#" @click.prevent="$emit('show-learn-more')" class="text-[#2E7D32] text-base font-medium hover:underline">LEARN MORE.</a>
                </div>
            </div>
        </div>
    </section>
</template>
<script>
export default {
    name: 'AboutSection',
};
</script> 