<template>
    <div class="min-h-screen">
        <!-- Scroll Progress Indicator -->
        <div class="scroll-progress"></div>

        <!-- Navigation -->
        <div class="fixed top-0 left-0 right-0 z-50">
            <!-- White fade gradient effect -->
            <div class="h-30 bg-gradient-to-b from-white via-white/15 to-transparent"></div>
            <!-- Navigation content -->
            <nav class="container mx-auto px-6 py-12 absolute top-0 left-0 right-0">
                <!-- Search Container -->
                <div id="search-container" class="search-container">
                    <div class="relative w-full">
                        <input type="text" id="desktop-search" name="desktop-search" class="search-input" placeholder="Search..." autocomplete="off" v-model="searchQuery" @input="handleSearchInput" @focus="showSearchResults = true">
                        <button id="close-search" name="close-search" class="text-[#2E7D32] hover:text-[#1B5E20] transition-colors">
                            <i class="fas fa-times"></i>
                        </button>

                                                                        <!-- Search Results Dropdown -->
                        <div v-if="showSearchResults && (filteredSearchResults.length > 0 || isSearchLoading)" class="search-results-dropdown">
                            <div v-if="isSearchLoading" class="search-result-item">
                                <div class="search-result-content">
                                    <span class="text-gray-500">Loading products...</span>
                                </div>
                            </div>
                            <div v-else v-for="(result, index) in filteredSearchResults" :key="index"
                                 class="search-result-item"
                                 @click="handleSearchResultClick(result)">
                                <div class="search-result-content">
                                    <span class="search-result-category" v-html="highlightText(result.category, searchQuery)"></span>
                                    <span class="search-result-separator">/</span>
                                    <span class="search-result-type" v-html="highlightText(result.type, searchQuery)"></span>
                                </div>
                                <div class="search-result-count">{{ result.count }} products</div>
                            </div>
                        </div>
                    </div>
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
                                <img src="/public/images/logo-green.png" alt="LeadsAgri Logo" class="h-10 w-auto md:h-8 lg:h-10" style="color: #1B5E20;" />
                            </a>
                            <a href="#news" @click.prevent="scrollToSection('news')"
                                :class="['nav-link text-[#2E7D32] dark:text-[#2E7D32] transition font-bold text-sm md:text-sm lg:text-base', { 'active-link': activeSection === 'news' }]">NEWS</a>
                            <a href="#careers" @click.prevent="scrollToSection('careers')"
                                :class="['nav-link text-[#2E7D32] dark:text-[#2E7D32] transition font-bold text-sm md:text-sm lg:text-base ', { 'active-link': activeSection === 'careers' }]">CAREERS</a>
                            <span class="nav-link text-[#2E7D32] dark:text-[#2E7D32] transition" @click.prevent="scrollToSection('contact')"
                                :class="{ 'active-link': activeSection === 'contact' }">
                                <i class="fas fa-phone text-[#2E7D32] text-sm md:text-sm lg:text-base cursor-pointer"></i>
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
                                    <input type="text" id="mobile-search" name="mobile-search" class="w-full border-b-2 border-[#2E7D32] rounded-none text-[#2E7D32] placeholder-[#2E7D32] focus:outline-none bg-transparent" placeholder="Search..." autocomplete="off" v-model="searchQuery" @input="handleSearchInput" @focus="showSearchResults = true">

                                                                        <!-- Mobile Search Results Dropdown -->
                                    <div v-if="showSearchResults && (filteredSearchResults.length > 0 || isSearchLoading)" class="mobile-search-results-dropdown">
                                        <div v-if="isSearchLoading" class="search-result-item">
                                            <div class="search-result-content">
                                                <span class="text-gray-500">Loading products...</span>
                                            </div>
                                        </div>
                                        <div v-else v-for="(result, index) in filteredSearchResults" :key="index"
                                             class="search-result-item"
                                             @click="handleSearchResultClick(result)">
                                            <div class="search-result-content">
                                                <span class="search-result-category" v-html="highlightText(result.category, searchQuery)"></span>
                                                <span class="search-result-separator">/</span>
                                                <span class="search-result-type" v-html="highlightText(result.type, searchQuery)"></span>
                                            </div>
                                            <div class="search-result-count">{{ result.count }} products</div>
                                        </div>
                                    </div>
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

        <transition name="fade" mode="out-in">
            <div v-if="selectedNewsArticle" key="newsarticle" class="main-container">
                <div class="news-article flex flex-col items-center justify-center bg-[#006D36] px-4 md:px-8 lg:px-16 py-8 shadow-lg max-w-full lg:max-w-7xl mx-auto mt-30 mb-10">
                    <div class="w-full flex flex-col items-start mb-4">
                        <span class="text-white text-xs sm:text-sm md:text-base font-semibold tracking-widest px-4 py-2 rounded-lg mb-4 cursor-pointer hover:text-gray-200 transition-colors hover:underline" @click="goToFeaturedNews">NEWS | ARTICLES</span>
                    </div>
                    <img :src="selectedNewsArticle.featured_image_url || '/public/images/newsimg.png'" class="w-full max-w-xs sm:max-w-md md:max-w-xl lg:max-w-3xl h-auto mb-8 object-center no-hover-effect" />
                    <h1 class="text-white text-2xl sm:text-3xl md:text-4xl font-bold mb-6 text-center">{{ selectedNewsArticle.title }}</h1>
                    <div class="prose prose-sm sm:prose md:prose-lg text-white mb-6 w-full max-w-full break-words" v-html="formattedSelectedArticleContent"></div>

                </div>
            </div>
            <div v-else-if="!showLearnMore && !showCareers && !showFeaturedNews && !showRiceProducts && !showMangoProducts && !showVegetableProducts && !showSugarcaneProducts && !showOthercropProducts" key="main" class="main-container">
                <HeroSection />
                <AboutSection @show-learn-more="handleShowLearnMore" />
                <ProductsSection
                    :hoveredProduct="hoveredProduct"
                    :productIcons="productIcons"
                    @hover="handleHoverProduct"
                    @reset-hover="handleResetHover"
                    @product-click="handleHoverProduct"
                    @show-rice-products="handleShowRiceProducts"
                    @show-mango-products="handleShowMangoProducts"
                    @show-vegetable-products="handleShowVegetableProducts"
                    @show-sugarcane-products="handleShowSugarcaneProducts"
                    @show-othercrop-products="handleOthercropProducts"
                />
                <NewsSection
                @show-featured-news="handleShowFeaturedNews"
                @show-news-article="handleShowNewsArticle"
                />
                <ContactSection>
                    <!-- The contact form and logic remain in App.vue, so slot is used -->
                    <form class="flex flex-col gap-4" @submit.prevent="submitInquiry">
                        <div>
                            <label
                                for="full_name"
                                class="block text-[#2E7D32] font-bold text-base md:text-lg mb-2"
                                >Full Name</label
                            >
                            <input
                                type="text"
                                inputmode="text"
                                id="full_name"
                                v-model="formData.full_name"
                                name="full_name"
                                class="w-full bg-gray-100 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-400"
                                :class="{'border-red-500': errorMessage && errorMessage.includes('full_name')}"
                                @input="handleFullNameInput"
                                placeholder="e.g., Juan Dela Cruz"
                                required
                            />
                            <p v-if="errorMessage && errorMessage.includes('full_name')" class="text-red-500 text-sm mt-1">
                                {{ errorMessage }}
                            </p>
                        </div>
                        <div>
                            <label
                                for="contact_number"
                                class="block text-[#2E7D32] font-bold text-base md:text-lg mb-2"
                                >Contact Number</label
                            >
                            <div class="flex gap-2 relative">
                                <div class="relative">
                                    <button
                                        type="button"
                                        @click="toggleCountryDropdown"
                                        class="custom-select bg-gray-100 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-400 w-full text-left flex items-center justify-between"
                                        :class="{'border-red-500': errorMessage && errorMessage.includes('country_code')}"
                                        >
                                        <span v-if="selectedCountry" class="flex items-center gap-2">
                                            <span>{{ selectedCountry.code }}</span>
                                            <span>({{ selectedCountry.iso2 }})</span>
                                            <img
                                            :src="`https://flagcdn.com/w20/${selectedCountry.iso2.toLowerCase()}.png`"
                                            :alt="selectedCountry.name"
                                            class="inline-block w-4 h-3"
                                            style="vertical-align: middle;"
                                            />
                                        </span>
                                        <span v-else>Select Country</span>
                                        <i class="text-gray-500 ml-2"></i>
                                    </button>

                                    <!-- Country Dropdown -->
                                    <div v-if="showCountryDropdown"
                                         class="absolute z-50 w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                                        <div v-for="country in countries"
                                             :key="country.code"
                                             @click="selectCountry(country)"
                                             class="px-4 py-2 hover:bg-gray-100 cursor-pointer flex items-center">
                                            <span class="flex-1">{{ country.code }} ({{ country.iso2 }})</span>
                                            <img :src="`https://flagcdn.com/w20/${country.iso2.toLowerCase()}.png`"
                                                 :alt="country.name"
                                                 class="w-4 h-3 ml-2">
                                        </div>
                                    </div>
                                </div>
                                <input
                                    type="tel"
                                    id="contact_number"
                                    v-model="formData.contact_number"
                                    name="contact_number"
                                    class="w-full bg-gray-100 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-400"
                                    :class="{'border-red-500': errorMessage && errorMessage.includes('contact_number')}"
                                    :maxlength="getPhoneLength(formData.country_code)"
                                    :placeholder="`Enter ${getPhoneLength(formData.country_code)} digits`"
                                    required
                                    @input="formData.contact_number = formData.contact_number.replace(/[^0-9]/g, '')"
                                />
                                <p v-if="errorMessage && errorMessage.includes('contact_number')" class="text-red-500 text-sm mt-1">
                                    {{ errorMessage }}
                                </p>
                            </div>
                        </div>
                        <div>
                            <label
                                for="email"
                                class="block text-[#2E7D32] font-bold text-base md:text-lg mb-2"
                                >Email</label
                            >
                            <input
                                type="email"
                                id="email"
                                v-model="formData.email"
                                name="email"
                                class="w-full bg-gray-100 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-400"
                                :class="{'border-red-500': errorMessage && errorMessage.includes('email')}"
                                placeholder="e.g., name@example.com"
                                required
                            />
                            <p v-if="errorMessage && errorMessage.includes('email')" class="text-red-500 text-sm mt-1">
                                {{ errorMessage }}
                            </p>
                        </div>
                        <div>
                            <label
                                for="message"
                                class="block text-[#2E7D32] font-bold text-base md:text-lg mb-2"
                                >Tell us more</label
                            >
                            <textarea
                                id="message"
                                v-model="formData.message"
                                name="message"
                                rows="7"
                                class="w-full bg-gray-100 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-green-400 resize-none"
                                :class="{'border-red-500': errorMessage && errorMessage.includes('message')}"
                                @input="handleMessageInput"
                                placeholder="Let us know how we can assist you"
                            ></textarea>
                        </div>
                        <button
                            type="submit"
                            class="bg-[#2E7D32] hover:bg-[#1B5E20] text-[#FFF8B9] font-bold py-3 px-8 rounded-lg transition-colors self-end mb-20 cursor-pointer"
                            :disabled="isSubmitting"
                        >
                            {{ isSubmitting ? 'SUBMITTING...' : 'SUBMIT' }}
                        </button>
                    </form>
                </ContactSection>
                <CareersSection @show-careers="handleShowCareers" />
            </div>
            <div v-else-if="showLearnMore" key="learnmore" class="main-container">
                <LearnMoreSection
                    :activeTab="activeTab"
                    :carouselCurrentSlide="carouselCurrentSlide"
                    :carouselImages="carouselImages"
                    @close="handleCloseLearnMore"
                    @update:activeTab="handleTabChange"
                    @carousel-touch-start="handleCarouselTouchStart"
                    @carousel-touch-move="handleCarouselTouchMove"
                    @carousel-touch-end="handleCarouselTouchEnd"
                    @carousel-prev="previousCarouselSlide"
                    @carousel-next="nextCarouselSlide"
                />
            </div>
            <div v-else-if="showRiceProducts" key="riceproducts" class="main-container">
                <RiceProductsSection
                    :activeTab="riceActiveTab"
                    @update:activeTab="handleRiceTabChange"
                />
            </div>
            <div v-else-if="showMangoProducts" key="mangoproducts" class="main-container">
                <MangoProductsSection
                    :activeTab="mangoActiveTab"
                    @update:activeTab="handleMangoTabChange"
                />
            </div>
            <div v-else-if="showVegetableProducts" key="vegetableproducts" class="main-container">
                <VegetableProductsSection
                    :activeTab="vegetableActiveTab"
                    @update:activeTab="handleVegetableTabChange"
                />
            </div>
            <div v-else-if="showSugarcaneProducts" key="sugarcaneproducts" class="main-container">
                <SugarcaneProductsSection
                    :activeTab="sugarcaneActiveTab"
                    @update:activeTab="handleSugarcaneTabChange"
                />
            </div>
            <div v-else-if="showOthercropProducts" key="othercropproducts" class="main-container">
                <OthercropProductsSection
                    :activeTab="othercropActiveTab"
                    @update:activeTab="handleOthercropTabChange"
                />
            </div>
            <div v-else-if="showCareers" key="careers" class="main-container">
                <JobCareers @close="handleCloseCareers" />
            </div>
            <div v-else-if="showFeaturedNews" key="featurednews" class="main-container">
                <FeaturedNews @show-news-article="handleShowNewsArticle" @close="handleCloseFeaturedNews" />
            </div>
        </transition>
        <!-- Footer -->
        <footer class="bg-[#006633] py-4 w-full flex flex-col items-center justify-center">
          <img src="/public/images/logo-white.png" alt="LeadsAgri Logo" class="h-8 mb-4" />
          <p class="text-white text-sm text-center">
            Copyright © 2025 Leads Agricultural Products Corporation
          </p>
        </footer>
    </div>
