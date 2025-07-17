<template>
  <div class="relative w-full min-h-[800px] flex items-center justify-center rice-bg-outer overflow-hidden">
    <!-- Background image -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat z-0 rice-bg-img"></div>
    <!-- White overlay -->
    <div class="absolute inset-0 bg-white opacity-78 z-10"></div>
    <!-- Actual content -->
    <div class="relative z-20 w-full max-w-4xl mx-auto p-4 sm:p-6 lg:p-8 mt-20 sm:mt-24 lg:mt-30">
      <div class="flex justify-center items-center text-green-700 font-bold text-2xl pb-12">
        <h2>PRODUCTS FOR RICE</h2>
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
            <p>Herbicides are chemicals used to control or eliminate unwanted plants (weeds) that compete with rice for nutrients, water, and sunlight. Proper use of herbicides can significantly improve rice yields by reducing weed pressure.</p>
          </div>
          <div v-else-if="activeTab === 'Fungicide'">
            <h3 class="text-xl font-bold mb-4">Fungicide</h3>
            <p>Fungicides help protect rice crops from fungal diseases, which can cause significant yield losses. They are essential for maintaining healthy rice plants, especially in humid environments where fungal infections are common.</p>
          </div>
          <div v-else-if="activeTab === 'Biostimulant'">
            <h3 class="text-xl font-bold mb-4">Biostimulant</h3>
            <p>Biostimulants enhance plant growth and development by improving nutrient uptake, stress tolerance, and overall crop vigor. They are used to boost rice productivity and resilience against environmental stresses.</p>
          </div>
          <div v-else-if="activeTab === 'Insecticide'">
            <h3 class="text-xl font-bold mb-4">Insecticide</h3>
            <p>Insecticides are used to manage insect pests that can damage rice crops. Effective pest control ensures better yields and reduces crop losses due to insect infestations.</p>
          </div>
          <div v-else-if="activeTab === 'Molluscide'">
            <h3 class="text-xl font-bold mb-4">Molluscicide</h3>
            <p>Molluscicides are chemicals used to control snails and slugs, which are common pests in rice fields. Controlling these pests helps protect young rice plants and ensures healthy crop establishment.</p>
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
    name: 'RiceProductsSection',
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
                    alt: 'Fungicide',
                    src: '/images/Fungicide.png',
                    bg: 'bg-[#FDB913]',
                    imgClass: 'w-16 h-14',
                },
                {
                    alt: 'Biostimulant',
                    src: '/images/Biostimulant.png',
                    bg: 'bg-[#822D7E]',
                    imgClass: 'w-16 h-14',
                },
                {
                    alt: 'Insecticide',
                    src: '/images/Insecticide.png',
                    bg: 'bg-[#F37025]',
                    imgClass: 'w-16 h-14 ml-2',
                },
                {
                    alt: 'Molluscide',
                    src: '/images/Molluscicide.png',
                    bg: 'bg-[#36819C]',
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
.rice-bg-img {
  background-image: url('/images/riceimg.png');
}
.rice-bg-outer {
  /* You can adjust min-height as needed */
  min-height: 100vh;
}
</style>
