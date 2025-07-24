<template>
    <div class="w-full max-w-4xl mx-auto p-4 sm:p-6 lg:p-8 mt-30 sm:mt-30 lg:mt-36 relative">
        <!-- Removed the close button so users use the navbar to navigate -->
        <!-- Tabs -->
        <div class="tab-bar flex flex-row justify-between items-center relative z-12 " style="margin-bottom: -1px;">
            <button :class="['tab-btn cursor-pointer', activeTab === 'roots' ? 'active' : '']" @click="$emit('update:activeTab', 'roots')" style="min-width: 200px;">OUR ROOTS</button>
            <div class="flex-1 flex justify-center">
                <button :class="['tab-btn cursor-pointer', activeTab === 'vision' ? 'active' : '']" @click="$emit('update:activeTab', 'vision')" style="min-width: 200px;">OUR VISION AND MISSION</button>
            </div>
            <button :class="['tab-btn cursor-pointer', activeTab === 'commitment' ? 'active' : '']" @click="$emit('update:activeTab', 'commitment')" style="min-width: 200px;">OUR COMMITMENT</button>
        </div>
        <!-- Tab Content -->
        <div class="bg-[#008643] rounded-b-lg p-4 sm:p-8 lg:p-14 text-white shadow-lg" style="min-height: 480px;">
            <template v-if="activeTab === 'roots'">
                <div class="text-center">
                    <h2 class="font-bold text-xl sm:text-2xl lg:text-3xl mb-6 sm:mb-8 lg:mb-12">THE COMPANY</h2>
                    <div class="text-sm sm:text-base lg:text-lg leading-relaxed space-y-4 sm:space-y-6 max-w-4xl mx-auto">
                        <p>
                            Since 1997, <b>Leads Agricultural Products Corp. (LAPC)</b> has been the partner of Filipino
                            farmers in sustaining their livelihood. <b>For almost three decades now</b>, Leads Agri has been
                            nurturing the vision of a developed society rooted in an agricultural system that thrives amid
                            calamities and global pandemics. By collaborating with groups that share the same goal in
                            uplifting the Philippine agricultural sector, the company strives to overcome our unrealized
                            potential in industries connected to it.
                        </p>
                        <p>
                            The year 2020 saw us breach the 2-billion peso sale mark. This, with the company starting small
                            and initially overlooked by the industry and that barely hits their growth targets, is benchmark
                            of progress. We now have more than 500 employees serving over a thousand agricultural dealers
                            and distributors, which equip millions of Filipino farmers with the right tools and technology
                            nationwide.
                        </p>
                        <p>
                            With these strong advantages under our wing, the Leads Group of Companies now has ten
                            subsidiaries that foster the same principles.
                        </p>
                        <p>
                            With an experience portfolio that covers multiple industries, we continue to expand a dream
                            started by Filipinos for the Filipinos.
                        </p>
                    </div>
                </div>
            </template>
            <template v-else-if="activeTab === 'vision'">
                <div class="text-center">
                    <div class="text-sm sm:text-base lg:text-lg leading-relaxed space-y-4 sm:space-y-6 max-w-4xl mx-auto">
                        <div>
                            <h3 class="font-bold text-lg sm:text-xl lg:text-2xl mb-6 sm:mb-8 lg:mb-12">Our Mission</h3>
                            <p class="text-sm sm:text-base lg:text-lg mb-3 sm:mb-4">
                                Leads Agri is committed to provide a broad portfolio of science-based and cost effective
                                agricultural solutions to Filipino farmers through various channels in all agricultural
                                areas in the Philippines through cutting edge and innovative technology. We strive to
                                improve market reach by empowering the farming communities and other stakeholders in the
                                agriculture value chain to produce sustainable, accessible, and affordable food for every
                                Filipino family.
                            </p>
                            <p class="text-sm sm:text-base lg:text-lg mb-3 sm:mb-4">
                                We engage every individual with dignity and utmost respect regardless of societal status.
                            </p>
                            <p class="font-bold text-sm sm:text-base lg:text-lg mb-4 sm:mb-6">
                                "Paggawa ayon sa patnubay ng pananampalataya at malasakit"
                            </p>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg sm:text-xl lg:text-2xl mb-6 sm:mb-8 lg:mb-12">Our Vision</h3>
                            <p class="text-sm sm:text-base lg:text-lg">
                                As the leading company that provides future-proof farm productivity solutions and services,
                                we envision to be a pillar of hope and assume a pivotal role towards innovating the
                                country's agricultural value chain for the welfare of the Filipino farmers.
                            </p>
                        </div>
                    </div>
                </div>
            </template>
            <template v-else-if="activeTab === 'commitment'">
                <div class="text-sm sm:text-base lg:text-lg leading-relaxed max-w-4xl mx-auto">
                    <div class="space-y-4 sm:space-y-6">
                        <div>
                            <h3 class="font-bold text-lg sm:text-xl lg:text-2xl mb-3 sm:mb-4 text-start">Quality Policy</h3>
                            <p class="mb-3 sm:mb-4">
                                We are committed to upholding quality excellence by focusing on the following:
                            </p>
                            <div class="space-y-3 sm:space-y-4">
                                <div>
                                    <h4 class="font-bold text-sm sm:text-base lg:text-lg ml-6 sm:ml-8 lg:ml-12">• Customer satisfaction</h4>
                                    <p class="text-sm sm:text-base lg:text-lg">We create and share value by giving attention to every detail of the customer
                                        experience.</p>
                                </div>
                                <div>
                                    <h4 class="font-bold text-sm sm:text-base lg:text-lg ml-6 sm:ml-8 lg:ml-12">• Compliance</h4>
                                    <p class="text-sm sm:text-base lg:text-lg">We are <b>ISO 9001 certified since 2017</b> and we strictly
                                        comply with all legal and regulatory requirements of the <b>FPA,
                                            FDA, PNP, BOC, BIR, BAI, BPI, and DOLE.</b></p>
                                </div>
                                <div>
                                    <h4 class="font-bold text-sm sm:text-base lg:text-lg ml-6 sm:ml-8 lg:ml-12">• Continuous Improvement</h4>
                                    <p class="text-sm sm:text-base lg:text-lg">We commit to continuously provide innovative solutions and support social innovation
                                        by creating an ecosystem of entrepreneurs connected to farming.</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h3 class="font-bold text-lg sm:text-xl lg:text-2xl mb-3 sm:mb-4 text-start">Environmental Policy</h3>
                            <p class="mb-3 sm:mb-4">
                                We are committed to environmental sustainability through the following:
                            </p>
                            <div class="space-y-3 sm:space-y-4">
                                <div>
                                    <h4 class="font-bold text-sm sm:text-base lg:text-lg ml-6 sm:ml-8 lg:ml-12">• Compliance</h4>
                                    <p class="text-sm sm:text-base lg:text-lg">We ensure that we comply with local environmental regulatory requirements of <b>DENR and FPA.</b></p>
                                </div>
                                <div>
                                    <h4 class="font-bold text-sm sm:text-base lg:text-lg ml-6 sm:ml-8 lg:ml-12">• Environmental Education</h4>
                                    <p class="text-sm sm:text-base lg:text-lg">We are committed to ethical and responsible environmental protection through our
                                        product stewardship training and campaigns.</p>
                                </div>
                                <div>
                                    <h4 class="font-bold text-sm sm:text-base lg:text-lg ml-6 sm:ml-8 lg:ml-12">• Continuous carbon footprint reduction</h4>
                                    <p class="text-sm sm:text-base lg:text-lg">We veer away from red label agrochemicals and ensure that all production and
                                        distribution systems are efficient and safe for the environment.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- COMPANY HISTORY Section Below the Card -->
        <div class="mt-8 sm:mt-10 lg:mt-14 text-center">
            <h2 class="font-extrabold text-2xl sm:text-3xl lg:text-4xl mb-4 sm:mb-6 lg:mb-8 leading-tight text-black">COMPANY HISTORY</h2>
        </div>

        <!-- Company Image Carousel Section -->
        <div class="mt-8 sm:mt-12 lg:mt-16 relative">
            <div class="carousel-container relative overflow-hidden rounded-lg">
                <div 
                    class="carousel-track flex transition-transform duration-300 ease-in-out"
                    :style="{ transform: `translateX(-${carouselCurrentSlide * 100}%)` }"
                    @touchstart="$emit('carousel-touch-start', $event)"
                    @touchmove="$emit('carousel-touch-move', $event)"
                    @touchend="$emit('carousel-touch-end', $event)"
                >
                    <div 
                        v-for="(image, index) in carouselImages" 
                        :key="index"
                        class="carousel-slide flex-shrink-0 w-full"
                    >
                        <div v-if="image.src.includes('Group11.png')" class="relative w-full h-[600px] rounded-lg overflow-hidden">
                            <img 
                                :src="image.src" 
                                :alt="image.alt"
                                class="w-full h-full object-cover no-hover-effect"
                            />
                        </div>
                        <img 
                            v-else
                            :src="image.src" 
                            :alt="image.alt"
                            class="w-full h-auto rounded-lg object-cover no-hover-effect"
                            style="max-height: 800px;"
                        />
                    </div>
                </div>
                
                <!-- Navigation Buttons -->
                <button 
                    @click="$emit('carousel-prev')"
                    class="absolute left-1 sm:left-3 lg:left-4 top-[45%] transform -translate-y-1/2 bg-black bg-opacity-10 text-white rounded-full p-1.5 sm:p-1.5 lg:p-1.5 transition-all duration-200 z-10 cursor-pointer"
                    :class="{ 'opacity-0': carouselCurrentSlide === 0 }"
                >
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                
                <button 
                    @click="$emit('carousel-next')"
                    class="absolute right-1 sm:right-3 lg:right-4 top-[45%] transform -translate-y-1/2 bg-black bg-opacity-10 text-white rounded-full p-1.5 sm:p-1.5 lg:p-1.5 transition-all duration-200 z-10 cursor-pointer"
                    :class="{ 'opacity-0': carouselCurrentSlide === carouselImages.length - 1 }"
                >
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'LearnMoreSection',
    props: {
        activeTab: String,
        carouselCurrentSlide: Number,
        carouselImages: Array
    },
};
</script>
