<template>
    <div>
        <!-- Upper image/overlay/Contact Us section -->
        <div class="job-careers relative w-full">
            <div class="relative">
                <img src="/public/images/jobimg.png" alt="Contact Us Background"
                    class="career-image w-full h-[300px] sm:h-[400px] md:h-[500px] lg:h-[600px] object-cover object-top z-0">
                <div class="absolute inset-0 bg-[#004E27] opacity-60 z-10"></div>
                <div class="absolute inset-0 flex items-center justify-center z-20">
                    <h1
                        class="text-white text-3xl sm:text-4xl md:text-5xl lg:text-6xl leading-tight text-center font-helvetica-heavy drop-shadow-lg">
                        Contact Us
                    </h1>
                </div>
            </div>
        </div>

        <!-- Distributor Directory Section -->
        <div class="flex flex-col md:flex-row mt-10 gap-6 px-4 md:px-8 pb-16">

            <!-- Sidebar Regions -->
            <div class="md:w-1/4 w-full bg-white rounded-xl shadow p-4 space-y-4">
                <h2 class="text-lg font-bold text-gray-700 border-b pb-2">Directories</h2>

                <div v-for="region in orderedRegions" :key="region">
                    <!-- Region Button -->
                    <button @click="toggleRegion(region)"
                        class="w-full text-left bg-green-700 hover:bg-green-800 transition text-white p-3 rounded-lg font-medium">
                        {{ region }}
                    </button>

                    <!-- Subfolders (accordion style) -->
                    <transition name="expand">
                        <div v-show="activeRegion === region" class="ml-2 mt-3 space-y-2 overflow-hidden">
                            <div v-for="(list, place) in distributors[region]" :key="place">
                                <button @click="selectPlace(region, place, list)"
                                    class="w-full text-left bg-green-100 hover:bg-green-200 transition p-2 rounded-md text-gray-700 font-medium">
                                    {{ place }}
                                </button>
                            </div>
                        </div>
                    </transition>
                </div>
            </div>

            <!-- Distributor Cards (Scrollable) -->
            <div class="md:w-3/4 w-full">

                <div v-if="loading" class="flex justify-center items-center py-20">
                    <div class="flex space-x-2">
                        <div class="w-3 h-3 bg-green-600 rounded-full animate-bounce"></div>
                        <div class="w-3 h-3 bg-green-600 rounded-full animate-bounce [animation-delay:-0.2s]"></div>
                        <div class="w-3 h-3 bg-green-600 rounded-full animate-bounce [animation-delay:-0.4s]"></div>
                    </div>
                </div> 
                
                <transition name="card-fade" mode="out-in">
                    <div key="distributors"
                        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-h-[600px] overflow-y-auto pr-2">
                        <div v-for="item in selectedDistributors" :key="item.id"
                            class="relative flex flex-col p-6 border border-gray-200 rounded-xl shadow hover:shadow-lg transform hover:scale-[1.01] transition bg-white h-full">

                            <!-- Area Code in Top Right -->
                            <span class="absolute top-3 right-3 text-gray-400 italic text-sm">
                                {{ item.area }}
                            </span>

                            <!-- Business Name -->
                            <div class="flex items-center mb-3">
                                <h2 class="font-bold text-lg text-green-700">
                                    {{ item.business_name }}
                                </h2>
                            </div>

                            <!-- Contact Name -->
                            <div class="flex items-center gap-2 text-sm text-gray-800 mb-2">
                                <!-- Person Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-black shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5.121 17.804A9.004 9.004 0 0112 15c2.21 0 4.21.8 5.879 2.121M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="font-medium">{{ item.contact_name }}</span>
                            </div>

                            <!-- Contact Number -->
                            <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                                <!-- Phone Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 !text-black shrink-0" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm12 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM3 17a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H5a2 2 0 01-2-2v-2zm12 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>

                                <!-- Number -->
                                <a :href="`tel:${item.contact_no}`"
                                    class="underline !text-black hover:!text-green-600 transition-colors">
                                    {{ item.contact_no }}
                                </a>
                            </div>


                            <!-- Address -->
                            <div class="flex items-start gap-2 text-sm text-gray-600">
                                <!-- Location Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-black shrink-0 mt-0.5"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 11c1.657 0 3-1.343 3-3S13.657 5 12 5 9 6.343 9 8s1.343 3 3 3zM12 22s8-4.5 8-11a8 8 0 10-16 0c0 6.5 8 11 8 11z" />
                                </svg>
                                <button @click="openDirections(item.address)"
                                    class="underline hover:text-green-700 text-black text-left">
                                    {{ item.address }}
                                </button>
                            </div>


                        </div>
                    </div>
                </transition>
            </div>

        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "ContactUs",
    data() {
        return {
            activeRegion: null, // which region is expanded
            selectedDistributors: [],
            distributors: {},
            loading: true
        };
    },
    created() {
        this.fetchDistributors();
    },
    methods: {
        async fetchDistributors() {
            try {
                const response = await axios.get("http://127.0.0.1:8000/api/distributors");
                this.distributors = response.data;

                // Default: Luzon expanded and its distributors loaded
                if (this.distributors.Luzon) {
                    this.activeRegion = "Luzon"; // keep Luzon open
                    this.selectedDistributors = Object.values(this.distributors["Luzon"]).flat();
                }
            } catch (error) {
                console.error("Failed to fetch distributors:", error);
            } finally {
                this.loading = false;
            }
        },
        selectPlace(region, place, list) {
            this.selectedDistributors = list; // updates immediately, no refresh
        },
        toggleRegion(region) {
            // Always expand the selected region, never collapse on second click
            this.activeRegion = region;
            this.selectedDistributors = Object.values(this.distributors[region] || {}).flat();
        },
        openDirections(address) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        const userLat = position.coords.latitude;
                        const userLng = position.coords.longitude;

                        // Open Google Maps with directions
                        const mapsUrl = `https://www.google.com/maps/dir/?api=1&origin=${userLat},${userLng}&destination=${encodeURIComponent(address)}`;
                        window.open(mapsUrl, "_blank");
                    },
                    (error) => {
                        console.warn("Geolocation error:", error);

                        // Fallback: just open the destination location
                        const mapsUrl = `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(address)}`;
                        window.open(mapsUrl, "_blank");

                        switch (error.code) {
                            case error.PERMISSION_DENIED:
                                alert("You denied location access. Opening place only.");
                                break;
                            case error.POSITION_UNAVAILABLE:
                                alert("Location information unavailable. Opening place only.");
                                break;
                            case error.TIMEOUT:
                                alert("Location request timed out. Opening place only.");
                                break;
                            default:
                                alert("An unknown error occurred. Opening place only.");
                        }
                    },
                    {
                        enableHighAccuracy: true,
                        timeout: 10000,
                        maximumAge: 0
                    }
                );
            } else {
                const mapsUrl = `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(address)}`;
                window.open(mapsUrl, "_blank");
            }
        }
    },
    computed: {
        orderedRegions() {
            const order = ["Luzon", "Visayas", "Mindanao"];
            return order.filter((r) => this.distributors[r]);
        }
    }
};
</script>


<style scoped>
/* Expand Transition */
.expand-enter-active,
.expand-leave-active {
    transition: max-height 0.4s ease, opacity 0.3s ease;
}

.expand-enter-from,
.expand-leave-to {
    max-height: 0;
    opacity: 0;
}

.expand-enter-to,
.expand-leave-from {
    max-height: 600px;
    opacity: 1;
}

/* Card fade transition */
.card-fade-enter-active,
.card-fade-leave-active {
    transition: opacity 0.4s ease, transform 0.3s ease;
}

.card-fade-enter-from,
.card-fade-leave-to {
    opacity: 0;
    transform: scale(0.97);
}
</style>
