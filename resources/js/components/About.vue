<template>
    <div class="py-20 bg-gradient-to-b from-white to-green-50">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-16 text-green-800">About Us</h2>
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div class="space-y-8">
                    <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
                        <h3 class="text-2xl font-semibold mb-6 text-green-700">Our Mission</h3>
                        <p class="text-lg text-gray-600 leading-relaxed mb-6">
                            At LeadsAgri, we're committed to revolutionizing agricultural practices through innovative technology solutions. Our mission is to empower farmers with tools and knowledge that drive sustainable and efficient farming.
                        </p>
                        <p class="text-lg text-gray-600 leading-relaxed">
                            With years of experience in agricultural technology, we understand the challenges faced by modern farmers and work tirelessly to provide solutions that make a real difference.
                        </p>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-shadow duration-300">
                            <div class="text-green-600 text-3xl mb-4">
                                <i class="fas fa-leaf"></i>
                            </div>
                            <h4 class="font-semibold text-green-700 mb-2">Sustainability</h4>
                            <p class="text-gray-600">Promoting eco-friendly farming practices</p>
                        </div>
                        <div class="bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-shadow duration-300">
                            <div class="text-green-600 text-3xl mb-4">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h4 class="font-semibold text-green-700 mb-2">Innovation</h4>
                            <p class="text-gray-600">Leading with cutting-edge technology</p>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="absolute -inset-4 bg-green-100 rounded-2xl transform rotate-3"></div>
                    <img src="https://images.unsplash.com/photo-1523741543316-beb7fc7023d8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                         alt="About LeadsAgri" 
                         class="rounded-2xl shadow-xl w-full h-auto relative z-10">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'About'
}
</script>

<style scoped>
.about-section {
    position: relative;
}

.about-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(to right, transparent, #4CAF50, transparent);
}
</style> 