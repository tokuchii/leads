<template>
  <div class="main-container">
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
    <!-- About Section -->
    <section id="about" class="relative min-h-screen bg-about bg-cover bg-center bg-no-repeat flex items-center">
      <div class="container mx-auto px-6 pt-12 pb-0">
        <div class="grid md:grid-cols-2 gap-12 items-center">
          <!-- Left Column: Text Content -->
          <div class="text-container">
            <div class="flex items-center mb-1">
              <span class="w-0.5 h-0.5 bg-green-600 rounded-full mr-0.5"></span>
              <span class="w-0.5 h-0.5 bg-green-600 rounded-full mr-0.5"></span>
              <span class="w-0.5 h-0.5 bg-green-600 rounded-full mr-1"></span>
              <h2 class="text-sm font-bold text-[#2E7D32] tracking-widest uppercase">ABOUT US</h2>
            </div>
            <h3 class="text-4xl lg:text-5xl font-extrabold text-[#2E7D32] leading-tight mb-2">STARTED BY FILIPINOS</h3>
            <h3 class="text-4xl lg:text-5xl font-extrabold outline-text leading-tight mb-6 text-[#2E7D32]">FOR THE FILIPINOS</h3>
            <p class="text-[#2E7D32] text-lg mb-8 leading-relaxed">
              Since 1997, Leads Agricultural Products Corp. (LAPC) has been the partner of Filipino farmers in sustaining their livelihood. For almost three decades now, Leads Agri has been nurturing the vision of a developed agricultural system with farmers at the forefront of its advocacies.
            </p>
            <router-link to="/learn-more" class="text-[#2E7D32] text-base font-medium hover:underline">LEARN MORE.</router-link>
          </div>
        </div>
      </div>
    </section>
    <!-- Products Section -->
    <!-- ... (copy the rest of the main content sections from App.vue here) ... -->
  </div>
</template>

<script>
export default {
  name: 'Home',
  // Copy any data, methods, etc. needed for the main content
}
</script>

<style src="../AppStyle.css"></style> 