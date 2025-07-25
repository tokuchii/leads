<template>
    <div class="w-full min-h-screen flex flex-col bg-white">
        <!-- Header -->
        <div class="job-careers relative w-full">
            <div class="relative">
                <img src="/public/images/jobimg.png" alt="Career Background"
                    class="career-image w-full h-[400px] sm:h-[500px] md:h-[600px] lg:h-[700px] object-cover object-top z-0">
                <div class="absolute inset-0 bg-[#004E27] opacity-55 z-10"></div>
                <div class="absolute inset-0 flex items-center justify-center z-20">
                    <h1
                        class="text-white text-4xl sm:text-4xl md:text-4xl lg:text-6xl xl:text-6xl leading-tight text-center font-helvetica-heavy">
                        CAREERS
                    </h1>
                </div>
            </div>
        </div>
        <!-- Main Content -->
        <div class="flex-1 flex flex-col items-center justify-center py-10 px-6">
            <template v-if="showSuccess">
                <ApplicationSuccess />
            </template>
            <template v-else>
                <!-- Centered Breadcrumb -->
                <div class="mb-8 w-full flex justify-center items-center">
                    <span
                        class="bg-gray-100 text-xs px-4 py-3 rounded-full text-[#003D1FAD] shadow-md font-bold">VACANCY
                        / CAREERS</span>
                </div>
                <div class="w-full max-w-6xl flex flex-col md:flex-row gap-10 items-stretch">
                    <!-- Left: Job Details-->
                    <div
                        class="bg-[#003D1F] text-white p-6 flex flex-col w-full md:w-1/2 justify-between rounded-3xl shadow-2xl mb-8 md:mb-0 min-h">
                        <div>
                            <div class="text-based mb-2">Full time</div>
                            <div class="text-2xl font-bold mb-2">Radiologist</div>
                            <div class="text-based mb-2">Graduate of BS Radiologic Technology with PRC License</div>
                            <div class="text-based mb-4">Location: San Pedro, Laguna</div>
                            <div class="text-based font-semibold mb-1">Job Description:</div>
                            <ul class="text-xs list-disc pl-5 space-y-1">
                                <li>_______</li>
                                <li>_______</li>
                                <li>_______</li>
                                <li>_______</li>
                            </ul>
                        </div>
                    </div>
                    <!-- Right: Application Form (separate container) -->
                    <div class="p-8 flex flex-col w-full md:w-1/2 justify-center h-full">
                        <h3 class="text-2xl font-bold text-[#006D36] text-center mb-4">APPLY NOW</h3>
                        <form class="flex flex-col gap-4" @submit.prevent="submitForm">
                            <input type="text" placeholder="Your Name*"
                                v-model="name"
                                @input="capitalizeNameFirstLetter"
                                class="rounded-full bg-[#F4F4F4] placeholder:italic px-4 py-3 border border-gray-200 focus:shadow-md focus:outline-none focus:ring-0 resize-none transition-all duration-200" />
                            <input type="email" placeholder="Your Email*"
                                class="rounded-full bg-[#F4F4F4] placeholder:italic px-4 py-3 border border-gray-200 focus:shadow-md focus:outline-none focus:ring-0 resize-none transition-all duration-200" />
                            <input type="text" placeholder="Your Position*" value="Radiologist" readonly
                                class="rounded-full bg-[#F4F4F4] shadow-md placeholder:italic px-4 py-3 border border-gray-200 focus:outline-none focus:ring-0 text-black" />
                            <textarea placeholder="Enter your message" rows="4"
                                v-model="message"
                                @input="capitalizeMessageFirstLetter"
                                class="rounded-2xl bg-[#F4F4F4] placeholder:italic px-4 py-3 border border-gray-200 focus:shadow-md focus:outline-none focus:ring-0 resize-none transition-all duration-200"></textarea>
                            <div>
                                <input id="resume-upload" type="file" class="hidden" @change="handleFileChange" />
                                <label for="resume-upload"
                                    class="inline-block rounded-full bg-[#F4F4F4] px-4 py-1 mb-2 text-gray-400 italic font-medium cursor-pointer hover:shadow-md transition-all duration-200">Add
                                    File Here*</label>
                                <span v-if="selectedFileName" class="block mt-1 text-sm text-gray-700">{{
                                    selectedFileName }}</span>
                            </div>
                            <button type="submit"
                                class="mt-2 bg-green-700 hover:bg-green-800 text-white font-bold py-2 rounded-full text-lg shadow-md">SUBMIT
                                APPLICATION</button>
                        </form>
                    </div>
                </div>
            </template>
        </div>
    </div>
</template>
<script>
import ApplicationSuccess from './ApplicationSuccess.vue';
export default {
    name: 'RadiologistApplication',
    components: {
        ApplicationSuccess,
    },
    data() {
        return {
            name: '',
            message: '',
            selectedFileName: null,
            showSuccess: false,
        };
    },
    methods: {
        capitalizeNameFirstLetter() {
            // Remove non-letter and non-space characters
            this.name = this.name.replace(/[^a-zA-Z\s]/g, '');
            if (this.name.length > 0) {
                this.name = this.name.charAt(0).toUpperCase() + this.name.slice(1);
            }
        },
        capitalizeMessageFirstLetter() {
            if (this.message.length > 0) {
                this.message = this.message.charAt(0).toUpperCase() + this.message.slice(1);
            }
        },
        handleFileChange(event) {
            const file = event.target.files[0];
            if (file) {
                this.selectedFileName = file.name;
            } else {
                this.selectedFileName = null;
            }
        },
        submitForm() {
            // Here you would normally handle form validation and submission (e.g., API call)
            // For now, just show the success message
            this.showSuccess = true;
        },
    },
};
</script>
