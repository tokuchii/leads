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

                <!-- Filters (Modern Dropdowns) -->
                <div class="w-full max-w-6xl flex flex-col sm:flex-row sm:justify-center items-stretch sm:items-start gap-3 mb-6 px-2 sm:px-0">
                    <!-- Employment Type Dropdown -->
                    <div class="relative w-full sm:w-64" v-click-outside="closeDropdown">
                        <label class="block text-xs font-semibold text-[#003D1F] mb-2 uppercase tracking-wide">
                            Filter by Employment Type
                        </label>
                        <button type="button" @click="toggleDropdown"
                            class="w-full flex items-center justify-between bg-white border-2 border-[#003D1F]/15 hover:border-[#006D36] focus:border-[#006D36] focus:outline-none rounded-2xl px-4 py-3 shadow-sm hover:shadow-md transition-all duration-200"
                            :class="{ 'border-[#006D36] shadow-md ring-2 ring-[#006D36]/20': isDropdownOpen }">
                            <span class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full"
                                    :class="selectedType === 'Full-time' ? 'bg-[#006D36]' : 'bg-[#FDB913]'"></span>
                                <span class="text-sm font-semibold text-[#003D1F]">{{ selectedType }}</span>
                            </span>
                            <svg class="w-5 h-5 text-[#003D1F] transition-transform duration-200"
                                :class="{ 'rotate-180': isDropdownOpen }" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <transition enter-active-class="transition ease-out duration-200"
                            enter-from-class="opacity-0 -translate-y-2" enter-to-class="opacity-100 translate-y-0"
                            leave-active-class="transition ease-in duration-150"
                            leave-from-class="opacity-100 translate-y-0"
                            leave-to-class="opacity-0 -translate-y-2">
                            <div v-if="isDropdownOpen"
                                class="absolute z-30 mt-2 w-full bg-white border border-gray-100 rounded-2xl shadow-xl overflow-hidden">
                                <button v-for="option in employmentOptions" :key="option" type="button"
                                    @click="selectType(option)"
                                    class="w-full flex items-center justify-between px-4 py-3 text-left text-sm font-semibold transition-colors duration-150"
                                    :class="selectedType === option
                                        ? 'bg-[#003D1F] text-white'
                                        : 'text-[#003D1F] hover:bg-[#F4F4F4]'">
                                    <span class="flex items-center gap-2">
                                        <span class="w-2.5 h-2.5 rounded-full"
                                            :class="option === 'Full-time' ? 'bg-[#006D36]' : 'bg-[#FDB913]'"></span>
                                        {{ option }}
                                    </span>
                                    <svg v-if="selectedType === option" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </button>
                            </div>
                        </transition>
                    </div>

                    <!-- Subsidiary (Details) Dropdown -->
                    <div class="relative w-full sm:w-64" v-click-outside="closeDetailsDropdown">
                        <label class="block text-xs font-semibold text-[#003D1F] mb-2 uppercase tracking-wide">
                            Filter by Subsidiary
                        </label>
                        <button type="button" @click="toggleDetailsDropdown"
                            class="w-full flex items-center justify-between bg-white border-2 border-[#003D1F]/15 hover:border-[#006D36] focus:border-[#006D36] focus:outline-none rounded-2xl px-4 py-3 shadow-sm hover:shadow-md transition-all duration-200"
                            :class="{ 'border-[#006D36] shadow-md ring-2 ring-[#006D36]/20': isDetailsDropdownOpen }">
                            <span class="flex items-center gap-2 min-w-0">
                                <svg class="w-4 h-4 flex-shrink-0"
                                    :class="selectedDetails === 'Select Subsidiary' ? 'text-[#003D1F]/50' : 'text-[#006D36]'"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                <span class="text-sm font-semibold truncate"
                                    :class="selectedDetails === 'Select Subsidiary' ? 'text-[#003D1F]/60 italic' : 'text-[#003D1F]'">
                                    {{ selectedDetails }}
                                </span>
                            </span>
                            <svg class="w-5 h-5 text-[#003D1F] transition-transform duration-200 flex-shrink-0"
                                :class="{ 'rotate-180': isDetailsDropdownOpen }" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <transition enter-active-class="transition ease-out duration-200"
                            enter-from-class="opacity-0 -translate-y-2" enter-to-class="opacity-100 translate-y-0"
                            leave-active-class="transition ease-in duration-150"
                            leave-from-class="opacity-100 translate-y-0"
                            leave-to-class="opacity-0 -translate-y-2">
                            <div v-if="isDetailsDropdownOpen"
                                class="absolute z-30 mt-2 w-full bg-white border border-gray-100 rounded-2xl shadow-xl overflow-hidden max-h-72 overflow-y-auto">
                                <button v-for="option in detailsOptions" :key="option" type="button"
                                    @click="selectDetails(option)"
                                    class="w-full flex items-center justify-between gap-2 px-4 py-3 text-left text-sm font-semibold transition-colors duration-150"
                                    :class="selectedDetails === option
                                        ? 'bg-[#003D1F] text-white'
                                        : option === 'Select Subsidiary'
                                            ? 'text-[#003D1F]/60 italic hover:bg-[#F4F4F4]'
                                            : 'text-[#003D1F] hover:bg-[#F4F4F4]'">
                                    <span class="flex items-center gap-2 min-w-0">
                                        <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        <span class="truncate">{{ option }}</span>
                                    </span>
                                    <svg v-if="selectedDetails === option" class="w-4 h-4 flex-shrink-0" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </button>
                                <div v-if="detailsOptions.length <= 1"
                                    class="px-4 py-3 text-xs text-gray-500 italic text-center">
                                    No subsidiaries available
                                </div>
                            </div>
                        </transition>
                    </div>

                    <!-- Location Dropdown -->
                    <div class="relative w-full sm:w-64" v-click-outside="closeLocationDropdown">
                        <label class="block text-xs font-semibold text-[#003D1F] mb-2 uppercase tracking-wide">
                            Filter by Location
                        </label>
                        <button type="button" @click="toggleLocationDropdown"
                            class="w-full flex items-center justify-between bg-white border-2 border-[#003D1F]/15 hover:border-[#006D36] focus:border-[#006D36] focus:outline-none rounded-2xl px-4 py-3 shadow-sm hover:shadow-md transition-all duration-200"
                            :class="{ 'border-[#006D36] shadow-md ring-2 ring-[#006D36]/20': isLocationDropdownOpen }">
                            <span class="flex items-center gap-2 min-w-0">
                                <svg class="w-4 h-4 flex-shrink-0"
                                    :class="selectedLocation === 'Select Location' ? 'text-[#003D1F]/50' : 'text-[#006D36]'"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-sm font-semibold truncate"
                                    :class="selectedLocation === 'Select Location' ? 'text-[#003D1F]/60 italic' : 'text-[#003D1F]'">
                                    {{ selectedLocation }}
                                </span>
                            </span>
                            <svg class="w-5 h-5 text-[#003D1F] transition-transform duration-200 flex-shrink-0"
                                :class="{ 'rotate-180': isLocationDropdownOpen }" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <transition enter-active-class="transition ease-out duration-200"
                            enter-from-class="opacity-0 -translate-y-2" enter-to-class="opacity-100 translate-y-0"
                            leave-active-class="transition ease-in duration-150"
                            leave-from-class="opacity-100 translate-y-0"
                            leave-to-class="opacity-0 -translate-y-2">
                            <div v-if="isLocationDropdownOpen"
                                class="absolute z-30 mt-2 w-full bg-white border border-gray-100 rounded-2xl shadow-xl overflow-hidden max-h-72 overflow-y-auto">
                                <button v-for="option in locationFilterOptions" :key="option" type="button"
                                    @click="selectLocation(option)"
                                    class="w-full flex items-center justify-between gap-2 px-4 py-3 text-left text-sm font-semibold transition-colors duration-150"
                                    :class="selectedLocation === option
                                        ? 'bg-[#003D1F] text-white'
                                        : option === 'Select Location'
                                            ? 'text-[#003D1F]/60 italic hover:bg-[#F4F4F4]'
                                            : 'text-[#003D1F] hover:bg-[#F4F4F4]'">
                                    <span class="flex items-center gap-2 min-w-0">
                                        <svg class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span class="truncate">{{ option }}</span>
                                    </span>
                                    <svg v-if="selectedLocation === option" class="w-4 h-4 flex-shrink-0" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                </button>
                                <div v-if="locationFilterOptions.length <= 1"
                                    class="px-4 py-3 text-xs text-gray-500 italic text-center">
                                    No locations available
                                </div>
                            </div>
                        </transition>
                    </div>
                </div>

                <!-- Careers Cards Grid -->
                <div v-if="filteredJobs.length > 0"
                    class="w-full max-w-6xl grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 items-stretch">
                    <div v-for="job in filteredJobs" :key="job.id"
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
                <div v-else class="w-full max-w-6xl text-center py-12">
                    <div class="inline-flex flex-col items-center gap-3 bg-gray-50 rounded-3xl px-8 py-8 shadow-sm">
                        <svg class="w-12 h-12 text-[#003D1F]/40" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-[#003D1F] font-semibold">
                            No {{ selectedType }} positions available<template
                                v-if="selectedDetails !== 'Select Subsidiary'"> at {{ selectedDetails }}</template><template
                                v-if="selectedLocation !== 'Select Location'"> in {{ selectedLocation }}</template>
                        </p>
                        <p class="text-gray-500 text-sm">Try adjusting the filters above.</p>
                    </div>
                </div>

            </template>
        </div>
    </div>
</template>
<script>
import ApplicationSuccess from './ApplicationSuccess.vue';

const clickOutside = {
  beforeMount(el, binding) {
    el.__ClickOutsideHandler__ = (event) => {
      if (!(el === event.target || el.contains(event.target))) {
        binding.value(event);
      }
    };
    document.addEventListener('click', el.__ClickOutsideHandler__);
  },
  unmounted(el) {
    document.removeEventListener('click', el.__ClickOutsideHandler__);
  },
};

export default {
  name: 'SeeMoreCareers',
  components: { ApplicationSuccess },
  directives: { 'click-outside': clickOutside },
  props: {
    jobs: {
      type: Array,
      default: () => []
    }
  },
  data() {
    return {
      jobList: [...this.jobs],
      showSuccess: false,
      selectedType: 'Full-time',
      employmentOptions: ['Full-time', 'Part-time'],
      isDropdownOpen: false,
      selectedDetails: 'Select Subsidiary',
      isDetailsDropdownOpen: false,
      selectedLocation: 'Select Location',
      isLocationDropdownOpen: false,
    };
  },
  computed: {
    detailsOptions() {
      /** @type {Map<string, string>} */
      const byKey = new Map();
      (this.jobs || []).forEach((job) => {
        const raw = (job.details || '').toString();
        const trimmed = raw.trim();
        if (!trimmed) return;
        const key = this.normalizeDetailsKey(raw);
        if (!key) return;
        const existing = byKey.get(key);
        byKey.set(
          key,
          existing ? this.pickBetterDetailsLabel(existing, trimmed) : trimmed
        );
      });
      const unique = [...byKey.values()].sort((a, b) => a.localeCompare(b));
      return ['Select Subsidiary', ...unique];
    },
    locationFilterOptions() {
      /** @type {Map<string, string>} */
      const byKey = new Map();
      (this.jobs || []).forEach((job) => {
        const raw = (job.location || '').toString();
        const trimmed = raw.trim();
        if (!trimmed) return;
        const key = this.normalizeDetailsKey(raw);
        if (!key) return;
        const existing = byKey.get(key);
        byKey.set(
          key,
          existing ? this.pickBetterDetailsLabel(existing, trimmed) : trimmed
        );
      });
      const unique = [...byKey.values()].sort((a, b) => a.localeCompare(b));
      return ['Select Location', ...unique];
    },
    filteredJobs() {
      const target = this.normalizeType(this.selectedType);
      const details = this.selectedDetails;
      const selectedKey =
        details === 'Select Subsidiary' ? '' : this.normalizeDetailsKey(details);
      const location = this.selectedLocation;
      const selectedLocationKey =
        location === 'Select Location' ? '' : this.normalizeDetailsKey(location);
      return (this.jobs || []).filter((job) => {
        const matchType = this.normalizeType(job.employment_type) === target;
        const matchDetails =
          details === 'Select Subsidiary'
          || this.normalizeDetailsKey(job.details) === selectedKey;
        const matchLocation =
          location === 'Select Location'
          || this.normalizeDetailsKey(job.location) === selectedLocationKey;
        return matchType && matchDetails && matchLocation;
      });
    },
  },
  methods: {
    normalizeType(value) {
      if (!value) return '';
      return String(value).toLowerCase().replace(/[\s_-]+/g, '');
    },
    /**
     * Stable key so visually duplicate subsidiary names from the API
     * (extra spaces, NBSP, zero-width chars, etc.) collapse to one option.
     */
    normalizeDetailsKey(value) {
      let s = String(value ?? '')
        .normalize('NFKC')
        .replace(/[\u200B-\u200D\uFEFF]/g, '')
        .replace(/\u00A0/g, ' ')
        .replace(/\s+/g, ' ')
        .trim()
        .toLowerCase();
      return s;
    },
    pickBetterDetailsLabel(a, b) {
      const ta = (a || '').trim();
      const tb = (b || '').trim();
      if (tb.length !== ta.length) {
        return tb.length > ta.length ? tb : ta;
      }
      const endsEllipsis = (x) => /\.{3}\s*$/.test(x) || /…\s*$/.test(x);
      if (endsEllipsis(ta) && !endsEllipsis(tb)) return tb;
      if (endsEllipsis(tb) && !endsEllipsis(ta)) return ta;
      return ta;
    },
    toggleDropdown() {
      this.isDropdownOpen = !this.isDropdownOpen;
      if (this.isDropdownOpen) {
        this.isDetailsDropdownOpen = false;
        this.isLocationDropdownOpen = false;
      }
    },
    toggleDetailsDropdown() {
      this.isDetailsDropdownOpen = !this.isDetailsDropdownOpen;
      if (this.isDetailsDropdownOpen) {
        this.isDropdownOpen = false;
        this.isLocationDropdownOpen = false;
      }
    },
    toggleLocationDropdown() {
      this.isLocationDropdownOpen = !this.isLocationDropdownOpen;
      if (this.isLocationDropdownOpen) {
        this.isDropdownOpen = false;
        this.isDetailsDropdownOpen = false;
      }
    },
    selectType(option) {
      this.selectedType = option;
      this.isDropdownOpen = false;
    },
    selectDetails(option) {
      this.selectedDetails = option;
      this.isDetailsDropdownOpen = false;
    },
    selectLocation(option) {
      this.selectedLocation = option;
      this.isLocationDropdownOpen = false;
    },
    closeDropdown() {
      this.isDropdownOpen = false;
    },
    closeDetailsDropdown() {
      this.isDetailsDropdownOpen = false;
    },
    closeLocationDropdown() {
      this.isLocationDropdownOpen = false;
    },
    setJobs(newJobs) {
      this.jobList = [...newJobs];
    },
    apply(job) {
      this.$emit('apply', job);
    }
  }
};
</script>
