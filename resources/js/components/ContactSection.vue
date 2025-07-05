<template>
    <!-- Contact Section -->
    <section id="contact" class="relative">
        <!-- pandoy.png as absolute overlay for screens < 1280px -->
        <div class="absolute inset-0 flex xl:hidden justify-start items-end z-0">
            <img src="/public/images/pandoy.png" alt="Pandoy" class="max-w-[100%] max-h-[110%] h-auto object-contain opacity-30" />
        </div>
        <div class="container mx-auto px-6 relative z-10 flex flex-col lg:flex-row items-center justify-center gap-12">
            <!-- Image Section - Visible on xl and up, on the left (not overlay) -->
            <div class="hidden xl:flex lg:w-1/2 justify-center">
                <img src="/public/images/pandoy.png" alt="Pandoy" class="max-w-[100%] max-h-[120%]" />
            </div>
            <!-- Contact Form Section -->
            <div class="w-full lg:w-1/2">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold mt-8 sm:mt-10 md:mt-12 mb-2 text-[#2E7D32] tracking-wider">SEND US AN INQUIRY</h2>
                <p class="text-gray-600 text-sm mb-8 leading-relaxed">Text here Text here Text here Text here Text here Text here Text here Text here Text here Text here Text here Text here Text here Text here Text here Text here</p>
                <!-- The form and its logic will be handled in the parent -->
                <slot></slot>
            </div>
        </div>
    </section>
</template>
<script>
export default {
    name: 'ContactSection',
};
</script> 