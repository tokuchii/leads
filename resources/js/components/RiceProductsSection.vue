<template>
<<<<<<< HEAD
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
          <img :class="tab.imgClass" :src="tab.src" :alt="tab.alt" />
        </button>
      </div>
      <!-- Tab Content -->
      <div class="relative" :class="[activeTabBg, 'pt-6 rounded-4xl']" style="min-height: 480px;">
        <div class="bg-[#FFFFFF] rounded-4xl p-4 sm:p-8 lg:p-14 text-back shadow-xl" style="min-height: 600px;">
          <!-- Herbicide Card Layout -->
          <div v-if="activeTab === 'Herbicide' && riceHerbicideProducts.length" class="space-y-8">
            <div v-for="product in riceHerbicideProducts" :key="product.id" class="flex flex-col md:flex-row bg-white rounded-3xl overflow-hidden">
              <!-- Product Image (use product.image if available, else fallback) -->
              <div class="flex-shrink-0 flex items-center justify-center md:w-1/2 pt-12">
                <img v-if="product.image1_url" :src="product.image1_url" alt="Image 1" class="w-full h-full" />
              </div>
              <!-- Product Details -->
              <div class="flex-1 p-6 md:p-8">
                <div class="flex items-center gap-2 mb-2">
                  <span class="text-3xl font-extrabold text-green-700">{{ product.name }}</span>
                  <!-- Optionally, add a logo here if available -->
                </div>
                <img v-if="product.image2_url" :src="product.image2_url" alt="Image 2" class="w-100 h-40 object-contain mb-2" />
                <div class="mb-2">
                  <span class="font-bold">Description</span>
                  <p class="text-gray-700">{{ product.description }}</p>
                </div>
                <div class="mb-2">
                  <span class="font-bold">Features & Benefits</span>
                  <p class="text-gray-700">{{ product.features }}</p>
                </div>
                <div class="mb-2">
                  <span class="font-bold">Dosage</span>
                  <p class="text-gray-700 whitespace-pre-line">
                    <span v-for="(dose, idx) in formatDosage(product.dosage)" :key="idx">
                      {{ dose }}<br v-if="idx !== formatDosage(product.dosage).length - 1" />
                    </span>
                  </p>
                </div>
                <div>
                  <span class="font-bold">Target Weeds/Crops</span>
                  <ul class="list-disc list-inside text-gray-700">
                    <li v-for="(weed, idx) in formatTargetWeeds(product.target)" :key="idx">{{ weed }}</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- Fungicide Card Layout -->
          <div v-if="activeTab === 'Fungicide' && riceFungicideProducts.length" class="space-y-8">
            <div v-for="product in riceFungicideProducts" :key="product.id" class="flex flex-col md:flex-row bg-white rounded-3xl overflow-hidden">
              <!-- Product Image (use product.image if available, else fallback) -->
              <div class="flex-shrink-0 flex items-center justify-center md:w-1/2 pt-12">
                <img v-if="product.image1_url" :src="product.image1_url" alt="Image 1" class="w-full h-full" />
              </div>
              <!-- Product Details -->
              <div class="flex-1 p-6 md:p-8">
                <div class="flex items-center gap-2 mb-2">
                  <span class="text-3xl font-extrabold text-green-700">{{ product.name }}</span>
                  <!-- Optionally, add a logo here if available -->
                </div>
                <img v-if="product.image2_url" :src="product.image2_url" alt="Image 2" class="w-100 h-40 object-contain mb-2" />
                <div class="mb-2">
                  <span class="font-bold">Description</span>
                  <p class="text-gray-700">{{ product.description }}</p>
                </div>
                <div class="mb-2">
                  <span class="font-bold">Features & Benefits</span>
                  <p class="text-gray-700">{{ product.features }}</p>
                </div>
                <div class="mb-2">
                  <span class="font-bold">Dosage</span>
                  <p class="text-gray-700 whitespace-pre-line">
                    <span v-for="(dose, idx) in formatDosage(product.dosage)" :key="idx">
                      {{ dose }}<br v-if="idx !== formatDosage(product.dosage).length - 1" />
                    </span>
                  </p>
                </div>
                <div>
                  <span class="font-bold">Target Weeds/Crops</span>
                  <ul class="list-disc list-inside text-gray-700">
                    <li v-for="(weed, idx) in formatTargetWeeds(product.target)" :key="idx">{{ weed }}</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- Biostimulant Card Layout -->
          <div v-if="activeTab === 'Biostimulant' && riceBiostimulantProducts.length" class="space-y-8">
            <div v-for="product in riceBiostimulantProducts" :key="product.id" class="flex flex-col md:flex-row bg-white rounded-3xl overflow-hidden">
              <!-- Product Image (use product.image if available, else fallback) -->
              <div class="flex-shrink-0 flex items-center justify-center md:w-1/2 pt-12">
                <img v-if="product.image1_url" :src="product.image1_url" alt="Image 1" class="w-full h-full" />
              </div>
              <!-- Product Details -->
              <div class="flex-1 p-6 md:p-8">
                <div class="flex items-center gap-2 mb-2">
                  <span class="text-3xl font-extrabold text-green-700">{{ product.name }}</span>
                  <!-- Optionally, add a logo here if available -->
                </div>
                <img v-if="product.image2_url" :src="product.image2_url" alt="Image 2" class="w-100 h-40 object-contain mb-2" />
                <div class="mb-2">
                  <span class="font-bold">Description</span>
                  <p class="text-gray-700">{{ product.description }}</p>
                </div>
                <div class="mb-2">
                  <span class="font-bold">Features & Benefits</span>
                  <p class="text-gray-700">{{ product.features }}</p>
                </div>
                <div class="mb-2">
                  <span class="font-bold">Dosage</span>
                  <p class="text-gray-700 whitespace-pre-line">
                    <span v-for="(dose, idx) in formatDosage(product.dosage)" :key="idx">
                      {{ dose }}<br v-if="idx !== formatDosage(product.dosage).length - 1" />
                    </span>
                  </p>
                </div>
                <div>
                  <span class="font-bold">Target Weeds/Crops</span>
                  <ul class="list-disc list-inside text-gray-700">
                    <li v-for="(weed, idx) in formatTargetWeeds(product.target)" :key="idx">{{ weed }}</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- Insecticide Card Layout -->
          <div v-if="activeTab === 'Insecticide' && riceInsecticideProducts.length" class="space-y-8">
            <div v-for="product in riceInsecticideProducts" :key="product.id" class="flex flex-col md:flex-row bg-white rounded-3xl overflow-hidden">
              <!-- Product Image (use product.image if available, else fallback) -->
              <div class="flex-shrink-0 flex items-center justify-center md:w-1/2 pt-12">
                <img v-if="product.image1_url" :src="product.image1_url" alt="Image 1" class="w-full h-full" />
              </div>
              <!-- Product Details -->
              <div class="flex-1 p-6 md:p-8">
                <div class="flex items-center gap-2 mb-2">
                  <span class="text-3xl font-extrabold text-green-700">{{ product.name }}</span>
                  <!-- Optionally, add a logo here if available -->
                </div>
                <img v-if="product.image2_url" :src="product.image2_url" alt="Image 2" class="w-100 h-40 object-contain mb-2" />
                <div class="mb-2">
                  <span class="font-bold">Description</span>
                  <p class="text-gray-700">{{ product.description }}</p>
                </div>
                <div class="mb-2">
                  <span class="font-bold">Features & Benefits</span>
                  <p class="text-gray-700">{{ product.features }}</p>
                </div>
                <div class="mb-2">
                  <span class="font-bold">Dosage</span>
                  <p class="text-gray-700 whitespace-pre-line">
                    <span v-for="(dose, idx) in formatDosage(product.dosage)" :key="idx">
                      {{ dose }}<br v-if="idx !== formatDosage(product.dosage).length - 1" />
                    </span>
                  </p>
                </div>
                <div>
                  <span class="font-bold">Target Weeds/Crops</span>
                  <ul class="list-disc list-inside text-gray-700">
                    <li v-for="(weed, idx) in formatTargetWeeds(product.target)" :key="idx">{{ weed }}</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- Molluscicide Card Layout -->
          <div v-if="activeTab === 'Molluscicide' && riceMolluscicideProducts.length" class="space-y-8">
            <div v-for="product in riceMolluscicideProducts" :key="product.id" class="flex flex-col md:flex-row bg-white rounded-3xl overflow-hidden">
              <!-- Product Image (use product.image if available, else fallback) -->
              <div class="flex-shrink-0 flex items-center justify-center md:w-1/2 pt-12">
                <img v-if="product.image1_url" :src="product.image1_url" alt="Image 1" class="w-full h-full" />
              </div>
              <!-- Product Details -->
              <div class="flex-1 p-6 md:p-8">
                <div class="flex items-center gap-2 mb-2">
                  <span class="text-3xl font-extrabold text-green-700">{{ product.name }}</span>
                  <!-- Optionally, add a logo here if available -->
                </div>
                <img v-if="product.image2_url" :src="product.image2_url" alt="Image 2" class="w-100 h-40 object-contain mb-2" />
                <div class="mb-2">
                  <span class="font-bold">Description</span>
                  <p class="text-gray-700">{{ product.description }}</p>
                </div>
                <div class="mb-2">
                  <span class="font-bold">Features & Benefits</span>
                  <p class="text-gray-700">{{ product.features }}</p>
                </div>
                <div class="mb-2">
                  <span class="font-bold">Dosage</span>
                  <p class="text-gray-700 whitespace-pre-line">
                    <span v-for="(dose, idx) in formatDosage(product.dosage)" :key="idx">
                      {{ dose }}<br v-if="idx !== formatDosage(product.dosage).length - 1" />
                    </span>
                  </p>
                </div>
                <div>
                  <span class="font-bold">Target Weeds/Crops</span>
                  <ul class="list-disc list-inside text-gray-700">
                    <li v-for="(weed, idx) in formatTargetWeeds(product.target)" :key="idx">{{ weed }}</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
