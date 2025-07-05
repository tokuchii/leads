<template>
    <div class="job-careers relative w-full">
        <div class="relative">
            <!-- Responsive image height -->
            <img 
                src="/public/images/jobimg.png" 
                alt="Career Background" 
                class="career-image w-full h-[350px] sm:h-[400px] md:h-[500px] lg:h-[600px] object-cover object-top z-0"
            >
            <!-- Dark green overlay with 55% opacity, z-10 -->
            <div class="absolute inset-0 bg-[#004E27] opacity-55 z-10"></div>
            <!-- Responsive centered CAREERS text, z-20 -->
            <div class="absolute inset-0 flex items-center justify-center z-20">
                <h1 class="text-white text-4xl sm:text-4xl md:text-4xl lg:text-6xl xl:text-6xl leading-tight text-center font-helvetica-heavy">
                    CAREERS
                </h1>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'JobCareers',
};
</script>