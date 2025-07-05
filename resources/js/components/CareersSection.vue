<template>
    <!-- Careers Section -->
    <section id="careers" class="relative min-h-[340px] md:min-h-[380px] lg:min-h-[420px] flex items-center justify-center bg-cover bg-center bg-no-repeat" style="background-image: url('/images/bg-career.png');">
        <div class="container mx-auto px-4 md:px-8 py-8 flex flex-col md:flex-row items-center justify-center">
            <!-- Logo Left -->
            <div class="hidden md:flex flex-shrink-0 justify-center w-full md:w-1/3 mb-6 md:mb-0">
                <img src="/public/images/logo-career.png" alt="LeadsAgri Careers Logo" class="max-h-54 md:max-h-62 lg:max-h-64 w-auto" />
            </div>
            <!-- Content Right -->
            <div class="flex flex-col justify-center w-full md:w-2/3 max-w-xl md:ml-[120px] px-8 py-8">
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-extrabold text-[#008037] mb-2">JOIN OUR TEAM</h2>
                <p class="text-gray-700 text-sm md:text-base mb-5 leading-relaxed">
                    <strong>Leads Agri</strong> has aimed to continuously give people opportunities to grow and expand their skills. We have paved the way for people to becoming the best versions of themselves.
                </p>
                <button type="submit" @click.prevent="$emit('show-careers')" class="bg-green-700 hover:bg-green-800 text-[#FFF8B9] font-bold py-3 px-6 rounded-lg transition-colors">CHECK OUR CAREERS HERE</button>
            </div>
        </div>
    </section>
</template>
<script>
export default {
    name: 'CareersSection',
};
</script> 