<template>
    <div class="main-container">
        <!-- Hero Section with Video -->
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
            </div>
            
            <!-- Left Icons Container -->
            <div class="left-icons absolute left-8 top-1/2 transform -translate-y-1/2 z-10">
                <!-- Space for future icons -->
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

        <!-- About Section -->
        <section id="about" class="section">
            <About />
        </section>

        <!-- Products Section -->
        <section id="products" class="section">
            <Products />
        </section>

        <!-- News Section -->
        <section id="news" class="section">
            <News />
        </section>

        <!-- Careers Section -->
        <section id="careers" class="section">
            <Careers />
        </section>
    </div>
</template>

<script>
import About from './About.vue'
import Products from './Products.vue'
import News from './News.vue'
import Careers from './Careers.vue'

export default {
    name: 'Hero',
    components: {
        About,
        Products,
        News,
        Careers
    }
}
</script>

<style scoped>
.main-container {
    width: 100%;
    overflow-x: hidden;
}

.hero-section {
    height: 100vh;
    position: relative;
    background: transparent;
}

.video-container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    overflow: hidden;
}

.hero-video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    z-index: 1;
}

.left-icons {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.center-logo {
    display: flex;
    justify-content: center;
    align-items: center;
}

.logo-image {
    width: auto;
    height: 200px; /* Adjust this value based on your needs */
    object-fit: contain;
    filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
}

.section {
    position: relative;
    width: 100%;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

/* Ensure content stays above the video */
.container {
    position: relative;
    z-index: 2;
}

.nav-link {
    position: relative;
}

.nav-link::after {
    content: '...';
    position: absolute;
    bottom: -4px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 12px;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.nav-link:hover::after {
    opacity: 1;
}

/* Styles for the content sections can be added/adjusted here */
</style> 