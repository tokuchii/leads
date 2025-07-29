<template>
    <div>
        <RadiologistApplication v-if="showRadiologistApplication" @close="showRadiologistApplication = false" />
        <AccountingApplication v-else-if="showAccountingApplication" @close="showAccountingApplication = false" />
        <template v-else>
            <!-- Upper image/overlay/CAREERS section -->
            <div class="job-careers relative w-full">
                <div class="relative">
                    <!-- Responsive image height (increased) -->
                    <img src="/public/images/jobimg.png" alt="Career Background"
                        class="career-image w-full h-[400px] sm:h-[500px] md:h-[600px] lg:h-[700px] object-cover object-top z-0">
                    <!-- Dark green overlay with 55% opacity, z-10 -->
                    <div class="absolute inset-0 bg-[#004E27] opacity-55 z-10"></div>
                    <!-- Responsive centered CAREERS text, z-20 -->
                    <div class="absolute inset-0 flex items-center justify-center z-20">
                        <h1
                            class="text-white text-4xl sm:text-4xl md:text-4xl lg:text-6xl xl:text-6xl leading-tight text-center font-helvetica-heavy">
                            CAREERS
                        </h1>
                    </div>
                </div>
            </div>
            <!-- Main Content: show ApplicationSuccess if showSuccess, else show job cards and form -->
            <div class="w-full min-h-[500px] bg-white flex flex-col items-center py-16">
                <template v-if="showSuccess">
                    <ApplicationSuccess />
                </template>
                <template v-else>
                    <!-- Breadcrumb -->
                    <div class="mb-8">
                        <span
                            class="bg-gray-100 text-xs px-4 py-3 rounded-full text-[#003D1FAD] shadow-md font-semibold">VACANCY
                            / CAREERS</span>
                    </div>
                    <!-- Title -->
                    <h2 class="text-2xl md:text-4xl font-bold text-center mb-8">
                        <span class="text-[#006D36]">JOIN</span> <span class="text-[#FDB913]">OUR TEAM!</span>
                    </h2>
                    <!-- Quote -->
                    <p class="text-based md:text-lg text-center text-gray-700 max-w-2xl px-6 mb-10 font-medium"
                        style="font-family: 'Helvetica Neue LT Std', Helvetica, Arial, sans-serif;">
                        <span class="font-bold">“</span>Believe in yourself! Have faith in your abilities! Without a
                        humble but reasonable confidence in your own powers, you cannot be successful or happy.<span
                            class="font-bold">”</span> — Norman Vincent Peale
                    </p>
                    <!-- Main Content -->
                    <div
                        class="w-full max-w-6xl flex flex-col md:flex-row justify-center gap-5 items-stretch px-6 md:px-0">
                        <!-- Left: Job Cards -->
                        <div class="flex flex-col gap-6 w-full md:w-1/2">
                            <!-- Radiologist Card -->
                            <div
                                class="bg-[#003D1F] rounded-4xl p-6 flex flex-col justify-between min-h-[400px] shadow-lg">
                                <div>
                                    <div class="text-white text-based mb-1">Full time</div>
                                    <div class="text-white text-2xl font-bold mb-2">Radiologist</div>
                                    <div class="text-white text-based mb-1">Graduate of BS Radiologic Technology with
                                        PRC License</div>
                                    <div class="text-white text-based">Location: San Pedro, Laguna</div>
                                </div>
                                <button
                                    class="mt-2 bg-green-700 hover:bg-green-800 text-white font-bold py-1 rounded text-lg shadow-md w-full"
                                    @click="openRadiologistApplication">APPLY NOW</button>
                            </div>
                            <!-- Accounting Staff Card -->
                            <div
                                class="bg-[#003D1F] rounded-4xl p-6 flex flex-col justify-between min-h-[400px] shadow-lg">
                                <div>
                                    <div class="text-white text-based mb-1">Full time</div>
                                    <div class="text-white text-2xl font-bold mb-2">Accounting Staff</div>
                                    <div class="text-white text-based mb-1">Graduate of BS Accountancy; Proficient in
                                        Microsoft Office applications particularly MS Word and MS Excel</div>
                                    <div class="text-white text-based">Location: San Pedro, Laguna</div>
                                </div>
                                <button
                                    class="mt-2 bg-green-700 hover:bg-green-800 text-white font-bold py-1 rounded text-lg shadow-md w-full"
                                    @click="openAccountingApplication">APPLY NOW</button>
                            </div>
                        </div>
                        <!-- Right: Application Form -->
                        <div
                            class="w-full md:w-1/2 bg-white rounded-4xl shadow-2xl p-8 flex flex-col gap-4 min-w-[320px] max-w-lg mx-auto">
                            <h3 class="text-2xl font-bold text-[#006D36] text-center mb-2">JOIN OUR TEAM</h3>
                            <form class="flex flex-col gap-3 flex-1" @submit.prevent="submitForm">
                                <input type="text" placeholder="Your Name*" v-model="name" @input="filterLetters"
                                    class="rounded-full bg-[#F4F4F4] placeholder:italic px-4 py-3 border border-gray-200 focus:shadow-md focus:outline-none focus:ring-0 resize-none transition-all duration-200"
                                    required />
                                <input type="email" placeholder="Your Email*" v-model="email"
                                    class="rounded-full bg-[#F4F4F4] placeholder:italic px-4 py-3 border border-gray-200 focus:shadow-md focus:outline-none focus:ring-0 resize-none transition-all duration-200"
                                    required />
                                <input type="text" placeholder="Your Position*" v-model="position"
                                    @input="capitalizePositionFirstLetter"
                                    class="rounded-full bg-[#F4F4F4] placeholder:italic px-4 py-3 border border-gray-200 focus:shadow-md focus:outline-none focus:ring-0 resize-none transition-all duration-200"
                                    required />
                                <textarea placeholder="Enter your message" rows="4" v-model="message"
                                    @input="capitalizeFirstLetter"
                                    class="rounded-3xl bg-[#F4F4F4] placeholder:italic px-4 py-3 border border-gray-200 focus:shadow-md focus:outline-none focus:ring-0 resize-none flex-1 transition-all duration-200"
                                    required ></textarea>
                                <div>
                                    <input id="resume-upload" type="file" class="hidden" @change="handleFileChange" required />
                                    <label for="resume-upload"
                                        class="inline-block rounded-full bg-[#F4F4F4] px-4 py-1 mb-10 text-gray-400 italic font-medium cursor-pointer hover:shadow-md transition-all duration-200">
                                        Add File Here*
                                    </label>
                                    <span v-if="selectedFileName" class="block mt-2 text-sm text-gray-700">{{
                                        selectedFileName }}</span>
                                </div>
                                <button type="submit" :disabled="loading"
                                    class="mt-2 bg-green-700 hover:bg-green-800 text-white font-bold py-2 rounded-full text-lg shadow-md flex items-center justify-center">
                                    <span v-if="loading" class="flex items-center"><svg
                                            class="animate-spin h-5 w-5 mr-2 text-white"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z">
                                            </path>
                                        </svg>Sending...</span>
                                    <span v-else>
                                        SUBMIT APPLICATION
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>
                </template>
            </div>
        </template>
    </div>
