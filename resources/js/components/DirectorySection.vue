<template>
    <section class="flex justify-center items-center">
        <div class="flex justify-center items-center">
                <div class="flex flex-col justify-center items-center w-full md:w-[500px] max-w-4xl px-2 py-8">
                <button type="submit" @click.prevent="$emit('show-contact-us')" class="bg-[#015D2F] hover:bg-[#015D2F] text-[#FFF8B9] font-bold py-3 px-6 rounded-lg transition-colors cursor-pointer">CLICK HERE TO SEE THE FULL DIRECTORY</button>
            </div>
        </div>
    </section>
</template>
<script>
export default {
    name: 'DirectorySection',
};
</script>
