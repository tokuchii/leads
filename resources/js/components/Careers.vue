<template>
    <div class="py-20 bg-gradient-to-b from-green-50 to-white">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-16 text-green-800">Join Our Team</h2>
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="space-y-8">
                    <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <h3 class="text-2xl font-semibold mb-6 text-green-700">Why Work With Us?</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <div class="text-green-500 mt-1 mr-4">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Innovative Environment</h4>
                                    <p class="text-gray-600">Work with cutting-edge technology and shape the future of agriculture</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <div class="text-green-500 mt-1 mr-4">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Growth Opportunities</h4>
                                    <p class="text-gray-600">Continuous learning and career development programs</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <div class="text-green-500 mt-1 mr-4">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Work-Life Balance</h4>
                                    <p class="text-gray-600">Flexible working hours and remote work options</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-shadow duration-300">
                            <div class="text-green-600 text-3xl mb-4">
                                <i class="fas fa-users"></i>
                            </div>
                            <h4 class="font-semibold text-green-700 mb-2">Diverse Team</h4>
                            <p class="text-gray-600">Join a multicultural team of experts</p>
                        </div>
                        <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-shadow duration-300">
                            <div class="text-green-600 text-3xl mb-4">
                                <i class="fas fa-heart"></i>
                            </div>
                            <h4 class="font-semibold text-green-700 mb-2">Great Benefits</h4>
                            <p class="text-gray-600">Competitive salary and benefits package</p>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="absolute -inset-4 bg-green-100 rounded-2xl transform -rotate-3"></div>
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                         alt="Our Team" 
                         class="rounded-2xl shadow-xl w-full h-auto relative z-10">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Careers'
}
</script>

<style scoped>
.careers-section {
    position: relative;
}

.careers-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(to right, transparent, #4CAF50, transparent);
}
</style> 