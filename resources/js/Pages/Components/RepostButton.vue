<script setup>
import RepostIcon from "./Icons/RepostIcon.vue";

defineProps({
    post: Object,
})
</script>

<template>
    <div class="flex gap-2">
        <button class="hover:text-pixl" :class="{ 'text-pixl': post.is_repost, 'text-[#464455]': !post.is_repost }">
            <RepostIcon/>
        </button>
        <span class="text-sm">{{ post.reposts_count }}</span>
    </div>

</template>

