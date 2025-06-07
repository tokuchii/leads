<template>
    <div class="min-h-screen">
        <!-- Scroll Progress Indicator -->
        <div class="scroll-progress"></div>
        
        <!-- Navigation -->
        <div class="fixed top-0 left-0 right-0 z-50">
            <!-- White fade gradient effect -->
            <div class="h-40 bg-gradient-to-b from-white via-white/50 to-transparent"></div>
            <!-- Navigation content -->
            <nav class="container mx-auto px-6 py-12 absolute top-0 left-0 right-0">
                <!-- Search Container -->
                <div id="search-container" class="search-container">
                    <input type="text" id="desktop-search" name="desktop-search" class="search-input" placeholder="Search..." autocomplete="off">
                    <button id="close-search" name="close-search" class="text-[#2E7D32] hover:text-[#1B5E20] transition-colors">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <!-- Desktop Navigation -->
                <div class="desktop-nav items-center justify-between">
                    <div class="flex items-center justify-center w-full">
                        <!-- Navigation Links -->
                        <div id="nav-items" class="flex items-center space-x-[500px] sm:space-x-[30px] md:space-x-[55px] lg:space-x-[80px] xl:space-x-[120px]">
                            <span id="search-icon" class="nav-link text-[#2E7D32] dark:text-[#2E7D32] transition font-bold text-sm md:text-sm lg:text-base cursor-pointer">
                                <i class="fas fa-search text-[#2E7D32] text-sm md:text-sm lg:text-base"></i>
                            </span>
                            <a href="#about" @click.prevent="scrollToSection('about')"
                                :class="['nav-link text-[#2E7D32] dark:text-[#2E7D32] transition font-bold text-sm md:text-sm lg:text-base', { 'active-link': activeSection === 'about' }]">ABOUT US</a>
                            <a href="#products" @click.prevent="scrollToSection('products')"
                                :class="['nav-link text-[#2E7D32] dark:text-[#2E7D32] transition font-bold text-sm md:text-sm lg:text-base', { 'active-link': activeSection === 'products' }]">PRODUCTS</a>
                            <a href="#home" @click.prevent="scrollToSection('home')"
                                :class="['nav-link transition flex items-center', { 'active-link': activeSection === 'home' }]">
                                <img src="/public/images/logo-green.png" alt="LeadsAgri Logo" class="h-10 w-auto md:h-10 lg:h-12" style="color: #1B5E20;" />
                            </a>
                            <a href="#news" @click.prevent="scrollToSection('news')"
                                :class="['nav-link text-[#2E7D32] dark:text-[#2E7D32] transition font-bold text-sm md:text-sm lg:text-base', { 'active-link': activeSection === 'news' }]">NEWS</a>
                            <a href="#careers" @click.prevent="scrollToSection('careers')"
                                :class="['nav-link text-[#2E7D32] dark:text-[#2E7D32] transition font-bold text-sm md:text-sm lg:text-base', { 'active-link': activeSection === 'careers' }]">CAREERS</a>
                            <span class="nav-link text-[#2E7D32] dark:text-[#2E7D32] transition" @click.prevent="scrollToSection('contact')"
                                :class="{ 'active-link': activeSection === 'contact' }">
                                <i class="fas fa-phone text-[#2E7D32] text-sm md:text-sm lg:text-base"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Mobile Navigation -->
                <div class="mobile-nav">
                    <div class="flex items-center justify-between">
                        <a href="#home" @click.prevent="scrollToSection('home')"
                           class="transition cursor-pointer hover:opacity-80 flex items-center shrink-0">
                            <img src="/public/images/logo-green.png" alt="LeadsAgri Logo" class="h-10 w-auto md:h-12 lg:h-14" style="color: #2E7D32;" />
                        </a>
                        <button id="mobile-menu-button" class="text-[#2E7D32] focus:outline-none ml-2">
                            <i class="fas fa-bars text-xl md:text-xl lg:text-2xl"></i>
                        </button>
                    </div>
                </div>
            </nav>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="mobile-menu fixed top-0 right-0 h-full w-64 bg-white shadow-lg p-6 z-50">
                <div class="flex justify-end mb-6">
                    <button id="close-menu-button" class="text-[#2E7D32] focus:outline-none">
                        <i class="fas fa-times text-xl md:text-xl lg:text-2xl"></i>
                    </button>
                </div>
                <div class="mobile-menu-icons mb-2">
                    <div class="flex items-center justify-between w-full">
                        <!-- Wrapper for Search Icon and Search Input -->
                        <div class="relative" style="width: 100%;">
                            <!-- Search Icon -->
                            <span id="mobile-search-icon" class="cursor-pointer text-[#2E7D32]">
                                <i class="fas fa-search text-lg text-[#2E7D32]"></i>
                            </span>

                            <!-- Search Input -->
                            <div id="mobile-search-container" class="hidden w-[101%]">
                                <div class="relative">
                                    <input type="text" id="mobile-search" name="mobile-search" class="w-full border-b-2 border-[#2E7D32] rounded-none text-[#2E7D32] placeholder-[#2E7D32] focus:outline-none bg-transparent" placeholder="Search..." autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <!-- Phone Icon (stays visible until search is shown) -->
                        <span id="mobile-phone-icon" class="text-[#2E7D32]" @click.prevent="scrollToSection('contact')">
                            <i class="fas fa-phone text-lg text-[#2E7D32]"></i>
                        </span>
                    </div>
                </div>
                <div class="mobile-menu-links">
                    <a href="#about" @click.prevent="scrollToSection('about')" class="nav-link text-[#2E7D32] font-bold mobile-menu-link text-sm md:text-sm lg:text-lg">ABOUT US</a>
                    <a href="#products" @click.prevent="scrollToSection('products')" class="nav-link text-[#2E7D32] font-bold mobile-menu-link text-sm md:text-sm lg:text-lg">PRODUCTS</a>
                    <a href="#news" @click.prevent="scrollToSection('news')" class="nav-link text-[#2E7D32] font-bold mobile-menu-link text-sm md:text-sm lg:text-lg">NEWS</a>
                    <a href="#careers" @click.prevent="scrollToSection('careers')" class="nav-link text-[#2E7D32] font-bold mobile-menu-link text-sm md:text-sm lg:text-lg">CAREERS</a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
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
                <a href="#" class="text-[#2E7D32] text-base font-medium hover:underline">LEARN MORE.</a>
            </div>
        </div>
    </div>
