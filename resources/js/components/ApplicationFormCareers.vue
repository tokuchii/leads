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
                            <div class="text-based mb-2">{{ job.employment_type }}</div>
                            <div class="text-2xl font-bold mb-2">{{ job.position }}</div>
                            <div class="text-based mb-2">Subsidiary:  {{ job.details }}</div>
                            <div class="text-based mb-4">Location: {{ job.location }}</div>
                            <div class="text-based font-semibold mb-1 pt-4">Job Description:</div>
                            <p class="text-[13px] mb-4">
                                {{ job.job_description }}
                            </p>
                            <div class="text-based font-semibold mb-1 pt-4">Qualifications:</div>
                            <ul class="text-[13px] mb-4 list-disc pl-5 space-y-1">
                                <li v-for="(word, index) in job.qualifications.split(':')" :key="index">
                                    {{ word }}
                                </li>
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
                            <input type="text" placeholder="Your Position*" :value="job.position" readonly
                                class="rounded-full bg-[#F4F4F4] shadow-md placeholder:italic px-4 py-3 border border-gray-200 focus:outline-none focus:ring-0 text-black" />
                            <textarea placeholder="Enter your message" rows="4" v-model="message"
                                @input="capitalizeMessageFirstLetter"
                                class="rounded-2xl bg-[#F4F4F4] placeholder:italic px-4 py-3 border border-gray-200 focus:shadow-md focus:outline-none focus:ring-0 resize-none transition-all duration-200"
                                required></textarea>
                            <div>
                                <input id="resume-upload" type="file" class="hidden" @change="handleFileChange"
                                    accept=".pdf,application/pdf,.docx,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                    required />
                                <label for="resume-upload"
                                    class="inline-block rounded-full bg-[#F4F4F4] px-4 py-1 mb-2 text-gray-400 italic font-medium cursor-pointer hover:shadow-md transition-all duration-200">Add
                                    File Here*</label>
                                <span class="block text-xs text-gray-500 not-italic">(PDF or DOCX, Max 15 MB)</span>
                                <p v-if="fileError" class="text-red-500 text-xs mb-6">{{ fileError }}</p>
                                <div v-if="selectedFileName" class="flex items-center gap-2 mt-2">
                                    <span class="text-sm text-gray-700">{{ selectedFileName }}</span>
                                    <button type="button" @click="removeFile"
                                        class="text-red-500 hover:text-red-700 transition-colors duration-200"
                                        title="Remove file">
                                        <!-- Trash/Remove Icon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-6 ml-4 md:ml-8" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
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
    name: 'ApplicationFormCareers',
    components: {
        ApplicationSuccess,
    },
    props: {
        job: {
            type: Object,
            required: true
        }
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
            fileError: '',
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
            this.fileError = '';
            const MAX_SIZE_BYTES = 15 * 1024 * 1024;
            const allowedMimeTypes = [
                'application/pdf',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
            ];
            const allowedExtensions = ['pdf', 'docx'];
            if (file) {
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
                    const fileInput = document.getElementById('resume-upload');
                    if (fileInput) fileInput.value = '';
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
        async submitForm() {
            if (this.loading) return;
            this.loading = true;
            try {
                // Guard: ensure file type and size are valid
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
                    if (this.resumeFile.size > MAX_SIZE_BYTES) {
                        this.fileError = 'File exceeds the 15 MB limit. Please choose a smaller file.';
                        this.loading = false;
                        return;
                    }
                }
                const formData = new FormData();
                formData.append('full_name', this.name);
                formData.append('email', this.email);
                formData.append('position', this.job.position);
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
