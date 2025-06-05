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
            <div class="left-icons absolute left-30 top-1/2 transform -translate-y-1/2 z-10">
                <div class="social-icons">
                    <a href="#" class="social-icon">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <div class="connector-line"></div>
                    <a href="#" class="social-icon">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <div class="connector-line"></div>
                    <a href="#" class="social-icon">
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
    },
    mounted() {
        // Add Font Awesome CDN
        if (!document.querySelector('link[href*="font-awesome"]')) {
            const link = document.createElement('link');
            link.rel = 'stylesheet';
            link.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css';
            document.head.appendChild(link);
        }
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
    overflow: hidden;
}

.video-container {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    overflow: hidden;
}

.video-container::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.1);
    z-index: 2;
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
    z-index: 3;
}

.social-icons {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
}

.social-icon {
    color: #4CAF50;
    font-size: 1.5rem;
    transition: all 0.3s ease;
}

.social-icon:hover {
    color: #45a049;
    transform: scale(1.1);
}

.connector-line {
    width: 2px;
    height: 30px;
    background: #4CAF50;
}

.center-logo {
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 3;
}

.logo-image {
    width: auto;
    height: 600px; /* Increased from 200px to 300px */
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

/* Navigation Link Styles */
:deep(.nav-link) {
    position: relative;
    color: white;
    text-shadow: 0 0 10px rgba(255, 255, 255, 0.5),
                 0 0 20px rgba(255, 255, 255, 0.3),
                 0 0 30px rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}

:deep(.nav-link:hover) {
    color: #4CAF50;
    text-shadow: 0 0 15px rgba(76, 175, 80, 0.5),
                 0 0 25px rgba(76, 175, 80, 0.3),
                 0 0 35px rgba(76, 175, 80, 0.2);
}

:deep(.nav-link::after) {
    content: '...';
    position: absolute;
    bottom: -4px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 12px;
    opacity: 0;
    transition: opacity 0.3s ease;
    text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
}

:deep(.nav-link:hover::after) {
    opacity: 1;
}

/* Styles for the content sections can be added/adjusted here */
</style> 