</section>

<!-- Products Section (Directly Below About Section) -->
<section id="products" class="product-container flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8">
  <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-center mb-16 sm:mb-24 lg:mb-30 text-white tracking-wide" style="letter-spacing: 2px;">FARMING SOLUTIONS</h2>
  <div class="flex flex-wrap justify-center items-center gap-6 sm:gap-8 md:gap-14 lg:gap-24 w-full max-w-6xl mx-auto">
    <div class="flex flex-col items-center justify-center w-24 sm:w-28 md:w-32 lg:w-36">
      <div class="flex items-center justify-center">
        <img src="/public/images/Rice.png" alt="Rice" class="h-18 w-18 sm:h-20 sm:w-20 md:h-24 md:w-24 lg:h-28 lg:w-28 object-contain white-icon mb-2 sm:mb-3" />
      </div>
      <span class="text-white text-xs sm:text-sm font-semibold tracking-widest text-center">RICE</span>
    </div>
    <div class="flex flex-col items-center justify-center w-24 sm:w-28 md:w-32 lg:w-36">
      <div class="flex items-center justify-center">
        <img src="/public/images/Mango.png" alt="Mango" class="h-18 w-18 sm:h-20 sm:w-20 md:h-24 md:w-24 lg:h-28 lg:w-28 object-contain white-icon mb-2 sm:mb-3" />
      </div>
      <span class="text-white text-xs sm:text-sm font-semibold tracking-widest text-center">MANGO</span>
    </div>
    <div class="flex flex-col items-center justify-center w-24 sm:w-28 md:w-32 lg:w-36">
      <div class="flex items-center justify-center">
        <img src="/public/images/Vegetables.png" alt="Vegetables" class="h-18 w-18 sm:h-20 sm:w-20 md:h-24 md:w-24 lg:h-28 lg:w-28 object-contain white-icon mb-2 sm:mb-3" />
      </div>
      <span class="text-white text-xs sm:text-sm font-semibold tracking-widest text-center">VEGETABLES</span>
    </div>
    <div class="flex flex-col items-center justify-center w-24 sm:w-28 md:w-32 lg:w-36">
      <div class="flex items-center justify-center">
        <img src="/public/images/Sugarcane.png" alt="Sugarcane" class="h-18 w-18 sm:h-20 sm:w-20 md:h-24 md:w-24 lg:h-28 lg:w-28 object-contain white-icon mb-2 sm:mb-3" />
      </div>
      <span class="text-white text-xs sm:text-sm font-semibold tracking-widest text-center">SUGARCANE</span>
    </div>
    <div class="flex flex-col items-center justify-center w-24 sm:w-28 md:w-32 lg:w-36">
      <div class="flex items-center justify-center">
        <img src="/public/images/Othercrops.png" alt="Other Crops" class="h-18 w-18 sm:h-20 sm:w-20 md:h-24 md:w-24 lg:h-28 lg:w-28 object-contain white-icon mb-2 sm:mb-3" />
      </div>
      <span class="text-white text-xs sm:text-sm font-semibold tracking-widest text-center">OTHER CROPS</span>
    </div>
  </div>