</template>

<script>
import Swal from 'sweetalert2';
import HeroSection from './components/HeroSection.vue';
import AboutSection from './components/AboutSection.vue';
import ProductsSection from './components/ProductsSection.vue';
import NewsSection from './components/NewsSection.vue';
import ContactSection from './components/ContactSection.vue';
import CareersSection from './components/CareersSection.vue';
import LearnMoreSection from './components/LearnMoreSection.vue';
import JobCareers from './components/JobCareers.vue';
import FeaturedNews from './components/FeaturedNews.vue';
import RiceProductsSection from './components/RiceProductsSection.vue';
import MangoProductsSection from './components/MangoProductsSection.vue';
import VegetableProductsSection from './components/VegetableProductsSection.vue';
import SugarcaneProductsSection from './components/SugarcaneProductsSection.vue';
import OthercropProductsSection from './components/OthercropProductsSection.vue';
export default {
    name: 'App',
    components: {
        HeroSection,
        AboutSection,
        ProductsSection,
        NewsSection,
        ContactSection,
        CareersSection,
        LearnMoreSection,
        JobCareers,
        FeaturedNews,
        RiceProductsSection,
        MangoProductsSection,
        VegetableProductsSection,
        SugarcaneProductsSection,
        OthercropProductsSection,
    },
    data() {
        return {
            showLearnMore: false,
            showCareers: false,
            showFeaturedNews: false,
            showRiceProducts: false,
            showMangoProducts: false,
            showVegetableProducts: false,
            showSugarcaneProducts: false,
            showOthercropProducts: false,
            hoveredProduct: null,
            productIcons: [
                {
                    name: 'RICE',
                    icon: '/images/Rice.png',
                    background: '/images/rice1.png',
                    image: '/images/riceimg.png',
                    text: '<b>Rice</b> is the staple food for a significant portion of Filipinos, making it a crucial part of the countrys food supply and economy. The Philippines is a major rice producer, but also a significant importer, relying on local production, <br> a buffer stock, and imports to meet demand. The rice industry faces challenges like climate change and the need for increased productivity to ensure food security.',
                },
                {
                    name: 'MANGO',
                    icon: '/images/Mango.png',
                    background: '/images/mango1.png',
                    image: '/images/mangoimg.png',
                    text: 'The Philippines is known for its <b>mangoes</b>, particularly the Carabao variety, which is celebrated for its sweetness and is considered the "king of fruits".Mango is the national fruit of the Philippines, and the country is a significant producer, ranking 10th globally. The Ilocos Region is the top mango producer, followed by SOCCSKSARGEN and Zamboanga Peninsula.',
                },
                {
                    name: 'VEGETABLES',
                    icon: '/images/Vegetables.png',
                    background: '/images/vegetables1.png',
                    image: '/images/vegetablesimg.png',
                    text: '<b>Vegetable</b> production in the country is mired by high incidence of pests and diseases, poor access to modern varieties and production inputs, inadequate farmer skills, and inefficient marketing and distribution losses which contributes to overall production losses. These constraints result in low yield and quality, and expensive production inputs resulting in high prices of vegetables. Moreover, due to concerns on health and environmental <br> pollutants that can affect the vegetable industry and absence of an available monitoring system for food safety, ',
                },
                {
                    name: 'SUGARCANE',
                    icon: '/images/Sugarcane.png',
                    background: '/images/sugarcane1.png',
                    image: '/images/sugarcaneimg.png',
                    text: 'The Philippines produced 21.65 million metric tons of <b>sugarcane</b>, representing a decline of roughly 8% from the previous year, according to Statista. Western Visayas, particularly Negros Occidental, was the leading producer, accounting for about 56% of the total.',
                },
                {
                    name: 'OTHER CROPS',
                    icon: '/images/Othercrops.png',
                    background: '/images/othercrops1.jpg',
                    image: '/images/othercropsimg.jpg',
                    text: '<b>Leads Agri</b> has been aimed to helping Filipino Farmers with the products and services they provide. We believe that every farmer deserves bountiful yields and we are willing to help them reach it.',
                },
            ],
            activeSection: 'home',
            activeTab: 'roots',
            riceActiveTab: 'Herbicide',
            vegetableActiveTab: 'Herbicide',
            mangoActiveTab: 'Herbicide',
            sugarcaneActiveTab: 'Herbicide',
            othercropActiveTab: 'Herbicide',
            formData: {
                full_name: '',
                country_code: '+63',
                contact_number: '',
                email: '',
                message: ''
            },
            isSubmitting: false,
            errorMessage: null,
            countries: [],
            showCountryDropdown: false,
            selectedCountry: null,
            // Carousel data
            carouselCurrentSlide: 0,
            carouselTouchStartX: 0,
            carouselTouchEndX: 0,
            carouselImages: [
                {
                    src: '/images/companyimg.png',
                },
                {
                    src: '/images/companyimg1.png',
                },
                {
                    src: '/images/companyimg2.png',
                },
            ],
            phoneLengthMap: {
                // Asia
                '+63': 10, // Philippines
                '+86': 11, // China
                '+81': 10, // Japan
                '+82': 10, // South Korea
                '+91': 10, // India
                '+62': 9,  // Indonesia
                '+66': 9,  // Thailand
                '+84': 10, // Vietnam
                '+65': 8,  // Singapore
                '+60': 9,  // Malaysia
                '+852': 8, // Hong Kong
                '+886': 9, // Taiwan
                '+880': 10, // Bangladesh
                '+92': 10, // Pakistan
                '+93': 9,  // Afghanistan
                '+94': 9,  // Sri Lanka
                '+95': 9,  // Myanmar
                '+977': 10, // Nepal
                '+98': 10, // Iran
                '+964': 10, // Iraq
                '+962': 9,  // Jordan
                '+965': 8,  // Kuwait
                '+961': 8,  // Lebanon
                '+966': 9,  // Saudi Arabia
                '+971': 9,  // UAE
                '+972': 9,  // Israel
                '+973': 8,  // Bahrain
                '+974': 8,  // Qatar
                '+976': 8,  // Mongolia
                '+992': 9,  // Tajikistan
                '+993': 8,  // Turkmenistan
                '+994': 9,  // Azerbaijan
                '+995': 9,  // Georgia
                '+996': 9,  // Kyrgyzstan
                '+998': 9,  // Uzbekistan

                // Europe
                '+44': 10, // UK
                '+49': 11, // Germany
                '+33': 9,  // France
                '+39': 10, // Italy
                '+34': 9,  // Spain
                '+31': 9,  // Netherlands
                '+46': 9,  // Sweden
                '+47': 8,  // Norway
                '+45': 8,  // Denmark
                '+358': 9, // Finland
                '+48': 9,  // Poland
                '+420': 9, // Czech Republic
                '+36': 9,  // Hungary
                '+43': 11, // Austria
                '+41': 9,  // Switzerland
                '+32': 9,  // Belgium
                '+30': 10, // Greece
                '+351': 9, // Portugal
                '+353': 9, // Ireland
                '+354': 7, // Iceland
                '+355': 9, // Albania
                '+356': 8, // Malta
                '+357': 8, // Cyprus
                '+359': 9, // Bulgaria
                '+370': 8, // Lithuania
                '+371': 8, // Latvia
                '+372': 8, // Estonia
                '+373': 8, // Moldova
                '+374': 8, // Armenia
                '+375': 9, // Belarus
                '+376': 6, // Andorra
                '+377': 8, // Monaco
                '+378': 8, // San Marino
                '+380': 9, // Ukraine
                '+381': 9, // Serbia
                '+382': 8, // Montenegro
                '+383': 8, // Kosovo
                '+385': 9, // Croatia
                '+386': 8, // Slovenia
                '+387': 8, // Bosnia
                '+389': 8, // Macedonia
                '+421': 9, // Slovakia

                // Americas
                '+1': 10,  // USA/Canada
                '+55': 11, // Brazil
                '+52': 10, // Mexico
                '+54': 10, // Argentina
                '+56': 9,  // Chile
                '+57': 10, // Colombia
                '+58': 10, // Venezuela
                '+51': 9,  // Peru
                '+593': 9, // Ecuador
                '+595': 9, // Paraguay
                '+598': 8, // Uruguay
                '+591': 8, // Bolivia
                '+502': 8, // Guatemala
                '+503': 8, // El Salvador
                '+504': 8, // Honduras
                '+505': 8, // Nicaragua
                '+506': 8, // Costa Rica
                '+507': 8, // Panama
                '+509': 8, // Haiti
                '+591': 8, // Bolivia
                '+593': 9, // Ecuador
                '+595': 9, // Paraguay
                '+598': 8, // Uruguay

                // Africa
                '+27': 9,  // South Africa
                '+20': 10, // Egypt
                '+212': 9, // Morocco
                '+216': 8, // Tunisia
                '+213': 9, // Algeria
                '+234': 10, // Nigeria
                '+254': 9, // Kenya
                '+255': 9, // Tanzania
                '+256': 9, // Uganda
                '+233': 9, // Ghana
                '+225': 10, // Ivory Coast
                '+237': 9, // Cameroon
                '+236': 8, // Central African Republic
                '+235': 8, // Chad
                '+238': 7, // Cape Verde
                '+239': 7, // Sao Tome
                '+240': 9, // Equatorial Guinea
                '+241': 8, // Gabon
                '+242': 9, // Republic of Congo
                '+243': 9, // DR Congo
                '+244': 9, // Angola
                '+245': 7, // Guinea-Bissau
                '+246': 7, // British Indian Ocean Territory
                '+247': 4, // Ascension Island
                '+248': 7, // Seychelles
                '+249': 9, // Sudan
                '+250': 9, // Rwanda
                '+251': 9, // Ethiopia
                '+252': 8, // Somalia
                '+253': 8, // Djibouti
                '+257': 8, // Burundi
                '+258': 9, // Mozambique
                '+260': 9, // Zambia
                '+261': 9, // Madagascar
                '+262': 9, // Reunion
                '+263': 9, // Zimbabwe
                '+264': 9, // Namibia
                '+265': 9, // Malawi
                '+266': 8, // Lesotho
                '+267': 8, // Botswana
                '+268': 8, // Swaziland
                '+269': 7, // Comoros
                '+290': 4, // Saint Helena
                '+291': 7, // Eritrea
                '+297': 7, // Aruba
                '+298': 6, // Faroe Islands
                '+299': 6, // Greenland

                // Oceania
                '+61': 9,  // Australia
                '+64': 9,  // New Zealand
                '+675': 8, // Papua New Guinea
                '+676': 7, // Tonga
                '+677': 7, // Solomon Islands
                '+678': 7, // Vanuatu
                '+679': 7, // Fiji
                '+680': 7, // Palau
                '+681': 6, // Wallis and Futuna
                '+682': 5, // Cook Islands
                '+683': 4, // Niue
                '+685': 6, // Samoa
                '+686': 8, // Kiribati
                '+687': 6, // New Caledonia
                '+688': 5, // Tuvalu
                '+689': 8, // French Polynesia
                '+690': 4, // Tokelau
                '+691': 7, // Micronesia
                '+692': 7, // Marshall Islands
                '+850': 10, // North Korea
                '+853': 8, // Macau
                '+855': 9, // Cambodia
                '+856': 10, // Laos
                '+960': 7, // Maldives
                '+961': 8, // Lebanon
                '+963': 9, // Syria
                '+964': 10, // Iraq
                '+965': 8, // Kuwait
                '+966': 9, // Saudi Arabia
                '+967': 9, // Yemen
                '+968': 8, // Oman
                '+970': 9, // Palestine
                '+971': 9, // UAE
                '+972': 9, // Israel
                '+973': 8, // Bahrain
                '+974': 8, // Qatar
                '+975': 8, // Bhutan
                '+976': 8, // Mongolia
                '+977': 10, // Nepal
                '+992': 9, // Tajikistan
                '+993': 8, // Turkmenistan
                '+994': 9, // Azerbaijan
                '+995': 9, // Georgia
                '+996': 9, // Kyrgyzstan
                '+998': 9, // Uzbekistan
            },
            selectedNewsArticle: null,
            searchQuery: '',
            showSearchResults: false,
            filteredSearchResults: [],
            allProducts: [],
            isSearchLoading: false,
        }
    },
    async mounted() {
        // Use hardcoded countries list to avoid API issues
        this.countries = [
            { name: 'Afghanistan', code: '+93', iso2: 'AF', iso3: 'AFG' },
            { name: 'Albania', code: '+355', iso2: 'AL', iso3: 'ALB' },
            { name: 'Algeria', code: '+213', iso2: 'DZ', iso3: 'DZA' },
            { name: 'Argentina', code: '+54', iso2: 'AR', iso3: 'ARG' },
            { name: 'Australia', code: '+61', iso2: 'AU', iso3: 'AUS' },
            { name: 'Austria', code: '+43', iso2: 'AT', iso3: 'AUT' },
            { name: 'Bangladesh', code: '+880', iso2: 'BD', iso3: 'BGD' },
            { name: 'Belgium', code: '+32', iso2: 'BE', iso3: 'BEL' },
            { name: 'Brazil', code: '+55', iso2: 'BR', iso3: 'BRA' },
            { name: 'Bulgaria', code: '+359', iso2: 'BG', iso3: 'BGR' },
            { name: 'Cambodia', code: '+855', iso2: 'KH', iso3: 'KHM' },
            { name: 'Canada', code: '+1', iso2: 'CA', iso3: 'CAN' },
            { name: 'Chile', code: '+56', iso2: 'CL', iso3: 'CHL' },
            { name: 'China', code: '+86', iso2: 'CN', iso3: 'CHN' },
            { name: 'Colombia', code: '+57', iso2: 'CO', iso3: 'COL' },
            { name: 'Croatia', code: '+385', iso2: 'HR', iso3: 'HRV' },
            { name: 'Czech Republic', code: '+420', iso2: 'CZ', iso3: 'CZE' },
            { name: 'Denmark', code: '+45', iso2: 'DK', iso3: 'DNK' },
            { name: 'Egypt', code: '+20', iso2: 'EG', iso3: 'EGY' },
            { name: 'Estonia', code: '+372', iso2: 'EE', iso3: 'EST' },
            { name: 'Finland', code: '+358', iso2: 'FI', iso3: 'FIN' },
            { name: 'France', code: '+33', iso2: 'FR', iso3: 'FRA' },
            { name: 'Germany', code: '+49', iso2: 'DE', iso3: 'DEU' },
            { name: 'Greece', code: '+30', iso2: 'GR', iso3: 'GRC' },
            { name: 'Hong Kong', code: '+852', iso2: 'HK', iso3: 'HKG' },
            { name: 'Hungary', code: '+36', iso2: 'HU', iso3: 'HUN' },
            { name: 'Iceland', code: '+354', iso2: 'IS', iso3: 'ISL' },
            { name: 'India', code: '+91', iso2: 'IN', iso3: 'IND' },
            { name: 'Indonesia', code: '+62', iso2: 'ID', iso3: 'IDN' },
            { name: 'Iran', code: '+98', iso2: 'IR', iso3: 'IRN' },
            { name: 'Iraq', code: '+964', iso2: 'IQ', iso3: 'IRQ' },
            { name: 'Ireland', code: '+353', iso2: 'IE', iso3: 'IRL' },
            { name: 'Israel', code: '+972', iso2: 'IL', iso3: 'ISR' },
            { name: 'Italy', code: '+39', iso2: 'IT', iso3: 'ITA' },
            { name: 'Japan', code: '+81', iso2: 'JP', iso3: 'JPN' },
            { name: 'Jordan', code: '+962', iso2: 'JO', iso3: 'JOR' },
            { name: 'Kazakhstan', code: '+7', iso2: 'KZ', iso3: 'KAZ' },
            { name: 'Kuwait', code: '+965', iso2: 'KW', iso3: 'KWT' },
            { name: 'Latvia', code: '+371', iso2: 'LV', iso3: 'LVA' },
            { name: 'Lebanon', code: '+961', iso2: 'LB', iso3: 'LBN' },
            { name: 'Lithuania', code: '+370', iso2: 'LT', iso3: 'LTU' },
            { name: 'Luxembourg', code: '+352', iso2: 'LU', iso3: 'LUX' },
            { name: 'Malaysia', code: '+60', iso2: 'MY', iso3: 'MYS' },
            { name: 'Maldives', code: '+960', iso2: 'MV', iso3: 'MDV' },
            { name: 'Malta', code: '+356', iso2: 'MT', iso3: 'MLT' },
            { name: 'Mexico', code: '+52', iso2: 'MX', iso3: 'MEX' },
            { name: 'Monaco', code: '+377', iso2: 'MC', iso3: 'MCO' },
            { name: 'Mongolia', code: '+976', iso2: 'MN', iso3: 'MNG' },
            { name: 'Morocco', code: '+212', iso2: 'MA', iso3: 'MAR' },
            { name: 'Myanmar', code: '+95', iso2: 'MM', iso3: 'MMR' },
            { name: 'Nepal', code: '+977', iso2: 'NP', iso3: 'NPL' },
            { name: 'Netherlands', code: '+31', iso2: 'NL', iso3: 'NLD' },
            { name: 'New Zealand', code: '+64', iso2: 'NZ', iso3: 'NZL' },
            { name: 'Nigeria', code: '+234', iso2: 'NG', iso3: 'NGA' },
            { name: 'North Korea', code: '+850', iso2: 'KP', iso3: 'PRK' },
            { name: 'Norway', code: '+47', iso2: 'NO', iso3: 'NOR' },
            { name: 'Pakistan', code: '+92', iso2: 'PK', iso3: 'PAK' },
            { name: 'Philippines', code: '+63', iso2: 'PH', iso3: 'PHL' },
            { name: 'Poland', code: '+48', iso2: 'PL', iso3: 'POL' },
            { name: 'Portugal', code: '+351', iso2: 'PT', iso3: 'PRT' },
            { name: 'Qatar', code: '+974', iso2: 'QA', iso3: 'QAT' },
            { name: 'Romania', code: '+40', iso2: 'RO', iso3: 'ROU' },
            { name: 'Russia', code: '+7', iso2: 'RU', iso3: 'RUS' },
            { name: 'Saudi Arabia', code: '+966', iso2: 'SA', iso3: 'SAU' },
            { name: 'Serbia', code: '+381', iso2: 'RS', iso3: 'SRB' },
            { name: 'Singapore', code: '+65', iso2: 'SG', iso3: 'SGP' },
            { name: 'Slovakia', code: '+421', iso2: 'SK', iso3: 'SVK' },
            { name: 'Slovenia', code: '+386', iso2: 'SI', iso3: 'SVN' },
            { name: 'South Africa', code: '+27', iso2: 'ZA', iso3: 'ZAF' },
            { name: 'South Korea', code: '+82', iso2: 'KR', iso3: 'KOR' },
            { name: 'Spain', code: '+34', iso2: 'ES', iso3: 'ESP' },
            { name: 'Sri Lanka', code: '+94', iso2: 'LK', iso3: 'LKA' },
            { name: 'Sweden', code: '+46', iso2: 'SE', iso3: 'SWE' },
            { name: 'Switzerland', code: '+41', iso2: 'CH', iso3: 'CHE' },
            { name: 'Syria', code: '+963', iso2: 'SY', iso3: 'SYR' },
            { name: 'Taiwan', code: '+886', iso2: 'TW', iso3: 'TWN' },
            { name: 'Thailand', code: '+66', iso2: 'TH', iso3: 'THA' },
            { name: 'Tunisia', code: '+216', iso2: 'TN', iso3: 'TUN' },
            { name: 'Turkey', code: '+90', iso2: 'TR', iso3: 'TUR' },
            { name: 'Ukraine', code: '+380', iso2: 'UA', iso3: 'UKR' },
            { name: 'United Arab Emirates', code: '+971', iso2: 'AE', iso3: 'ARE' },
            { name: 'United Kingdom', code: '+44', iso2: 'GB', iso3: 'GBR' },
            { name: 'United States', code: '+1', iso2: 'US', iso3: 'USA' },
            { name: 'Uruguay', code: '+598', iso2: 'UY', iso3: 'URY' },
            { name: 'Venezuela', code: '+58', iso2: 'VE', iso3: 'VEN' },
            { name: 'Vietnam', code: '+84', iso2: 'VN', iso3: 'VNM' },
            { name: 'Yemen', code: '+967', iso2: 'YE', iso3: 'YEM' },
        ];


        // Set default selected country (Philippines)
        this.selectedCountry = this.countries.find(c => c.code === '+63') || this.countries[0];

        // Fetch all products for search functionality
        this.fetchAllProducts();

        // Mobile menu functionality
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const closeMenuButton = document.getElementById('close-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileNav = document.querySelector('.mobile-nav');

        // Search functionality
        const searchIcon = document.getElementById('search-icon');
        const searchContainer = document.getElementById('search-container');
        const closeSearch = document.getElementById('close-search');
        const navItems = document.getElementById('nav-items');
        const searchInput = document.querySelector('.search-input');

        // Mobile search functionality
        const mobileSearchIcon = document.getElementById('mobile-search-icon');
        const mobileSearchContainer = document.getElementById('mobile-search-container');
        const mobileSearchInput = mobileSearchContainer?.querySelector('input');
        const mobilePhoneIcon = document.getElementById('mobile-phone-icon');

                // Mobile search functionality
        const self = this;
        function toggleMobileSearch() {
            if (!mobileSearchContainer || !mobileSearchIcon || !mobilePhoneIcon) return;

            const isVisible = !mobileSearchContainer.classList.contains('hidden');

            // Toggle visibility
            mobileSearchContainer.classList.toggle('hidden');
            mobileSearchIcon.style.display = isVisible ? 'inline-block' : 'none';
            mobilePhoneIcon.style.display = isVisible ? 'inline-block' : 'none';

            if (!isVisible && mobileSearchInput) {
                mobileSearchInput.focus();
                mobileSearchInput.value = '';
            } else if (mobileSearchInput) {
                mobileSearchInput.value = '';
            }

            // Clear search results when closing
            if (isVisible) {
                self.showSearchResults = false;
                self.searchQuery = '';
            }
        }

        if (mobileSearchIcon) {
            mobileSearchIcon.addEventListener('click', toggleMobileSearch);
        }

        // Close mobile search when clicking outside
        document.addEventListener('click', (e) => {
            if (mobileSearchContainer && !mobileSearchContainer.classList.contains('hidden') &&
                !mobileSearchContainer.contains(e.target) &&
                mobileSearchIcon && !mobileSearchIcon.contains(e.target)) {
                toggleMobileSearch();
                this.showSearchResults = false;
            }
        });

        // Desktop search functionality
        if (searchIcon) {
            searchIcon.addEventListener('click', () => {
                // Only trigger if we're in desktop view
                if (window.innerWidth >= 818) {
                    if (searchContainer) searchContainer.classList.add('active');
                    if (navItems) navItems.classList.add('hidden');
                    if (searchInput) searchInput.focus();
                }
            });
        }

        if (closeSearch) {
            closeSearch.addEventListener('click', () => {
                if (searchContainer) searchContainer.classList.remove('active');
                if (navItems) navItems.classList.remove('hidden');
                if (searchInput) searchInput.value = '';
                this.showSearchResults = false;
                this.searchQuery = '';
            });
        }

        // Close desktop search when clicking outside
        document.addEventListener('click', (e) => {
            if (!searchContainer || !searchIcon) return;

            const isClickInsideSearch = searchContainer.contains(e.target);
            const isClickOnSearchIcon = searchIcon.contains(e.target);

            // Check if desktop nav is visible and the click is outside the search container and icon
            if (window.innerWidth >= 818 && !isClickInsideSearch && !isClickOnSearchIcon) {
                searchContainer.classList.remove('active');
                if (navItems) navItems.classList.remove('hidden');
                if (searchInput) searchInput.value = '';
                this.showSearchResults = false;
            }
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', this.handleClickOutside);

        // Function to check if mobile nav is visible
        function isMobileNavVisible() {
            return window.getComputedStyle(mobileNav).display !== 'none';
        }

        // Function to close menu
        function closeMenu() {
            mobileMenu.classList.remove('active');
            document.body.style.overflow = 'auto'; // Enable scrolling when menu is closed
        }

        mobileMenuButton.addEventListener('click', () => {
            const isMenuActive = mobileMenu.classList.contains('active');
            mobileMenu.classList.toggle('active');
            document.body.style.overflow = isMenuActive ? 'auto' : 'hidden'; // Toggle overflow based on menu state
        });

        closeMenuButton.addEventListener('click', closeMenu);

        // Close menu when clicking outside
        document.addEventListener('click', (e) => {
            if (mobileMenu.classList.contains('active') &&
                !mobileMenu.contains(e.target) &&
                !mobileMenuButton.contains(e.target)) {
                closeMenu();
            }
        });

        // Close menu when window is resized to desktop view
        window.addEventListener('resize', () => {
            if (isMobileNavVisible()) {
                // Reset search state only when mobile menu is visible
                searchContainer.classList.remove('active');
                navItems.classList.remove('hidden');
                searchInput.value = '';
            }
            if (!isMobileNavVisible()) {
                closeMenu();
            }
        });

        // Setup scroll progress indicator with improved accuracy
        window.addEventListener('scroll', () => {
            const winScroll = window.pageYOffset || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            document.querySelector('.scroll-progress').style.width = `${scrolled}%`;
        });

        // Improved scroll spy functionality with section order awareness
        const sectionOrder = ['home', 'about', 'products', 'news', 'careers', 'contact'];
        let lastScrollPosition = 0;
        let scrollTimeout;

        const observerOptions = {
            root: null,
            rootMargin: '-10% 0px -10% 0px', // Adjusted for more precise detection
            threshold: [0.1, 0.3, 0.5, 0.7, 0.9] // More granular thresholds
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const sectionId = entry.target.id;
                    const currentIndex = sectionOrder.indexOf(sectionId);
                    const lastIndex = sectionOrder.indexOf(this.activeSection);

                    // Special handling for products, news, and contact sections
                    if (sectionId === 'products' || sectionId === 'news' || sectionId === 'contact') {
                        if (entry.intersectionRatio > 0.2) {
                            this.activeSection = sectionId;
                        }
                    // Slightly higher threshold for careers for more natural activation
                    } else if (sectionId === 'careers') {
                        if (entry.intersectionRatio > 0.3) {
                            this.activeSection = sectionId;
                        }
                    } else {
                        if (currentIndex > lastIndex || entry.intersectionRatio > 0.5) {
                            this.activeSection = sectionId;
                        }
                    }
                }
            });
        }, observerOptions);

        // Observe all sections with improved error handling
        document.querySelectorAll('section[id]').forEach(section => {
            if (section) {
                observer.observe(section);
            }
        });

        // Enhanced scroll event listener for more accurate section detection
        window.addEventListener('scroll', () => {
            if (scrollTimeout) {
                clearTimeout(scrollTimeout);
            }
            scrollTimeout = setTimeout(() => {
                const sections = document.querySelectorAll('section[id]');
                const scrollPosition = window.pageYOffset;
                const scrollDirection = scrollPosition > lastScrollPosition ? 'down' : 'up';
                lastScrollPosition = scrollPosition;
                const viewportHeight = window.innerHeight;
                const viewportMiddle = viewportHeight / 2;
                let mostVisibleSection = null;
                let maxVisibility = 0;
                sections.forEach(section => {
                    const rect = section.getBoundingClientRect();
                    const sectionId = section.getAttribute('id');
                    const currentIndex = sectionOrder.indexOf(sectionId);
                    const visibleTop = Math.max(0, rect.top);
                    const visibleBottom = Math.min(viewportHeight, rect.bottom);
                    const visibleHeight = Math.max(0, visibleBottom - visibleTop);
                    const visibility = visibleHeight / viewportHeight;
                    if (sectionId === 'products' || sectionId === 'news' || sectionId === 'contact') {
                        if (rect.top <= viewportMiddle && rect.bottom >= viewportMiddle) {
                            if (visibility > 0.2) {
                                this.activeSection = sectionId;
                            }
                        }
                    // Slightly higher threshold for careers
                    } else if (sectionId === 'careers') {
                        if (rect.top <= viewportMiddle && rect.bottom >= viewportMiddle) {
                            if (visibility > 0.3) {
                                this.activeSection = sectionId;
                            }
                        }
                    } else {
                        if (rect.top <= viewportMiddle && rect.bottom >= viewportMiddle) {
                            if (visibility > maxVisibility) {
                                maxVisibility = visibility;
                                mostVisibleSection = {
                                    id: sectionId,
                                    index: currentIndex
                                };
                            }
                        }
                    }
                });
                if (mostVisibleSection && maxVisibility > 0.3) {
                    const currentIndex = sectionOrder.indexOf(this.activeSection);
                    if (mostVisibleSection.index > currentIndex ||
                        (scrollDirection === 'up' && mostVisibleSection.index === currentIndex - 1)) {
                        this.activeSection = mostVisibleSection.id;
                    }
                }
            }, 50);
        });

        // Reset hoveredProduct on scroll
        window.addEventListener('scroll', () => {
            this.hoveredProduct = null;
        });

        // Reset hoveredProduct when clicking outside the product icons
        document.addEventListener('click', (e) => {
            const iconsContainer = document.getElementById('product-icons-container');
            if (
                this.hoveredProduct &&
                iconsContainer &&
                !iconsContainer.contains(e.target)
            ) {
                this.hoveredProduct = null;
            }
        });

        document.addEventListener('click', this.handleClickOutsideProductSection);
    },
    beforeDestroy() {
        document.removeEventListener('click', this.handleClickOutsideProductSection);
    },
    methods: {
        // Add new methods for capitalization
        capitalizeFirstLetter(value) {
            if (!value) return value;
            return value.charAt(0).toUpperCase() + value.slice(1);
        },

        handleFullNameInput(event) {
            // Remove any character that is not a letter or space
            let value = event.target.value.replace(/[^A-Za-z ]+/g, '');
            this.formData.full_name = this.capitalizeFirstLetter(value);
        },

        handleMessageInput(event) {
            this.formData.message = this.capitalizeFirstLetter(event.target.value);
        },

        getPhoneLength(countryCode) {
            return this.phoneLengthMap[countryCode] || 12;
        },

        getCountryFlag(iso2) {
            if (!iso2) return '';
            // Convert ISO2 country code to flag emoji
            const codePoints = iso2
                .toUpperCase()
                .split('')
                .map(char => 127397 + char.charCodeAt());
            return String.fromCodePoint(...codePoints);
        },

        toggleCountryDropdown() {
            this.showCountryDropdown = !this.showCountryDropdown;
        },

        selectCountry(country) {
            this.selectedCountry = country;
            this.formData.country_code = country.code;
            this.showCountryDropdown = false;
        },

        // Close dropdown when clicking outside
        handleClickOutside(event) {
            const dropdown = event.target.closest('.relative');
            if (!dropdown && this.showCountryDropdown) {
                this.showCountryDropdown = false;
            }
        },

        async submitInquiry() {
            try {
                this.isSubmitting = true;
                this.errorMessage = null;

                // Get expected phone length for selected country
                const expectedLength = this.getPhoneLength(this.formData.country_code);

                // Custom validation for contact_number (numbers only and correct length)
                if (!/^[0-9]+$/.test(this.formData.contact_number)) {
                    this.errorMessage = 'Contact number must contain numbers only.';
                    this.isSubmitting = false;
                    return;
                }

                if (this.formData.contact_number.length !== expectedLength) {
                    this.errorMessage = `Contact number for ${this.formData.country_code} must be ${expectedLength} digits.`;
                    this.isSubmitting = false;
                    return;
                }

                // Stricter email validation: must be in the format name@domain.com, domain must be gmail, yahoo, outlook, hotmail, or similar
                const emailPattern = /^[A-Za-z0-9._%+-]+@(gmail|yahoo|outlook|hotmail|icloud|protonmail|zoho|aol|mail|gmx|yandex)\.[A-Za-z]{2,}$/i;
                if (!emailPattern.test(this.formData.email)) {
                    this.errorMessage = 'Please enter a valid email address (e.g., name@gmail.com, name@yahoo.com).';
                    this.isSubmitting = false;
                    return;
                }

                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
                if (!csrfToken) {
                    throw new Error('CSRF token not found. Please refresh the page and try again.');
                }

                const response = await fetch('/inquiry', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(this.formData)
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Failed to submit inquiry');
                }

                // Success SweetAlert
                await Swal.fire({
                    icon: 'success',
                    title: 'Thank You!',
                    text: 'Inquiry submitted successfully!',
                    background: '#f0fff0',
                    confirmButtonColor: '#2E7D32',
                    customClass: {
                        confirmButton: 'swal2-confirm-green'
                    }
                });

                // Reset form
                this.formData = {
                    full_name: '',
                    country_code: '+63',
                    contact_number: '',
                    email: '',
                    message: ''
                };
            } catch (error) {
                console.error('Error:', error);
                this.errorMessage = error.message || 'There was an error submitting your inquiry. Please try again.';
                // Error SweetAlert
                await Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: this.errorMessage,
                    confirmButtonColor: '#2E7D32',
                    background: '#fff',
                    customClass: {
                        confirmButton: 'swal2-confirm-green'
                    }
                });
            } finally {
                this.isSubmitting = false;
            }
        },
        scrollToSection(sectionId) {
            // Always hide overlays and article view
            this.selectedNewsArticle = null;
            this.showLearnMore = false;
            this.showCareers = false;
            this.showFeaturedNews = false;
            this.showRiceProducts = false;
            this.showMangoProducts = false;
            this.showVegetableProducts = false;
            this.showSugarcaneProducts = false;
            this.showOthercropProducts = false;

            // Wait for DOM to update and section to exist
            const tryScroll = (attempts = 0) => {
                const section = document.getElementById(sectionId);
                if (section) {
                    // Close mobile menu if it's open
                    const mobileMenu = document.getElementById('mobile-menu');
                    if (mobileMenu && mobileMenu.classList.contains('active')) {
                        mobileMenu.classList.remove('active');
                        document.body.style.overflow = 'auto';
                    }
                    let offset = 0;
                    if (sectionId === 'about') {
                        offset = 100;
                    } else if (sectionId === 'products') {
                        if (window.innerWidth >= 1025) {
                            offset = 190;
                        } else if (window.innerWidth <= 426) {
                            offset = 60;
                        }
                    }
                    const sectionTop = section.getBoundingClientRect().top + window.pageYOffset - offset;
                    const startPosition = window.pageYOffset;
                    const distance = sectionTop - startPosition;
                    const duration = 1000;
                    let start = null;
                    function animation(currentTime) {
                        if (start === null) start = currentTime;
                        const timeElapsed = currentTime - start;
                        const progress = Math.min(timeElapsed / duration, 1);
                        const easeInOutCubic = progress => {
                            return progress < 0.5
                                ? 4 * progress * progress * progress
                                : 1 - Math.pow(-2 * progress + 2, 3) / 2;
                        };
                        const newPosition = startPosition + (distance * easeInOutCubic(progress));
                        window.scrollTo(0, newPosition);
                        if (timeElapsed < duration) {
                            requestAnimationFrame(animation);
                        }
                    }
                    requestAnimationFrame(animation);
                } else if (attempts < 20) {
                    setTimeout(() => tryScroll(attempts + 1), 50);
                }
            };
            tryScroll();
        },
        isDesktop() {
            return window.innerWidth >= 768;
        },
        handleProductClick(product) {
            // Scroll to the products section
            const section = document.getElementById('products');
            if (section) {
                section.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
            this.hoveredProduct = product;
        },
        handleClickOutsideProductSection(event) {
            const productSection = document.getElementById('products');
            if (
                this.hoveredProduct &&
                productSection &&
                !productSection.contains(event.target)
            ) {
                this.hoveredProduct = null;
            }
        },
        handleShowLearnMore() {
            this.showLearnMore = true;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        },
        handleCloseLearnMore() {
            this.closeAllSections();
        },
        handleShowCareers() {
            this.showCareers = true;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        },
        handleCloseCareers() {
            this.closeAllSections();
        },
        handleShowFeaturedNews() {
            this.showFeaturedNews = true;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        },
        handleCloseFeaturedNews() {
            this.closeAllSections();
        },
        handleShowRiceProducts() {
            this.showRiceProducts = true;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        },
        handleCloseRiceProducts() {
            this.closeAllSections();
        },
        handleShowMangoProducts() {
            this.showMangoProducts = true;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        },
        handleCloseMangoProducts() {
            this.closeAllSections();
        },
        handleShowVegetableProducts() {
            this.showVegetableProducts = true;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        },
        handleCloseVegetableProducts() {
            this.closeAllSections();
        },
        handleShowSugarcaneProducts() {
            this.showSugarcaneProducts = true;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        },
        handleCloseSugarcaneProducts() {
            this.closeAllSections();
        },
        handleOthercropProducts() {
            this.showOthercropProducts = true;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        },
        handleCloseOthercropProducts() {
            this.closeAllSections();
        },
        closeAllSections() {
            this.showLearnMore = false;
            this.showCareers = false;
            this.showFeaturedNews = false;
            this.showRiceProducts = false;
            this.showMangoProducts = false;
            this.showVegetableProducts = false;
            this.showSugarcaneProducts = false;
            this.showOthercropProducts = false;
            this.selectedNewsArticle = null;
        },
        handleRiceTabChange(tab) {
            this.riceActiveTab = tab;
        },
        handleVegetableTabChange(tab) {
            this.vegetableActiveTab = tab;
        },
        handleMangoTabChange(tab) {
            this.mangoActiveTab = tab;
        },
        handleSugarcaneTabChange(tab) {
            this.sugarcaneActiveTab = tab;
        },
        handleOthercropTabChange(tab) {
            this.othercropActiveTab = tab;
        },
        handleTabChange(tab) {
            this.activeTab = tab;
        },
        handleHoverProduct(product) {
            this.hoveredProduct = product;
        },
        handleResetHover() {
            this.hoveredProduct = null;
        },
        // Carousel methods
        handleCarouselTouchStart(event) {
            this.carouselTouchStartX = event.touches[0].clientX;
        },
        handleCarouselTouchMove(event) {
            this.carouselTouchEndX = event.touches[0].clientX;
        },
        handleCarouselTouchEnd() {
            const swipeThreshold = 50;
            const diff = this.carouselTouchStartX - this.carouselTouchEndX;

            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    // Swiped left - next slide
                    this.nextCarouselSlide();
                } else {
                    // Swiped right - previous slide
                    this.previousCarouselSlide();
                }
            }
        },
        nextCarouselSlide() {
            if (this.carouselCurrentSlide < this.carouselImages.length - 1) {
                this.carouselCurrentSlide++;
            } else {
                this.carouselCurrentSlide = 0; // Loop back to first slide
            }
        },
        previousCarouselSlide() {
            if (this.carouselCurrentSlide > 0) {
                this.carouselCurrentSlide--;
            } else {
                this.carouselCurrentSlide = this.carouselImages.length - 1; // Loop to last slide
            }
        },
        handleShowNewsArticle(news) {
            this.selectedNewsArticle = news;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        },
        goToFeaturedNews() {
            this.selectedNewsArticle = null;
            this.showFeaturedNews = true;
            this.showLearnMore = false;
            this.showCareers = false;
            this.showRiceProducts = false;
            this.showMangoProducts = false;
            this.showVegetableProducts = false;
            this.showSugarcaneProducts = false;
            this.showOthercropProducts = false;
            window.scrollTo({ top: 0, behavior: 'smooth' });
        },
                formatMonthYear(dateString) {
            if (!dateString) return '';
            const date = new Date(dateString);
            if (isNaN(date)) return '';
            const month = date.toLocaleString('en-US', { month: 'long' }).toUpperCase();
            const year = date.getFullYear();
            return `${month} ${year}`;
        },
        async fetchAllProducts() {
            this.isSearchLoading = true;
            try {
                const response = await fetch('https://admin.leadsagri.site/api/products');
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();
                this.allProducts = data;
                console.log('Products loaded for search:', data.length);
            } catch (error) {
                console.error('Failed to fetch products:', error);
                // Fallback to empty array to prevent errors
                this.allProducts = [];
            } finally {
                this.isSearchLoading = false;
            }
        },
        handleSearchInput(event) {
            this.searchQuery = event.target.value;
            this.showSearchResults = true;

            if (!this.searchQuery.trim()) {
                this.filteredSearchResults = [];
                return;
            }

            const query = this.searchQuery.toLowerCase();
            const searchResults = [];

            // Group products by category and type
            const groupedProducts = {};

            this.allProducts.forEach(product => {
                const category = product.category || '';
                const type = product.type || '';

                if (category.toLowerCase().includes(query) || type.toLowerCase().includes(query)) {
                    const key = `${category}-${type}`;
                    if (!groupedProducts[key]) {
                        groupedProducts[key] = {
                            category: category,
                            type: type,
                            count: 0,
                            section: this.getSectionForCategory(category)
                        };
                    }
                    groupedProducts[key].count++;
                }
            });

            // Convert to array and sort by relevance
            this.filteredSearchResults = Object.values(groupedProducts)
                .sort((a, b) => {
                    // Sort by exact matches first, then by count
                    const aExactMatch = a.category.toLowerCase() === query || a.type.toLowerCase() === query;
                    const bExactMatch = b.category.toLowerCase() === query || b.type.toLowerCase() === query;

                    if (aExactMatch && !bExactMatch) return -1;
                    if (!aExactMatch && bExactMatch) return 1;

                    return b.count - a.count;
                })
                .slice(0, 10); // Limit to 10 results
        },
        getSectionForCategory(category) {
            const categoryMap = {
                'Rice': 'rice',
                'Mango': 'mango',
                'Vegetables': 'vegetable',
                'Sugarcane': 'sugarcane',
                'Other Crops': 'othercrop'
            };
            return categoryMap[category] || 'rice';
        },
                handleSearchResultClick(result) {
            this.searchQuery = `${result.category} / ${result.type}`;
            this.showSearchResults = false;

            // Set the appropriate active tab based on the product type
            const productType = result.type;

            // Close all current product sections first
            this.showLearnMore = false;
            this.showCareers = false;
            this.showFeaturedNews = false;
            this.showRiceProducts = false;
            this.showMangoProducts = false;
            this.showVegetableProducts = false;
            this.showSugarcaneProducts = false;
            this.showOthercropProducts = false;

            // Navigate to the appropriate section
            const section = result.section;
            switch (section) {
                case 'rice':
                    this.riceActiveTab = productType;
                    this.handleShowRiceProducts();
                    break;
                case 'mango':
                    this.mangoActiveTab = productType;
                    this.handleShowMangoProducts();
                    break;
                case 'vegetable':
                    this.vegetableActiveTab = productType;
                    this.handleShowVegetableProducts();
                    break;
                case 'sugarcane':
                    this.sugarcaneActiveTab = productType;
                    this.handleShowSugarcaneProducts();
                    break;
                case 'othercrop':
                    this.othercropActiveTab = productType;
                    this.handleOthercropProducts();
                    break;
            }
        },
        highlightText(text, query) {
            if (!query || !text) return text;

            const regex = new RegExp(`(${query.replace(/[.*+?^${}()|[\]\\]/g, '\\$&')})`, 'gi');
            return text.replace(regex, '<span class="highlight">$1</span>');
        },
    },
    watch: {
        $route() {
            this.showLearnMore = false;
            this.showCareers = false;
            this.showFeaturedNews = false;
            this.showRiceProducts = false;
            this.showMangoProducts = false;
            this.showVegetableProducts = false;
            this.showSugarcaneProducts = false;
            this.showOthercropProducts = false;
        }
    },
    computed: {
        formattedSelectedArticleContent() {
            if (!this.selectedNewsArticle || !this.selectedNewsArticle.content) return '';
            // Replace every colon with two breaklines (remove the colon)
            let content = this.selectedNewsArticle.content.replace(/:/g, '<br><br>');
            // Make text inside double quotes bold, but hide the quotes
            content = content.replace(/"([^"]+)"/g, '<b>$1</b>');
            return content;
        },
    },
}
</script>

<style src="/resources/js/AppStyle.css"></style>
