<template>
    <div class="w-full min-h-screen flex flex-col bg-white">
        <!-- Header -->
        <div class="job-careers relative w-full">
            <div class="relative">
                <img src="/public/images/jobimg.png" alt="Career Background"
                    class="w-full h-[180px] sm:h-[220px] md:h-[280px] lg:h-[320px] xl:h-[360px] 2xl:h-[400px] object-cover object-top z-0">
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
                <!-- Breadcrumb, Title, and Quote -->
                <div class="mb-8">
                    <span
                        class="bg-gray-100 text-xs px-4 py-3 rounded-full text-[#003D1FAD] shadow-md font-semibold">VACANCY
                        / CAREERS</span>
                </div>
                <h2 class="text-2xl md:text-4xl font-bold text-center mb-8">
                    <span class="text-[#006D36]">JOIN</span> <span class="text-[#FDB913]">OUR TEAM!</span>
                </h2>
                <p class="text-based md:text-lg text-center text-gray-700 max-w-2xl px-6 mb-10 font-medium"
                    style="font-family: 'Helvetica Neue LT Std', Helvetica, Arial, sans-serif;">
                    <span class="font-bold">“</span>Believe in yourself! Have faith in your abilities! Without a
                    humble but reasonable confidence in your own powers, you cannot be successful or happy.<span
                        class="font-bold">”</span> — Norman Vincent Peale
                </p>
                <!-- Careers Cards Grid -->
                <div class="w-full max-w-6xl grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 items-stretch">
    <div v-for="job in jobs" :key="job.id"
        class="bg-[#003D1F] rounded-4xl p-4 sm:p-5 md:p-6 flex flex-col justify-between min-h-[350px] md:min-h-[400px] shadow-lg">
        <div>
            <div class="text-white text-[12px] sm:text-base mb-1">{{ job.employment_type }}</div>
            <div class="text-white text-xl sm:text-2xl md:text-2xl font-bold mb-2">{{ job.position }}</div>
            <div class="text-white text-[12px] sm:text-base mb-1">Subsidiary: {{ job.details }}</div>
            <div class="text-white text-[12px] sm:text-base">Location: {{ job.location }}</div>
            <div class="text-white text-[12px] sm:text-base font-semibold mb-1 pt-4">Job Description:</div>
            <p class="text-white text-[12px] sm:text-[13px] mb-4">
                {{ job.job_description }}
            </p>
        </div>
        <button
            class="mt-2 bg-green-700 hover:bg-green-800 text-white font-bold py-2 sm:py-2.5 md:py-3 rounded text-sm sm:text-base md:text-lg shadow-md w-full"
            @click="$emit('apply', job)">
            APPLY NOW
        </button>
    </div>
</div>

            </template>
        </div>
    </div>
</template>
<script>
import ApplicationSuccess from './ApplicationSuccess.vue';
export default {
  name: 'SeeMoreCareers',
  props: {
    jobs: {
      type: Array,
      default: () => []
    }
  },
  data() {
    return {
      jobList: [...this.jobs], // internal reactive copy
      showSuccess: false,
    };
  },
  methods: {
    setJobs(newJobs) {
      this.jobList = [...newJobs];
    },
    apply(job) {
      this.$emit('apply', job);
    }
  }
};
</script>
