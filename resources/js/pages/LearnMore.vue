<template>
    <!--main content-->
    <div class="flex justify-center items-center min-h-[80vh] px-2 py-8 pt-24">
        <div
            class="w-full max-w-lg sm:max-w-xl md:max-w-2xl lg:max-w-3xl xl:max-w-4xl 2xl:max-w-5xl rounded-lg p-2 sm:p-4 md:p-6 lg:p-8">
            <!-- Tabs -->
            <div class="tab-bar flex flex-row justify-between items-center relative z-10" style="margin-bottom: -1px;">
                <!-- Left tab -->
                <button :class="['tab-btn', activeTab === 'roots' ? 'active' : '']" @click="activeTab = 'roots'"
                    style="min-width: 180px;">OUR ROOTS</button>
                <!-- Center tab (wrapped for centering) -->
                <div class="flex-1 flex justify-center">
                    <button :class="['tab-btn', activeTab === 'vision' ? 'active' : '']" @click="activeTab = 'vision'"
                        style="min-width: 240px;">OUR VISION AND MISSION</button>
                </div>
                <!-- Right tab -->
                <button :class="['tab-btn', activeTab === 'commitment' ? 'active' : '']"
                    @click="activeTab = 'commitment'" style="min-width: 200px;">OUR COMMITMENT</button>
            </div>
            <!-- Tab Content -->
            <div class="bg-[#008643] rounded-b-lg p-14 text-white text-center shadow-lg" style="min-height: 480px;">
                <template v-if="activeTab === 'roots'">
                    <h2 class="font-bold text-2xl mb-6">THE COMPANY</h2>
                    <p class="mb-4 text-base leading-relaxed">
                        Since 1997, <b>Leads Agricultural Products Corp. (LAPC)</b> has been the partner of Filipino
                        farmers in sustaining their livelihood. <b>For almost three decades now</b>, Leads Agri has been
                        nurturing the vision of a developed society rooted in an agricultural system that thrives amid
                        calamities and global pandemics. By collaborating with groups that share the same goal in
                        uplifting the Philippine agricultural sector, the company strives to overcome our unrealized
                        potential in industries connected to it.
                    </p>
                    <p class="mb-4 text-base leading-relaxed">
                        The year 2020 saw us breach the 2-billion peso sale mark. This, with the company starting small
                        and initially overlooked by the industry and that barely hits their growth targets, is benchmark
                        of progress. We now have more than 500 employees serving over a thousand agricultural dealers
                        and distributors, which equip millions of Filipino farmers with the right tools and technology
                        nationwide.
                    </p>
                    <p class="mb-4 text-base leading-relaxed">
                        With these strong advantages under our wing, the Leads Group of Companies now has ten
                        subsidiaries that foster the same principles.
                    </p>
                    <p class="mb-0 text-base leading-relaxed">
                        With an experience portfolio that covers multiple industries, we continue to expand a dream
                        started by Filipinos for the Filipinos.
                    </p>
                </template>
                <template v-else-if="activeTab === 'vision'">
                    <div class="text-base leading-relaxed">
                        <div class="font-bold mb-2">Our Mission</div>
                        <div class="mb-4">
                            Leads Agri is committed to provide a broad portfolio of science-based and cost effective
                            agricultural solutions to Filipino farmers through various channels in all agricultural
                            areas in the Philippines through cutting edge and innovative technology. We strive to
                            improve market reach by empowering the farming communities and other stakeholders in the
                            agriculture value chain to produce sustainable, accessible, and affordable food for every
                            Filipino family.
                        </div>
                        <div class="mb-4">
                            We engage every individual with dignity and utmost respect regardless of societal status.
                        </div>
                        <div class="mb-6 font-bold text-lg">
                            "Paggawa ayon sa patnubay ng pananampalataya at malasakit"
                        </div>
                        <div class="font-bold mb-2">Our Vision</div>
                        <div>
                            As the leading company that provides future-proof farm productivity solutions and services,
                            we envision to be a pillar of hope and assume a pivotal role towards innovating the
                            country's agricultural value chain for the welfare of the Filipino farmers.
                        </div>
                    </div>
                </template>
                <template v-else-if="activeTab === 'commitment'">
                    <div class="commitment-content text-base leading-relaxed text-left text-white"
                        style="max-width: 750px; margin: 0 auto;">
                        <div class="font-bold mb-2">Quality Policy</div>
                        <div class="mb-4">
                            We are committed to upholding quality excellence by focusing on the following:
                        </div>
                        <div class="mb-4">
                            <span class="font-bold commitment-bullet">• Customer satisfaction</span><br>
                            <span>We create and share value by giving attention to every detail of the customer
                                experience.</span>
                        </div>
                        <div class="mb-4">
                            <span class="font-bold commitment-bullet">• Compliance</span><br>
                            <span>We are <span class='font-bold'>ISO 9001 certified since 2017</span> and we strictly
                                comply with all legal and regulatory requirements of the <span class='font-bold'>FPA,
                                    FDA, PNP, BOC, BIR, BAI, BPI, and DOLE.</span></span>
                        </div>
                        <div class="mb-6">
                            <span class="font-bold commitment-bullet">• Continuous Improvement</span><br>
                            <span>We commit to continuously provide innovative solutions and support social innovation
                                by creating an ecosystem of entrepreneurs connected to farming.</span>
                        </div>
                        <div class="font-bold mb-2">Environmental Policy</div>
                        <div class="mb-4">
                            We are committed to environmental sustainability through the following:
                        </div>
                        <div class="mb-4">
                            <span class="font-bold commitment-bullet">• Compliance</span><br>
                            <span>We ensure that we comply with local environmental regulatory requirements of <span
                                    class='font-bold'>DENR and FPA.</span></span>
                        </div>
                        <div class="mb-4">
                            <span class="font-bold commitment-bullet">• Environmental Education</span><br>
                            <span>We are committed to ethical and responsible environmental protection through our
                                product stewardship training and campaigns.</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-bold commitment-bullet">• Continuous carbon footprint reduction</span><br>
                            <span>We veer away from red label agrochemicals and ensure that all production and
                                distribution systems are efficient and safe for the environment.</span>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

</template>

<script src="../resources/js/AppScript.js"></script>

<style src="../resources/js/AppStyle.css"></style>