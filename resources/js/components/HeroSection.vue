<template>
    <!-- Hero Section -->
    <section id="home" class="hero-section relative">
        <div class="video-container">
            <video
                class="hero-video"
                autoplay
                loop
                muted
                playsinline
            >
                <source :src="'/videos/vid.mp4'" type="video/mp4">
            </video>
            <div class="absolute bottom-0 left-0 w-full h-62 bg-gradient-to-t from-white via-white/70 to-transparent z-20"></div>
        </div>
        <!-- Left Icons Container -->
        <div class="left-icons absolute left-50 top-1/2 transform -translate-y-1/2 z-10">
            <div class="social-icons">
                <a href="https://www.facebook.com/leadsagri" class="social-icon" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <div class="connector-line"></div>
                <a href="https://www.youtube.com/@LEADSTV1" class="social-icon" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-youtube"></i>
                </a>
                <div class="connector-line"></div>
                <a href="https://www.tiktok.com/@leadsagri.ph" class="social-icon" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-tiktok"></i>
                </a>
            </div>
        </div>
        <!-- Center Logo -->
        <div class="center-logo absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10">
            <img
                :src="'/images/masaganalogo.png'"
                alt="Masagana Logo"
                class="logo-image"
            >
        </div>
    </section>
</template>
<script>
export default {
    name: 'HeroSection',
};
</script> 