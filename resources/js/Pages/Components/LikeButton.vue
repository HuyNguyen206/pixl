<script setup>

import HeartIcon from "./Icons/HeartIcon.vue";

defineProps({
    post: Object,
})
</script>

<template>
    <div class="flex gap-2">
        <button class="hover:text-pixl" :class="{ 'text-pixl': post.is_like }">
            <HeartIcon/>
        </button>
        <span class="text-sm">{{ post.likes_count }}</span>
    </div>

</template>

<style scoped>

</style>
