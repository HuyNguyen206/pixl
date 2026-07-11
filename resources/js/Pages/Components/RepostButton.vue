<script setup>
import RepostIcon from "./Icons/RepostIcon.vue";
import {Form} from "@inertiajs/vue3";

defineProps({
    post: Object,
})
</script>

<template>
    <div class="flex gap-2">
        <Form method="POST" :action="route('posts.repost', [post.profile, post])" reset-on-success #default="{ errors }">
        <button class="hover:text-pixl" :class="{ 'text-pixl': post.is_repost, 'text-[#464455]': !post.is_repost }">
            <RepostIcon/>
        </button>
        </Form>
        <span class="text-sm">{{ post.reposts_count }}</span>
    </div>

</template>