</section>


            <!-- News Section -->
            <section id="news" class="bg-white py-10">
                <div class="container mx-auto px-12 mt-20">
                    <h2 class="text-4xl sm:text-5xl font-extrabold mb-20 text-center text-[#2E7D32]" style="letter-spacing: 2px;">LATEST NEWS</h2>
                    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <div class="relative">
                                <img src="https://images.unsplash.com/photo-1625246333195-78d9c38ad449?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                                     alt="News 1" 
                                     class="w-full h-48 object-cover rounded-t-2xl">
                                <div class="absolute top-4 left-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm">
                                    Technology
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="text-xl font-semibold mb-3 text-green-700">New Smart Irrigation System Launch</h3>
                                <p class="text-gray-600 mb-4">
                                    Introducing our latest smart irrigation system with advanced AI capabilities for optimal water management.
                                </p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">March 15, 2024</span>
                                    <a href="#" class="text-green-600 hover:text-green-700 font-medium">Read More →</a>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <div class="relative">
                                <img src="https://images.unsplash.com/photo-1523741543316-beb7fc7023d8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                                     alt="News 2" 
                                     class="w-full h-48 object-cover rounded-t-2xl">
                                <div class="absolute top-4 left-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm">
                                    Innovation
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="text-xl font-semibold mb-3 text-green-700">Sustainable Farming Practices</h3>
                                <p class="text-gray-600 mb-4">
                                    Discover how our new sustainable farming practices are helping farmers reduce environmental impact.
                                </p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">March 10, 2024</span>
                                    <a href="#" class="text-green-600 hover:text-green-700 font-medium">Read More →</a>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <div class="relative">
                                <img src="https://images.unsplash.com/photo-1625246333195-78d9c38ad449?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                                     alt="News 3" 
                                     class="w-full h-48 object-cover rounded-t-2xl">
                                <div class="absolute top-4 left-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm">
                                    Research
                                </div>
                            </div>
                            <div class="p-4">
                                <h3 class="text-xl font-semibold mb-3 text-green-700">AI in Agriculture</h3>
                                <p class="text-gray-600 mb-4">
                                    Exploring the impact of artificial intelligence on modern agricultural practices and future trends.
                                </p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">March 5, 2024</span>
                                    <a href="#" class="text-green-600 hover:text-green-700 font-medium">Read More →</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="contact" class="relative py-12">
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
                  <p class="text-gray-600 text-sm mb-8 leading-relaxed">
                    Text here Text here Text here Text here Text here Text here Text here Text here Text here Text here Text here Text here Text here Text here
                  </p>
                  <form class="flex flex-col gap-4">
                    <div>
                      <label for="full-name" class="block text-[#2E7D32] font-bold text-base md:text-lg mb-2">Full Name</label>
                      <input type="text" id="full-name" name="full-name" class="w-full bg-gray-100 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-400" />
                    </div>
                    <div>
                      <label for="contact-number" class="block text-[#2E7D32] font-bold text-base md:text-lg mb-2">Contact Number</label>
                      <div class="flex gap-2 relative">
                        <select class="custom-select bg-gray-100 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-400">
                          <option value="+1">+1 (USA)</option>
                          <option value="+44">+44 (UK)</option>
                          <option value="+63" selected>+63 (PH)</option>
                          <option value="+91">+91 (IN)</option>
                          <option value="+81">+81 (JP)</option>
                          <option value="+61">+61 (AU)</option>
                          <option value="+86">+86 (CN)</option>
                        </select>
                        <input type="text" id="contact-number" name="contact-number" class="w-full bg-gray-100 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-400" />
                      </div>
                    </div>
                    <div>
                      <label for="email" class="block text-[#2E7D32] font-bold text-base md:text-lg mb-2">Email</label>
                      <input type="email" id="email" name="email" class="w-full bg-gray-100 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-400" />
                    </div>
                    <div>
                      <label for="tell-us-more" class="block text-[#2E7D32] font-bold text-base md:text-lg mb-2">Tell us more</label>
                      <textarea id="tell-us-more" name="tell-us-more" rows="7" class="w-full bg-gray-100 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-400 resize-none"></textarea>
                    </div>
                    <button type="submit" class="bg-[#2E7D32] hover:bg-[#1B5E20] text-[#FFF8B9] font-bold py-3 px-8 rounded-lg transition-colors self-end mb-20">SUBMIT</button>
                  </form>
                </div>
              </div>
            </section>


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
                         <button type="submit" class="bg-green-700 hover:bg-green-800 text-[#FFF8B9] font-bold py-3 px-6 rounded-lg transition-colors">CHECK OUR CAREERS HERE</button>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- Footer -->
    <footer class="bg-[#006633] py-4 w-full flex flex-col items-center justify-center">
      <img src="/public/images/logo-white.png" alt="LeadsAgri Logo" class="h-8 mb-4" />
      <p class="text-white text-sm text-center">
        Copyright © 2025 Leads Agricultural Products Corporation
      </p>
    </footer>
</template>

<script src="/resources/js/AppScript.js"></script>

<style src="/resources/js/AppStyle.css"></style> 