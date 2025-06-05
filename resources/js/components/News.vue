<template>
    <div class="py-20 bg-gradient-to-b from-white to-green-50">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-16 text-green-800">Latest News</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1625246333195-78d9c38ad449?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                             alt="News 1" 
                             class="w-full h-48 object-cover">
                        <div class="absolute top-4 left-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm">
                            Technology
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-3 text-green-700">New Smart Irrigation System Launch</h3>
                        <p class="text-gray-600 mb-4">
                            Introducing our latest smart irrigation system with advanced AI capabilities for optimal water management.
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">March 15, 2024</span>
                            <a href="#" class="text-green-600 hover:text-green-700 font-medium">Read More →</a>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1523741543316-beb7fc7023d8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                             alt="News 2" 
                             class="w-full h-48 object-cover">
                        <div class="absolute top-4 left-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm">
                            Innovation
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-3 text-green-700">Sustainable Farming Practices</h3>
                        <p class="text-gray-600 mb-4">
                            Discover how our new sustainable farming practices are helping farmers reduce environmental impact.
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">March 10, 2024</span>
                            <a href="#" class="text-green-600 hover:text-green-700 font-medium">Read More →</a>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1625246333195-78d9c38ad449?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                             alt="News 3" 
                             class="w-full h-48 object-cover">
                        <div class="absolute top-4 left-4 bg-green-500 text-white px-3 py-1 rounded-full text-sm">
                            Research
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-3 text-green-700">AI in Agriculture</h3>
                        <p class="text-gray-600 mb-4">
                            Exploring the impact of artificial intelligence on modern agricultural practices and future trends.
                        </p>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">March 5, 2024</span>
                            <a href="#" class="text-green-600 hover:text-green-700 font-medium">Read More →</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'News'
}
</script>

<style scoped>
.news-section {
    position: relative;
}

.news-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(to right, transparent, #4CAF50, transparent);
}
</style> 