</template>
<script>
import RadiologistApplication from './RadiologistApplication.vue';
import AccountingApplication from './AccountingApplication.vue';
import ApplicationSuccess from './ApplicationSuccess.vue';
export default {
    name: 'JobCareers',
    components: {
        RadiologistApplication,
        AccountingApplication,
        ApplicationSuccess,
    },
    data() {
        return {
            selectedFileName: null,
            showRadiologistApplication: false,
            showAccountingApplication: false,
            showSuccess: false,
            name: '',
            email: '',
            message: '',
            position: '',
            resumeFile: null,
            loading: false,
        };
    },
    methods: {
        handleFileChange(event) {
            const file = event.target.files[0];
            if (file) {
                this.selectedFileName = file.name;
                this.resumeFile = file;
            } else {
                this.selectedFileName = null;
                this.resumeFile = null;
            }
        },
        openRadiologistApplication() {
            this.showRadiologistApplication = true;
            this.showAccountingApplication = false;
        },
        openAccountingApplication() {
            this.showAccountingApplication = true;
            this.showRadiologistApplication = false;
        },
        async submitForm() {
            if (this.loading) return;
            this.loading = true;
            try {
                const formData = new FormData();
                formData.append('full_name', this.name);
                formData.append('email', this.email);
                formData.append('position', this.position);
                formData.append('message', this.message);
                if (this.resumeFile) {
                    formData.append('resume_file', this.resumeFile);
                }

                const response = await fetch('/career-application', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                const result = await response.json();

                if (response.ok) {
                    this.showSuccess = true;
                    // Reset form
                    this.name = '';
                    this.email = '';
                    this.position = '';
                    this.message = '';
                    this.selectedFileName = null;
                    this.resumeFile = null;
                } else {
                    alert('Error: ' + (result.message || 'Failed to submit application'));
                }
            } catch (error) {
                console.error('Error submitting form:', error);
                alert('Error submitting application. Please try again.');
            } finally {
                this.loading = false;
            }
        },
        filterLetters() {
            this.name = this.name.replace(/[^a-zA-Z\s]/g, '');
            if (this.name.length > 0) {
                this.name = this.name.charAt(0).toUpperCase() + this.name.slice(1);
            }
        },
        capitalizeFirstLetter() {
            if (this.message.length > 0) {
                this.message = this.message.charAt(0).toUpperCase() + this.message.slice(1);
            }
        },
        capitalizePositionFirstLetter() {
            if (this.position.length > 0) {
                this.position = this.position.charAt(0).toUpperCase() + this.position.slice(1);
            }
        },
    },
};
</script>
