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
                            <div class="text-2xl font-bold mb-2">Accounting Staff</div>
                            <div class="text-based mb-2">Graduate of BS Accountancy; Proficient in Microsoft Office
                                applications particularly MS Word and MS Excel</div>
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
                            <input type="text" placeholder="Your Name*" v-model="name"
                                @input="capitalizeNameFirstLetter"
                                class="rounded-full bg-[#F4F4F4] placeholder:italic px-4 py-3 border border-gray-200 focus:shadow-md focus:outline-none focus:ring-0 resize-none transition-all duration-200"
                                required />
                            <input type="email" placeholder="Your Email*" v-model="email"
                                class="rounded-full bg-[#F4F4F4] placeholder:italic px-4 py-3 border border-gray-200 focus:shadow-md focus:outline-none focus:ring-0 resize-none transition-all duration-200"
                                required />
                            <input type="text" placeholder="Your Position*" value="Accounting Staff" readonly
                                class="rounded-full bg-[#F4F4F4] shadow-md placeholder:italic px-4 py-3 border border-gray-200 focus:outline-none focus:ring-0 text-black" />
                            <textarea placeholder="Enter your message" rows="4" v-model="message"
                                @input="capitalizeMessageFirstLetter"
                                class="rounded-2xl bg-[#F4F4F4] placeholder:italic px-4 py-3 border border-gray-200 focus:shadow-md focus:outline-none focus:ring-0 resize-none transition-all duration-200"
                                required ></textarea>
                            <div>
                                <input id="resume-upload" type="file" class="hidden" @change="handleFileChange" required />
                                <label for="resume-upload"
                                    class="inline-block rounded-full bg-[#F4F4F4] px-4 py-1 mb-2 text-gray-400 italic font-medium cursor-pointer hover:shadow-md transition-all duration-200">Add
                                    File Here*</label>
                                <span v-if="selectedFileName" class="block mt-1 text-sm text-gray-700">{{
                                    selectedFileName }}</span>
                            </div>
                            <button type="submit" :disabled="loading"
                                class="mt-2 bg-green-700 hover:bg-green-800 text-white font-bold py-2 rounded-full text-lg shadow-md flex items-center justify-center">
                                <span v-if="loading" class="flex items-center"><svg
                                        class="animate-spin h-5 w-5 mr-2 text-white" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24">
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
    </div>
</template>
<script>
import ApplicationSuccess from './ApplicationSuccess.vue';
export default {
    name: 'AccountingApplication',
    components: {
        ApplicationSuccess,
    },
    data() {
        return {
            name: '',
            email: '',
            message: '',
            selectedFileName: null,
            resumeFile: null,
            showSuccess: false,
            loading: false,
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
                this.resumeFile = file;
            } else {
                this.selectedFileName = null;
                this.resumeFile = null;
            }
        },
        async submitForm() {
            if (this.loading) return;
            this.loading = true;
            try {
                const formData = new FormData();
                formData.append('full_name', this.name);
                formData.append('email', this.email);
                formData.append('position', 'Accounting Staff');
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
    },
};
</script>
