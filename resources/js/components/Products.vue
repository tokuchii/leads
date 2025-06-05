<template>
    <div class="py-20 bg-gradient-to-b from-green-50 to-white">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-16 text-green-800">Our Products</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="text-green-600 text-4xl mb-6">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4 text-green-700">Smart Irrigation</h3>
                    <p class="text-gray-600 mb-6">
                        Automated irrigation systems that optimize water usage based on real-time soil and weather data.
                    </p>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Water conservation
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Real-time monitoring
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Weather integration
                        </li>
                    </ul>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="text-green-600 text-4xl mb-6">
                        <i class="fas fa-robot"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4 text-green-700">Crop Monitoring</h3>
                    <p class="text-gray-600 mb-6">
                        AI-powered systems that monitor crop health and detect potential issues before they become problems.
                    </p>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Disease detection
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Growth tracking
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Yield prediction
                        </li>
                    </ul>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="text-green-600 text-4xl mb-6">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3 class="text-2xl font-semibold mb-4 text-green-700">Farm Management</h3>
                    <p class="text-gray-600 mb-6">
                        Comprehensive mobile app for managing all aspects of your farm operations efficiently.
                    </p>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Resource planning
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Inventory tracking
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            Financial analytics
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Products'
}
</script>

<style scoped>
.products-section {
    position: relative;
}

.products-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(to right, transparent, #4CAF50, transparent);
}
</style> 