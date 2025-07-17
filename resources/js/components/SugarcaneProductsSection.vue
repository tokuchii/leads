<template>
  <div class="relative w-full min-h-[800px] flex items-center justify-center sugarcane-bg-outer overflow-hidden">
    <!-- Background image -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat z-0 sugarcane-bg-img"></div>
    <!-- White overlay -->
    <div class="absolute inset-0 bg-white opacity-70 z-10"></div>
    <!-- Actual content -->
    <div class="relative z-20 w-full max-w-4xl mx-auto p-4 sm:p-6 lg:p-8 mt-20 sm:mt-24 lg:mt-30">
      <div class="flex justify-center items-center text-green-700 font-bold text-2xl pb-12">
        <h2>PRODUCTS FOR SUGARCANE</h2>
      </div>
      <!-- Tabs -->
      <div class="flex justify-center gap-2 md:gap-8 lg:gap-12 px-6" style="margin-bottom: -1px;">
        <button
          v-for="tab in tabs"
          :key="tab.alt"
          :class="[tab.bg, 'w-17 h-18 sm:w-18 lg:w-20 md:h-20 rounded-t-full flex justify-center items-center', { '' : activeTab === tab.alt }]"
          @click="setActiveTab(tab.alt)"
        >
          <img :class="tab.imgClass" :src="tab.src" :alt="tab.alt">
        </button>
      </div>
      <!-- Tab Content -->
      <div class="relative" :class="[activeTabBg, 'pt-6 rounded-4xl']" style="min-height: 480px;">
        <div class="bg-[#FFFFFF] rounded-4xl p-4 sm:p-8 lg:p-14 text-back shadow-xl" style="min-height: 600px;">
          <div v-if="activeTab === 'Herbicide'">
            <h3 class="text-xl font-bold mb-4">Herbicide</h3>
            <p>Herbicides are used in sugarcane farming to control weeds that compete with sugarcane for nutrients, water, and sunlight. Effective weed management is crucial for maximizing sugarcane yield and quality.</p>
          </div>
          <div v-else-if="activeTab === 'Biostimulant'">
            <h3 class="text-xl font-bold mb-4">Biostimulant</h3>
            <p>Biostimulants enhance sugarcane growth, improve nutrient uptake, and increase resistance to environmental stress, resulting in more robust and productive crops.</p>
          </div>
          <div v-else>
            <p>Select a product category above to see more information.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
    name: 'SugarcaneProductsSection',
    data() {
        return {
            activeTab: 'Herbicide',
            tabs: [
                {
                    alt: 'Herbicide',
                    src: '/images/Herbicide.png',
                    bg: 'bg-[#22AA4A]',
                    imgClass: 'w-12 h-14',
                },
                {
                    alt: 'Biostimulant',
                    src: '/images/Biostimulant.png',
                    bg: 'bg-[#822D7E]',
                    imgClass: 'w-16 h-14',
                },
            ],
        };
    },
    computed: {
        activeTabBg() {
            const tab = this.tabs.find(t => t.alt === this.activeTab);
            return tab ? tab.bg : 'bg-green-400';
        },
    },
    methods: {
        setActiveTab(tab) {
            this.activeTab = tab;
        },
    },
};
</script>
<style scoped>
.sugarcane-bg-img {
  background-image: url('/images/sugarcaneimg.png');
}
.sugarcane-bg-outer {
  min-height: 100vh;
}
</style>