=======
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
                <button v-for="tab in tabs" :key="tab.alt"
                    :class="[tab.bg, 'w-17 h-18 sm:w-18 lg:w-20 md:h-20 rounded-t-full flex justify-center items-center', { '': activeTab === tab.alt }]"
                    @click="setActiveTab(tab.alt)">
                    <img :class="tab.imgClass" :src="tab.src" :alt="tab.alt">
                </button>
            </div>
            <!-- Tab Content -->
            <div class="relative" :class="[activeTabBg, 'pt-6 rounded-4xl']" style="min-height: 480px;">
                <div class="bg-[#FFFFFF] rounded-4xl p-4 sm:p-8 lg:p-14 text-back shadow-xl" style="min-height: 600px;">
                    <div v-if="activeTab === 'Herbicide'">
                        <h3 class="text-xl font-bold mb-4">Herbicide</h3>
                        <div v-if="riceHerbicideProducts.length">
                            <table class="min-w-full text-left">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2">Image 1</th>
                                        <th class="px-4 py-2">Image 2</th>
                                        <th class="px-4 py-2">Description</th>
                                        <th class="px-4 py-2">Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="product in riceHerbicideProducts" :key="product.id">
                                        <td class="border px-4 py-2">
                                            <img v-if="product.image1_url" :src="product.image1_url" alt="Image 1" class="w-20 h-20 object-contain" />
                                        </td>
                                        <td class="border px-4 py-2">
                                            <img v-if="product.image2_url" :src="product.image2_url" alt="Image 2" class="w-20 h-20 object-contain" />
                                        </td>
                                        <td class="border px-4 py-2">{{ product.description }}</td>
                                        <td class="border px-4 py-2">{{ product.type }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div v-else>
                            <p>No rice herbicide products found.</p>
                        </div>
                    </div>
                    <div v-else-if="activeTab === 'Fungicide'">
                        <h3 class="text-xl font-bold mb-4">Fungicide</h3>
                        <p>Fungicides help protect rice crops from fungal diseases, which can cause significant yield
                            losses. They are essential for maintaining healthy rice plants, especially in humid
                            environments where fungal infections are common.</p>
                    </div>
                    <div v-else-if="activeTab === 'Biostimulant'">
                        <h3 class="text-xl font-bold mb-4">Biostimulant</h3>
                        <p>Biostimulants enhance plant growth and development by improving nutrient uptake, stress
                            tolerance, and overall crop vigor. They are used to boost rice productivity and resilience
                            against environmental stresses.</p>
                    </div>
                    <div v-else-if="activeTab === 'Insecticide'">
                        <h3 class="text-xl font-bold mb-4">Insecticide</h3>
                        <p>Insecticides are used to manage insect pests that can damage rice crops. Effective pest
                            control ensures better yields and reduces crop losses due to insect infestations.</p>
                    </div>
                    <div v-else-if="activeTab === 'Molluscide'">
                        <h3 class="text-xl font-bold mb-4">Molluscicide</h3>
                        <p>Molluscicides are chemicals used to control snails and slugs, which are common pests in rice
                            fields. Controlling these pests helps protect young rice plants and ensures healthy crop
                            establishment.</p>
                    </div>
                    <div v-else>
                        <p>Select a product category above to see more information.</p>
                    </div>
                </div>
            </div>
>>>>>>> baf297255ac396d4b060fc0dc4de384a8756fb11
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
<<<<<<< HEAD
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
          src: '/images/Molluscide.png',
          bg: 'bg-[#36819C]',
          imgClass: 'w-16 h-14',
        },
      ],
      products: [],
    };
  },
  computed: {
    activeTabBg() {
      const tab = this.tabs.find(t => t.alt === this.activeTab);
      return tab ? tab.bg : 'bg-green-400';
    },
    riceHerbicideProducts() {
      return this.products
        .filter(p => p.category === 'Rice' && p.type === 'Herbicide')
        .sort((a, b) => a.id - b.id);
    },
    riceFungicideProducts() {
      return this.products
        .filter(p => p.category === 'Rice' && p.type === 'Fungicide')
        .sort((a, b) => a.id - b.id);
    },
    riceBiostimulantProducts() {
      return this.products
        .filter(p => p.category === 'Rice' && p.type === 'Biostimulant')
        .sort((a, b) => a.id - b.id);
    },
    riceInsecticideProducts() {
      return this.products
        .filter(p => p.category === 'Rice' && p.type === 'Insecticide')
        .sort((a, b) => a.id - b.id);
    },
    riceMolluscicideProducts() {
      return this.products
        .filter(p => p.category === 'Rice' && p.type === 'Molluscicide')
        .sort((a, b) => a.id - b.id);
    },
  },
  methods: {
    setActiveTab(tab) {
      this.activeTab = tab;
    },
    async fetchProducts() {
      try {
        const response = await axios.get('http://127.0.0.1:8000/api/products');
        this.products = response.data;
      } catch (error) {
        console.error('Failed to fetch products:', error);
      }
    },
    formatTargetWeeds(val) {
      if (Array.isArray(val)) return val;
      if (typeof val === 'string') return val.split(',').map(s => s.trim());
      return [];
    },
    formatDosage(val) {
      if (Array.isArray(val)) return val;
      if (typeof val === 'string') return val.split(',').map(s => s.trim());
      return [];
    },
  },
  mounted() {
    this.fetchProducts();
  },
=======
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
            products: [],
        };
    },
    computed: {
        activeTabBg() {
            const tab = this.tabs.find(t => t.alt === this.activeTab);
            return tab ? tab.bg : 'bg-green-400';
        },
        riceHerbicideProducts() {
            return this.products
                .filter(p => p.category === 'Rice' && p.type === 'Herbicide')
                .sort((a, b) => a.id - b.id);
        }
    },
    methods: {
        setActiveTab(tab) {
            this.activeTab = tab;
        },
        async fetchProducts() {
            try {
                const response = await axios.get('http://127.0.0.1:8000/api/products');
                this.products = response.data;
            } catch (error) {
                console.error('Failed to fetch products:', error);
            }
        }
    },
    mounted() {
        this.fetchProducts();
    }
>>>>>>> baf297255ac396d4b060fc0dc4de384a8756fb11
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
