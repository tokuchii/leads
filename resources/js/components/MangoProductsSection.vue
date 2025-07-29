<template>
    <div class="relative w-full min-h-[800px] flex items-center justify-center mango-bg-outer overflow-hidden">
        <!-- Background image -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat z-0 mango-bg-img"></div>
        <!-- White overlay -->
        <div class="absolute inset-0 bg-white opacity-78 z-10"></div>
        <!-- Actual content -->
        <div class="relative z-20 w-full max-w-4xl mx-auto p-4 sm:p-6 lg:p-8 mt-20 sm:mt-24 lg:mt-30">
            <div class="flex justify-center items-center text-green-700 font-bold text-2xl pb-12">
                <h2>PRODUCTS FOR MANGO</h2>
            </div>
            <!-- Tabs -->
            <div class="flex justify-center gap-2 md:gap-8 lg:gap-12 px-6" style="margin-bottom: -1px;">
                <button v-for="tab in tabs" :key="tab.alt"
                    :class="[tab.bg, 'w-17 h-18 sm:w-18 lg:w-20 md:h-20 rounded-t-full flex justify-center items-center cursor-pointer', { '': activeTab === tab.alt }]"
                    @click="setActiveTab(tab.alt)">
                    <img :class="tab.imgClass" :src="tab.src" :alt="tab.alt" />
                </button>
            </div>
            <!-- Tab Content -->
            <div class="relative" :class="[activeTabBg, 'pt-6 rounded-4xl']" style="min-height: 480px;">
                <div class="bg-[#FFFFFF] rounded-4xl p-4 sm:p-8 lg:p-14 text-back shadow-xl" style="min-height: 600px;">
                    <!-- Herbicide Card Layout -->
                    <div v-if="activeTab === 'Herbicide' && mangoHerbicideProducts.length" class="space-y-8">
                        <div v-for="product in mangoHerbicideProducts" :key="product.id"
                            class="flex flex-col md:flex-row bg-white rounded-3xl overflow-hidden">
                            <div class="flex-shrink-0 flex items-center justify-center md:w-80 pt-12">
                                <img v-if="product.image1_url" :src="product.image1_url" alt="Image 1"
                                    class="object-contain h-full w-full mx-auto" />
                            </div>
                            <div class="flex-1 p-6 md:p-8">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-3xl font-extrabold text-green-700">{{ product.name }}</span>
                                </div>
                                <img v-if="product.image2_url" :src="product.image2_url" alt="Image 2"
                                    class="w-100 h-40 object-contain mb-2" />
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
                                    <div class="flex gap-6">
                                        <ul v-for="(chunk, colIdx) in chunkArray(formatTargetWeeds(product.target), 6)"
                                            :key="colIdx" class="list-disc list-outside text-gray-700 text-m pl-4">
                                            <li v-for="(weed, idx) in chunk" :key="idx">{{ weed }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fungicide Card Layout -->
                    <div v-if="activeTab === 'Fungicide' && mangoFungicideProducts.length" class="space-y-8">
                        <div v-for="product in mangoFungicideProducts" :key="product.id"
                            class="flex flex-col md:flex-row bg-white rounded-3xl overflow-hidden">
                            <div class="flex-shrink-0 flex items-center justify-center md:w-80 pt-12">
                                <img v-if="product.image1_url" :src="product.image1_url" alt="Image 1"
                                    class="object-contain h-full w-full mx-auto" />
                            </div>
                            <div class="flex-1 p-6 md:p-8">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-3xl font-extrabold text-green-700">{{ product.name }}</span>
                                </div>
                                <img v-if="product.image2_url" :src="product.image2_url" alt="Image 2"
                                    class="w-100 h-40 object-contain mb-2" />
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
                                    <div class="flex gap-6">
                                        <ul v-for="(chunk, colIdx) in chunkArray(formatTargetWeeds(product.target), 6)"
                                            :key="colIdx" class="list-disc list-outside text-gray-700 text-m pl-4">
                                            <li v-for="(weed, idx) in chunk" :key="idx">{{ weed }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Biostimulant Card Layout -->
                    <div v-if="activeTab === 'Biostimulant' && mangoBiostimulantProducts.length" class="space-y-8">
                        <div v-for="product in mangoBiostimulantProducts" :key="product.id"
                            class="flex flex-col md:flex-row bg-white rounded-3xl overflow-hidden">
                            <div class="flex-shrink-0 flex items-center justify-center md:w-80 pt-12">
                                <img v-if="product.image1_url" :src="product.image1_url" alt="Image 1"
                                    class="object-contain h-full w-full mx-auto" />
                            </div>
                            <div class="flex-1 p-6 md:p-8">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-3xl font-extrabold text-green-700">{{ product.name }}</span>
                                </div>
                                <img v-if="product.image2_url" :src="product.image2_url" alt="Image 2"
                                    class="w-100 h-40 object-contain mb-2" />
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
                                    <div class="flex gap-6">
                                        <ul v-for="(chunk, colIdx) in chunkArray(formatTargetWeeds(product.target), 6)"
                                            :key="colIdx" class="list-disc list-outside text-gray-700 text-m pl-4">
                                            <li v-for="(weed, idx) in chunk" :key="idx">{{ weed }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Insecticide Card Layout -->
                    <div v-if="activeTab === 'Insecticide' && mangoInsecticideProducts.length" class="space-y-8">
                        <div v-for="product in mangoInsecticideProducts" :key="product.id"
                            class="flex flex-col md:flex-row bg-white rounded-3xl overflow-hidden">
                            <div class="flex-shrink-0 flex items-center justify-center md:w-80 pt-12">
                                <img v-if="product.image1_url" :src="product.image1_url" alt="Image 1"
                                    class="object-contain h-full w-full mx-auto" />
                            </div>
                            <div class="flex-1 p-6 md:p-8">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-3xl font-extrabold text-green-700">{{ product.name }}</span>
                                </div>
                                <img v-if="product.image2_url" :src="product.image2_url" alt="Image 2"
                                    class="w-100 h-40 object-contain mb-2" />
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
                                    <div class="flex gap-6">
                                        <ul v-for="(chunk, colIdx) in chunkArray(formatTargetWeeds(product.target), 6)"
                                            :key="colIdx" class="list-disc list-outside text-gray-700 text-m pl-4">
                                            <li v-for="(weed, idx) in chunk" :key="idx">{{ weed }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'MangoProductsSection',
    props: {
        activeTab: {
            type: String,
            default: 'Herbicide'
        }
    },
    data() {
        return {
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
            ],
            products: [],
        };
    },
    computed: {
        activeTabBg() {
            const tab = this.tabs.find(t => t.alt === this.activeTab);
            return tab ? tab.bg : 'bg-green-400';
        },
        mangoHerbicideProducts() {
            return this.products
                .filter(p => p.category === 'Mango' && p.type === 'Herbicide')
                .sort((a, b) => a.id - b.id);
        },
        mangoFungicideProducts() {
            return this.products
                .filter(p => p.category === 'Mango' && p.type === 'Fungicide')
                .sort((a, b) => a.id - b.id);
        },
        mangoBiostimulantProducts() {
            return this.products
                .filter(p => p.category === 'Mango' && p.type === 'Biostimulant')
                .sort((a, b) => a.id - b.id);
        },
        mangoInsecticideProducts() {
            return this.products
                .filter(p => p.category === 'Mango' && p.type === 'Insecticide')
                .sort((a, b) => a.id - b.id);
        },
    },
    methods: {
        setActiveTab(tab) {
            this.$emit('update:activeTab', tab);
        },
        async fetchProducts() {
            try {
                const response = await axios.get('https://admin.leadsagri.site/api/products');
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
        chunkArray(array, chunkSize) {
            const result = [];
            for (let i = 0; i < array.length; i += chunkSize) {
                result.push(array.slice(i, i + chunkSize));
            }
            return result;
        },
    },
    mounted() {
        this.fetchProducts();
    },
};
</script>

<style scoped>
.mango-bg-img {
  background-image: url('/images/mangoimg.png');
  background-attachment: fixed; /* Keeps image fixed on scroll */
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
}

.mango-bg-outer {
    /* You can adjust min-height as needed */
    min-height: 100vh;
}
</style>
