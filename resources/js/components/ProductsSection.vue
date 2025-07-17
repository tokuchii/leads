<template>
    <!-- Products Section (Directly Below About Section) -->
    <section id="products" class="product-container flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 relative" @mouseleave="$emit('reset-hover')">
        <!-- Only show heading and grid if not hovering a product -->
        <template v-if="!hoveredProduct">
            <h2 class="text-3xl sm:text-5xl md:text-6xl lg:text-7xl font-bold text-white text-center mb-10 md:mb-16 lg:mb-20">FARMING SOLUTIONS</h2>
            <div
                id="product-icons-container"
                class="grid grid-cols-2 lg:grid-cols-5 gap-8 md:gap-12 lg:gap-30 xl:gap-32 w-full max-w-5xl mx-auto"
            >
                <div
                    v-for="(product, index) in productIcons"
                    :key="index"
                    :class="[
                        'hover-lift cursor-pointer flex flex-col items-center justify-center',
                        (index === productIcons.length - 1) ? 'col-span-2 justify-self-center lg:col-span-1 lg:justify-self-auto' : ''
                    ]"
                    @mouseenter="$emit('hover', product)"
                    @click.stop="$emit('product-click', product)"
                >
                    <img
                        :src="product.icon"
                        :alt="product.name"
                        class="white-icon w-24 h-24 md:w-32 md:h-32 lg:w-44 lg:h-44 transition-transform duration-300 object-contain"
                    />
                    <span class="text-white text-center text-base whitespace-nowrap">{{ product.name }}</span>
                </div>
            </div>
        </template>
        <!-- Show hovered product details -->
        <template v-else>
            <div class="absolute inset-0 w-full h-full flex items-center justify-center z-10">
                <img
                    :src="hoveredProduct.background || hoveredProduct.icon || hoveredProduct.image"
                    :alt="hoveredProduct.name"
                    class="w-full h-full object-cover absolute inset-0 z-0"
                    style="filter: brightness(1);"
                />
                <div class="relative z-10 flex flex-col items-center justify-center w-full">
                    <div class="relative flex flex-col items-center justify-center w-full">
                        <img
                            :src="hoveredProduct.image || hoveredProduct.icon"
                            :alt="hoveredProduct.name"
                            class="w-80 h-80 md:w-[28rem] md:h-[28rem] lg:w-[32rem] lg:h-[32rem] object-contain -mt-22"
                        />
                        <p
                            class="text-lg text-white text-center w-full max-w-none md:mt-0 md:absolute md:top-[75%] md:left-1/2 md:transform md:-translate-x-1/2"
                        >
                            <span v-html="hoveredProduct.text"></span>
                        </p>
                    </div>
                    <div>
                        <button
                        v-if="hoveredProduct.name === 'MANGO'"
                        class="font-bold text-white mt-20 w-full md:mt-22 md:w-full md:text-center lg:mt-0 lg:w-auto lg:text-left"
                        @click="$emit('show-mango-products')"
                        >
                        AVAILABLE PRODUCTS FOR MANGOES
                        </button>
                    </div>
                    <div>
                        <button
                        v-if="hoveredProduct.name === 'RICE'"
                        class="font-bold text-white mt-20 w-full md:mt-22 md:w-full md:text-center lg:mt-0 lg:w-auto lg:text-left"
                        @click="$emit('show-rice-products')"
                        >
                        AVAILABLE PRODUCTS FOR RICE
                        </button>
                    </div>
                    <div>
                        <button
                        v-if="hoveredProduct.name === 'VEGETABLES'"
                        class="font-bold text-white mt-20 w-full md:mt-22 md:w-full md:text-center lg:mt-0 lg:w-auto lg:text-left"
                        @click="$emit('show-vegetable-products')"
                        >
                        AVAILABLE PRODUCTS FOR VEGETABLES
                        </button>
                    </div>
                    <div>
                        <button
                        v-if="hoveredProduct.name === 'SUGARCANE'"
                        class="font-bold text-white mt-20 w-full md:mt-22 md:w-full md:text-center lg:mt-0 lg:w-auto lg:text-left"
                        @click="$emit('show-sugarcane-products')"
                        >
                        AVAILABLE PRODUCTS FOR SUGARCANE
                        </button>
                    </div>
                    <div>
                        <button
                        v-if="hoveredProduct.name === 'OTHER CROPS'"
                        class="font-bold text-white mt-20 w-full md:mt-22 md:w-full md:text-center lg:mt-0 lg:w-auto lg:text-left"
                        @click="$emit('show-othercrop-products')"
                        >
                        AVAILABLE PRODUCTS FOR OTHER CROPS
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </section>
</template>
<script>
export default {
    name: 'ProductsSection',
    props: ['hoveredProduct', 'productIcons'],
};
</script>
