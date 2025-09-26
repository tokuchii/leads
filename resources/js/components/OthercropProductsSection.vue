<template>
    <div class="relative w-full min-h-[800px] flex items-center justify-center othercrops-bg-outer overflow-hidden">
        <!-- Background image -->
        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat z-0 othercrops-bg-img"></div>
        <!-- White overlay -->
        <div class="absolute inset-0 bg-white opacity-78 z-10"></div>
        <!-- Actual content -->
        <div class="relative z-20 w-full max-w-4xl mx-auto p-4 sm:p-6 lg:p-8 mt-20 sm:mt-24 lg:mt-30">
            <div class="flex justify-center items-center text-green-700 font-bold text-xl sm:text-2xl md:text-3xl lg:text-4xl pb-12 text-center">
                <h2>PRODUCTS FOR OTHER CROPS</h2>
            </div>
             <!-- Tabs Container -->
            <div class="flex justify-center gap-1 px-1 sm:gap-2 sm:px-2 md:gap-8 lg:gap-12 overflow-x-auto">
                <button v-for="tab in tabs" :key="tab.alt" :class="[tab.bg,
                    'flex-shrink-0 w-12 sm:w-14 md:w-18 lg:w-20 h-14 sm:h-18 md:h-20 rounded-t-full flex justify-center items-center cursor-pointer',
                { '': activeTab === tab.alt }]" @click="setActiveTab(tab.alt)">
                    <img :class="[
                        'object-contain transition-all duration-300',
                        'w-6 sm:w-10 md:w-14 lg:w-16 h-6 sm:h-10 md:h-14 lg:h-16'
                    ]" :src="tab.src" :alt="tab.alt" />
                </button>
            </div>

            <!-- Tab Content -->
            <div class="relative -mt-1" :class="[activeTabBg, 'pt-6 sm:pt-8 rounded-4xl']" style="min-height: 580px;">
                <div v-if="['Herbicide', 'Fungicide', 'Biostimulant', 'Insecticide', 'Molluscicide'].includes(activeTab)"
                    class="flex justify-center items-center text-white font-helvetica-heavy text-center text-sm sm:text-lg md:text-2xl pb-3 sm:pb-4 px-2">
                    <h2>{{tabs.find(t => t.alt === activeTab).type}}</h2>
                </div>
                <div class="bg-[#FFFFFF] rounded-4xl p-2 sm:p-6 lg:p-14 text-back shadow-xl" style="min-height: 640px;">

                        <BubbleLoader v-if="loading" />

                    <!-- Herbicide Card Layout -->
                    <div v-if="activeTab === 'Herbicide' && othercropsHerbicideProducts.length" class="space-y-8">
                        <div v-for="product in othercropsHerbicideProducts" :key="product.id"
                            class="product-card flex flex-col md:flex-row bg-white rounded-3xl overflow-hidden">
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
                                    <p class="text-gray-700 text-justify">{{ product.description }}</p>
                                </div>
                                <div class="mb-2">
                                    <span class="font-bold">Features & Benefits</span>
                                    <p class="text-gray-700 text-justify">{{ product.features }}</p>
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
                                    <div class="flex gap-4">
                                        <ul v-for="(chunk, colIdx) in chunkArray(formatTargetWeeds(product.target), 6)"
                                            :key="colIdx"
                                            class="list-disc list-outside text-gray-700 text-[14px] md:text-[16px] pl-4">
                                            <li v-for="(weed, idx) in chunk" :key="idx">{{ weed }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Fungicide Card Layout -->
                    <div v-if="activeTab === 'Fungicide' && othercropsFungicideProducts.length" class="space-y-8">
                        <div v-for="product in othercropsFungicideProducts" :key="product.id"
                            class="product-card flex flex-col md:flex-row bg-white rounded-3xl overflow-hidden">
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
                                    <p class="text-gray- text-justify">{{ product.description }}</p>
                                </div>
                                <div class="mb-2">
                                    <span class="font-bold">Features & Benefits</span>
                                    <p class="text-gray-700 text-justify">{{ product.features }}</p>
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
                                    <div class="flex gap-4">
                                        <ul v-for="(chunk, colIdx) in chunkArray(formatTargetWeeds(product.target), 6)"
                                            :key="colIdx"
                                            class="list-disc list-outside text-gray-700 text-[14px] md:text-[16px] pl-4">
                                            <li v-for="(weed, idx) in chunk" :key="idx">{{ weed }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Insecticide Card Layout -->
                    <div v-if="activeTab === 'Insecticide' && othercropsInsecticideProducts.length" class="space-y-8">
                        <div v-for="product in othercropsInsecticideProducts" :key="product.id"
                            class="product-card flex flex-col md:flex-row bg-white rounded-3xl overflow-hidden">
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
                                    <p class="text-gray-700 text-justify">{{ product.description }}</p>
                                </div>
                                <div class="mb-2">
                                    <span class="font-bold">Features & Benefits</span>
                                    <p class="text-gray-700 text-justify">{{ product.features }}</p>
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
                                    <div class="flex gap-4">
                                        <ul v-for="(chunk, colIdx) in chunkArray(formatTargetWeeds(product.target), 6)"
                                            :key="colIdx"
                                            class="list-disc list-outside text-gray-700 text-[14px] md:text-[16px] pl-4">
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
import BubbleLoader from './BubbleLoader.vue';

export default {
    name: 'OthercropsProductsSection',
    components: {
        BubbleLoader,
    },
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
                    type: 'HERBICIDE',
                },
                {
                    alt: 'Fungicide',
                    src: '/images/Fungicide.png',
                    bg: 'bg-[#FDB913]',
                    imgClass: 'w-16 h-14',
                    type: 'FUNGICIDE / BACTERICIDE',
                },
                {
                    alt: 'Insecticide',
                    src: '/images/Insecticide.png',
                    bg: 'bg-[#F37025]',
                    imgClass: 'w-16 h-14 ml-2',
                    type: 'INSECTICIDE',
                },
            ],
            products: [],
            loading: true,
        };
    },
    computed: {
        activeTabBg() {
            const tab = this.tabs.find(t => t.alt === this.activeTab);
            return tab ? tab.bg : 'bg-green-400';
        },
        othercropsHerbicideProducts() {
            return this.products
                .filter(p => p.category === 'Other Crops' && p.type === 'Herbicide')
                .sort((a, b) => a.id - b.id);
        },
        othercropsFungicideProducts() {
            return this.products
                .filter(p => p.category === 'Other Crops' && p.type === 'Fungicide')
                .sort((a, b) => a.id - b.id);
        },
        othercropsInsecticideProducts() {
            return this.products
                .filter(p => p.category === 'Other Crops' && p.type === 'Insecticide')
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
            }   finally {
                this.loading = false;
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
.othercrops-bg-img {
    background-image: url('/images/othercropsimg.jpg');
    background-attachment: fixed;
    /* Keeps image fixed on scroll */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
}

.othercrops-back-bg-outer {
    /* You can adjust min-height as needed */
    min-height: 100vh;
}

.font-helvetica-heavy {
    font-family: 'Helvetica Neue LT Std', sans-serif;
    font-weight: 800;
}

/* Inside <style scoped> */
@media (max-width: 360px) {
    .product-card {
        padding: 0.75rem !important;
        /* reduce inner spacing */
    }

    .product-card img {
        max-height: 120px !important;
        /* shrink images */
    }

    .product-card .text-3xl {
        font-size: 1.25rem !important;
        /* shrink title */
    }

    .product-card p {
        font-size: 0.75rem !important;
        /* shrink description text */
    }

    .product-card ul {
        font-size: 0.75rem !important;
        /* shrink bullet text */
    }
}
</style>
