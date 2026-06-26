<template>
    <div>
        <SeeMoreCareers v-if="showSeeMoreCareers" ref="seeMoreCareers" :jobs="allJobs"
            @close="showSeeMoreCareers = false" @apply="openApplication" />
        <ApplicationFormCareers v-else-if="showApplicationForm" :job="selectedJob"
            @close="showApplicationForm = false" />
        <template v-else>
            <!-- Upper image/overlay/CAREERS section -->
            <div class="job-careers relative w-full">
    <div class="relative">
        <!-- Responsive image -->
        <img src="/public/images/jobimg.png" alt="Career Background"
             class="w-full h-[180px] sm:h-[220px] md:h-[280px] lg:h-[320px] xl:h-[360px] 2xl:h-[400px] object-cover object-top z-0">
        <!-- Dark green overlay with 55% opacity -->
        <div class="absolute inset-0 bg-[#004E27] opacity-55 z-10"></div>
        <!-- Centered CAREERS text -->
        <div class="absolute inset-0 flex items-center justify-center z-20 px-4">
            <h1 class="text-white text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-6xl leading-tight text-center font-helvetica-heavy">
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
                            <BubbleLoader v-if="loadingJobs" />
                            <template v-else>
                                <div v-for="job in jobs" :key="job.id"
                                    class="bg-[#003D1F] rounded-4xl p-6 flex flex-col justify-between min-h-[350px] shadow-lg">
                                    <div>
                                        <div class="text-white text-xs sm:text-sm md:text-base mb-1">{{
                                            job.employment_type }}</div>
                                        <div class="text-white text-lg sm:text-xl md:text-2xl font-bold mb-2">{{
                                            job.position }}</div>
                                        <div class="text-white text-xs sm:text-sm md:text-base mb-1">Subsidiary: {{
                                            job.details }}</div>
                                        <div class="text-white text-xs sm:text-sm md:text-base">Location: {{
                                            job.location }}</div>
                                        <div class="text-white text-xs sm:text-sm md:text-base font-semibold mb-1 pt-4">
                                            Job Description:</div>
                                        <p class="text-white text-[12px] sm:text-[13px] md:text-[13px] mb-4">{{
                                            job.job_description }}</p>
                                    </div>
                                    <button
                                        class="mt-2 bg-green-700 hover:bg-green-800 text-white font-bold py-1 sm:py-2 rounded text-base sm:text-lg md:text-lg shadow-md w-full"
                                        @click="openApplication(job)">
                                        APPLY NOW
                                    </button>
                                </div>

                                <div v-if="allJobs.length > 2" class="text-center mt-4">
                                    <a href="#" @click.prevent="showAllCareers"
                                        class="text-[#006D36] hover:text-[#004E27] font-semibold text-sm sm:text-lg underline transition-colors duration-200">
                                        See More Careers
                                    </a>
                                </div>
                            </template>
                        </div>
                        <!-- Right: Application Form -->
                        <div
                            class="w-full md:w-1/2 bg-white rounded-4xl shadow-2xl p-4 sm:p-6 md:p-8 flex flex-col gap-4 min-w-[280px] max-w-lg mx-auto">
                            <h3 class="text-xl sm:text-2xl md:text-2xl font-bold text-[#006D36] text-center mb-2">JOIN
                                OUR TEAM</h3>
                            <form class="flex flex-col gap-3 flex-1" @submit.prevent="submitForm">
                                <input type="text" placeholder="Your Name*" v-model="name" @input="filterLetters"
                                    class="rounded-full bg-[#F4F4F4] placeholder:italic px-3 sm:px-4 py-2 sm:py-3 border border-gray-200 focus:shadow-md focus:outline-none focus:ring-0 resize-none transition-all duration-200 text-sm sm:text-base"
                                    required />
                                <input type="email" placeholder="Your Email*" v-model="email"
                                    class="rounded-full bg-[#F4F4F4] placeholder:italic px-3 sm:px-4 py-2 sm:py-3 border border-gray-200 focus:shadow-md focus:outline-none focus:ring-0 resize-none transition-all duration-200 text-sm sm:text-base"
                                    required />
                                <input type="text" placeholder="Your Position*" v-model="position"
                                    @input="capitalizePositionFirstLetter"
                                    class="rounded-full bg-[#F4F4F4] placeholder:italic px-3 sm:px-4 py-2 sm:py-3 border border-gray-200 focus:shadow-md focus:outline-none focus:ring-0 resize-none transition-all duration-200 text-sm sm:text-base"
                                    required />
                                <textarea placeholder="Enter your message" rows="3" v-model="message"
                                    @input="capitalizeFirstLetter"
                                    class="rounded-3xl bg-[#F4F4F4] placeholder:italic px-3 sm:px-4 py-2 sm:py-3 border border-gray-200 focus:shadow-md focus:outline-none focus:ring-0 resize-none flex-1 text-sm sm:text-base transition-all duration-200"
                                    required></textarea>
                                <div>
                                    <input id="resume-upload" type="file" class="hidden" @change="handleFileChange"
                                        accept=".pdf,application/pdf,.docx,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                        />
                                    <label for="resume-upload"
                                        class="inline-block rounded-full bg-[#F4F4F4] px-3 sm:px-4 py-1 sm:py-1.5 mb-2 text-gray-400 italic text-sm sm:text-base font-medium cursor-pointer hover:shadow-md transition-all duration-200">
                                        Add File Here*
                                    </label>

                                    <span class="block text-xs text-gray-500 not-italic">(PDF or DOCX, Max 15 MB)</span>
                                    <p v-if="fileError" class="text-red-500 text-xs mb-6">{{ fileError }}</p>
                                    <div v-if="selectedFileName" class="flex items-center gap-2 mt-2">
                                        <span class="text-sm text-gray-700">{{ selectedFileName }}</span>
                                        <button type="button" @click="removeFile"
                                            class="text-red-500 hover:text-red-700 transition-colors duration-200"
                                            title="Remove file">
                                            <!-- Trash/Remove Icon -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-6 ml-4 md:ml-8"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <button type="submit" :disabled="loading"
                                    class="mt-2 bg-green-700 hover:bg-green-800 text-white font-bold py-2 sm:py-2.5 px-4 sm:px-6 rounded-full text-sm sm:text-lg shadow-md flex items-center justify-center">
                                    <span v-if="loading" class="flex items-center">
                                        <svg class="animate-spin h-5 w-5 mr-2 text-white"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                                stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z">
                                            </path>
                                        </svg>
                                        Sending...
                                    </span>
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
import BubbleLoader from './BubbleLoader.vue';

