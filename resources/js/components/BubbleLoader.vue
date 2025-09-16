<template>
  <div class="flex justify-center items-center py-16">
    <div class="flex space-x-2">
      <span class="w-3 h-3 bg-green-700 rounded-full animate-bounce"></span>
      <span class="w-3 h-3 bg-green-700 rounded-full animate-bounce delay-200"></span>
      <span class="w-3 h-3 bg-green-700 rounded-full animate-bounce delay-400"></span>
    </div>
  </div>
</template>

<script>
export default {
  name: 'BubbleLoader',
};
</script>

<style scoped>
@keyframes bounce {
  0%, 80%, 100% { transform: scale(0); }
  40% { transform: scale(1); }
}
.animate-bounce {
  animation: bounce 1.4s infinite ease-in-out both;
}
.delay-200 { animation-delay: 0.2s; }
.delay-400 { animation-delay: 0.4s; }
</style>
