<template>
    <div>
        <SeeMoreCareers v-if="showRadiologistApplication" ref="radiologistApplication" :jobs="jobs" @close="showRadiologistApplication = false" @apply="openApplication" />
        <ApplicationFormCareers v-else-if="showAccountingApplication" :job="selectedJob" @close="showAccountingApplication = false" />
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
                            <div
                                v-for="job in jobs"
                                :key="job.id"
                                class="bg-[#003D1F] rounded-4xl p-6 flex flex-col justify-between min-h-[400px] shadow-lg"
                            >
                                <div>
                                    <div class="text-white text-based mb-1">{{ job.employment_type }}</div>
                                    <div class="text-white text-2xl font-bold mb-2">{{ job.position }}</div>
                                    <div class="text-white text-based mb-1">{{ job.details }}</div>
                                    <div class="text-white text-based">Location: {{ job.location }}</div>
                                </div>
                                <button
                                    class="mt-2 bg-green-700 hover:bg-green-800 text-white font-bold py-1 rounded text-lg shadow-md w-full"
                                    @click="openApplication(job)"
                                >
                                    APPLY NOW
                                </button>
                            </div>
                            <!-- See More Careers Link -->
                            <div v-if="jobs.length > 1" class="text-center mt-4">
                                <a href="#" @click.prevent="showAllCareers"
                                   class="text-[#006D36] hover:text-[#004E27] font-semibold text-lg underline transition-colors duration-200">
                                    See More Careers
                                </a>
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
import SeeMoreCareers from './SeeMoreCareers.vue';
import ApplicationFormCareers from './ApplicationFormCareers.vue';
import ApplicationSuccess from './ApplicationSuccess.vue';
export default {
    name: 'JobCareers',
    components: {
        SeeMoreCareers,
        ApplicationFormCareers,
        ApplicationSuccess,
    },
    data() {
        return {
            jobs: [],
            selectedJob: null,
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
    mounted() {
        this.fetchJobs();
    },
    methods: {
        async fetchJobs() {
            try {
                const response = await fetch('https://admin.leadsagri.site/api/careers');
                const data = await response.json();
                this.jobs = data;
            } catch (error) {
                console.error('Failed to fetch jobs:', error);
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
        openRadiologistApplication() {
            this.showRadiologistApplication = true;
            this.showAccountingApplication = false;
        },
        openAccountingApplication() {
            this.showAccountingApplication = true;
            this.showRadiologistApplication = false;
        },
        openApplication(job) {
            this.selectedJob = job;
            this.position = job.position;
            this.showRadiologistApplication = false;
            this.showAccountingApplication = true;
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
        showAllCareers() {
            this.showRadiologistApplication = true;
            this.showAccountingApplication = false;
            // Pass all job data to the RadiologistApplication component
            this.$nextTick(() => {
                this.$refs.radiologistApplication.setJobs(this.jobs);
            });
        }
    },
};
</script>