export default {
    name: 'JobCareers',
    components: {
        SeeMoreCareers,
        ApplicationFormCareers,
        ApplicationSuccess,
        BubbleLoader,
    },
    data() {
        return {
            jobs: [],
            allJobs: [],
            selectedJob: null,
            selectedFileName: null,
            showSeeMoreCareers: false,
            showApplicationForm: false,
            showSuccess: false,
            name: '',
            email: '',
            message: '',
            position: '',
            resumeFile: null,
            loading: false,
            loadingJobs: true,
            fileError: '',
        };
    },
    mounted() {
        this.fetchJobs();
    },
    methods: {
        async fetchJobs() {
            try {
                const response = await fetch('https://admin.leadsagri.com/api/careers');
                const data = await response.json();
                // Keep full list and show only 2 random jobs
                this.allJobs = Array.isArray(data) ? data : [];
                const shuffled = [...this.allJobs].sort(() => 0.5 - Math.random());
                this.jobs = shuffled.slice(0, 2);
            } catch (error) {
                console.error('Failed to fetch jobs:', error);
            } finally {
                this.loadingJobs = false;
            }
        },
        handleFileChange(event) {
            const file = event.target.files[0];
            this.fileError = '';
            const MAX_SIZE_BYTES = 15 * 1024 * 1024;
            const allowedMimeTypes = [
                'application/pdf',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ];
            const allowedExtensions = ['pdf', 'docx'];
            if (file) {
                // Validate type by MIME and extension (fallback for some browsers)
                const fileName = file.name || '';
                const fileExt = fileName.split('.').pop().toLowerCase();
                const isAllowedType = allowedMimeTypes.includes(file.type) || allowedExtensions.includes(fileExt);
                if (!isAllowedType) {
                    this.fileError = 'Invalid file type. Only PDF or DOCX are allowed.';
                    this.selectedFileName = null;
                    this.resumeFile = null;
                    const fileInput = document.getElementById('resume-upload');
                    if (fileInput) fileInput.value = '';
                    return;
                }
                if (file.size > MAX_SIZE_BYTES) {
                    this.fileError = 'File exceeds the 15 MB limit. Please choose a smaller file.';
                    this.selectedFileName = null;
                    this.resumeFile = null;
                    // Reset the file input
                    const fileInput = document.getElementById('resume-upload');
                    if (fileInput) {
                        fileInput.value = '';
                    }
                    return;
                }
                this.selectedFileName = file.name;
                this.resumeFile = file;
            } else {
                this.selectedFileName = null;
                this.resumeFile = null;
            }
        },
        removeFile() {
            this.selectedFileName = null;
            this.resumeFile = null;
            this.fileError = '';
            // Reset the file input
            const fileInput = document.getElementById('resume-upload');
            if (fileInput) {
                fileInput.value = '';
            }
        },
        openSeeMoreCareers() {
            this.showSeeMoreCareers = true;
            this.showApplicationForm = false;
        },
        openApplicationForm() {
            this.showApplicationForm = true;
            this.showSeeMoreCareers = false;
        },
        openApplication(job) {
            this.selectedJob = job;
            this.position = job.position;
            this.showSeeMoreCareers = false;
            this.showApplicationForm = true;
        },
        async submitForm() {
            if (this.loading) return;
                if (!this.resumeFile) {
             this.fileError = 'Please upload a file before submitting.';
            return; 
             }
            this.fileError = '';
            this.loading = true;
            try {
                // Guard: ensure file size is within limit
                const MAX_SIZE_BYTES = 15 * 1024 * 1024;
                const allowedMimeTypes = [
                    'application/pdf',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
                ];
                const allowedExtensions = ['pdf', 'docx'];
                if (this.resumeFile) {
                    const fileName = this.resumeFile.name || '';
                    const fileExt = fileName.split('.').pop().toLowerCase();
                    const isAllowedType = allowedMimeTypes.includes(this.resumeFile.type) || allowedExtensions.includes(fileExt);
                    if (!isAllowedType) {
                        this.fileError = 'Invalid file type. Only PDF or DOCX are allowed.';
                        this.loading = false;
                        return;
                    }
                }
                if (this.resumeFile && this.resumeFile.size > MAX_SIZE_BYTES) {
                    this.fileError = 'File exceeds the 15 MB limit. Please choose a smaller file.';
                    this.loading = false;
                    return;
                }
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
            this.showSeeMoreCareers = true;
            this.showApplicationForm = false;
            // Pass all job data to the SeeMoreCareers component
            this.$nextTick(() => {
                this.$refs.seeMoreCareers.setJobs(this.allJobs);
            });
        }
    },
};
</script>
