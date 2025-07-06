<template>
  <div class="w-full min-h-screen flex flex-col bg-white">
    <!-- Main Content -->
    <div class="flex-1 flex flex-col items-center justify-center py-1 px-6">
      <!-- Centered Breadcrumb -->
      <div class="mb-8 w-full flex justify-center items-center">
        <span class="bg-gray-100 text-xs px-4 py-3 rounded-full text-[#003D1FAD] shadow-md font-bold">VACANCY / CAREERS</span>
      </div>
      <div class="w-full max-w-5xl rounded-3xl flex flex-col items-center py-12 px-4 md:px-12">
        <h2 class="text-2xl md:text-5xl font-bold text-center mb-2 text-[#006D36]">THANK YOU</h2>
        <h3 class="text-2xl md:text-4xl font-bold text-center mb-6 text-[#FDB913]">FOR SUBMITTING YOUR APPLICATION!</h3>
        <p class="text-based text-gray-700 text-center mb-8 max-w-4xl">
          The Leads Agri team will get in touch through your provided contact details should your application go through our initial assessment. In the meantime, feel free to go through our website to get to know more about our Company. You may also like and follow our official social media channels:
        </p>
        <div class="flex flex-row flex-nowrap justify-center items-center gap-0 mb-8">
          <span class="inline-block">
            <a href="https://www.facebook.com/leadsagri" target="_blank" rel="noopener" class="text-[#006D36] text-3xl hover:text-[#FDB913] transition-colors align-middle">
              <i class="fab fa-facebook"></i>
            </a>
          </span>
          <svg width="40" height="1" class="mx-3" style="display:inline-block;vertical-align:middle;"><rect width="40" height="4" fill="#008643"/></svg>
          <span class="inline-block">
            <a href="https://www.youtube.com/@LEADSTV1" target="_blank" rel="noopener" class="text-[#006D36] text-3xl hover:text-[#FDB913] transition-colors align-middle">
              <i class="fab fa-youtube"></i>
            </a>
          </span>
          <svg width="40" height="1" class="mx-3" style="display:inline-block;vertical-align:middle;"><rect width="40" height="4" fill="#008643"/></svg>
          <span class="inline-block">
            <a href="https://www.tiktok.com/@leadsagri.ph" target="_blank" rel="noopener" class="text-[#006D36] text-3xl hover:text-[#FDB913] transition-colors align-middle">
              <i class="fab fa-tiktok"></i>
            </a>
          </span>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'ApplicationSuccess',
};
</script> 