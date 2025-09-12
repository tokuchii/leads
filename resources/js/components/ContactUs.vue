<template>
    <div>
        <!-- Upper image/overlay/Contact Us section -->
        <div class="job-careers relative w-full">
            <div class="relative">
                <!-- Responsive image height (increased) -->
                <img src="/public/images/jobimg.png" alt="Contact Us Background"
                    class="career-image w-full h-[400px] sm:h-[500px] md:h-[600px] lg:h-[700px] object-cover object-top z-0">
                <!-- Dark green overlay with 55% opacity, z-10 -->
                <div class="absolute inset-0 bg-[#004E27] opacity-55 z-10"></div>
                <!-- Responsive centered Contact Us text, z-20 -->
                <div class="absolute inset-0 flex items-center justify-center z-20">
                    <h1
                        class="text-white text-4xl sm:text-4xl md:text-4xl lg:text-6xl xl:text-6xl leading-tight text-center font-helvetica-heavy">
                        Contact Us
                    </h1>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'ContactUs',
};
</script>
