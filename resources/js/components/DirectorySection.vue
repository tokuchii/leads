<template>
    <!-- Directory Section -->
    <section class="bg-white py-12 sm:py-16 md:py-20">
        <div class="container mx-auto px-4 md:px-8">
            <!-- Heading -->
            <h3 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-center text-[#004E27] mb-3 sm:mb-4"
                style="letter-spacing: 2px;">
                FIND US NATIONWIDE
            </h3>
            <p class="text-center text-[#706F6C] text-sm sm:text-base max-w-2xl mx-auto leading-relaxed mb-8 sm:mb-12">
                Browse our network of distributors and partners across the Philippines. Filter by region and
                area to find the nearest Leads Agri partner to you.
            </p>

            <!-- Region previews -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6 max-w-5xl mx-auto mb-8 sm:mb-12">
                <div v-for="region in regions" :key="region.name"
                    class="bg-white rounded-2xl shadow-md border-t-4 border-[#2E7D32] px-5 sm:px-6 py-6 sm:py-8 text-center">
                    <div class="mx-auto mb-3 sm:mb-4 w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-[#2E7D32] flex items-center justify-center">
                        <i class="fas fa-location-dot text-[#FFF8B9] text-lg sm:text-xl"></i>
                    </div>
                    <h4 class="text-base sm:text-lg font-bold uppercase tracking-wider text-[#004E27] mb-1 sm:mb-2">
                        {{ region.name }}
                    </h4>
                    <p class="text-xs sm:text-sm text-[#706F6C] leading-relaxed">
                        {{ region.description }}
                    </p>
                </div>
            </div>

            <!-- CTA -->
            <div class="text-center">
                <button type="button" @click.prevent="$emit('show-contact-us')"
                    class="bg-[#015D2F] hover:bg-[#003D1F] text-[#FFF8B9] font-bold py-2 sm:py-3 px-4 sm:px-6 rounded-lg text-sm sm:text-base transition-colors cursor-pointer">
                    CLICK HERE TO SEE THE FULL DIRECTORY
                </button>
            </div>
        </div>
    </section>
</template>
<script>
export default {
    name: 'DirectorySection',
    data() {
        return {
            regions: [
                {
                    name: 'Luzon',
                    description: 'Includes our head office at Coral Building, Southwoods City, Biñan, Laguna, plus partner stores across the region.',
                },
                {
                    name: 'Visayas',
                    description: 'Find authorized distributors and partner stores serving communities across the Visayas region.',
                },
                {
                    name: 'Mindanao',
                    description: 'Find authorized distributors and partner stores serving farmers across Mindanao.',
                },
            ],
        };
    },
};
</script>
