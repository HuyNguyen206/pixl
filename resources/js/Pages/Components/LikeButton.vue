<script setup>

import HeartIcon from "./Icons/HeartIcon.vue";
import {Form} from "@inertiajs/vue3";

defineProps({
    post: Object,
})
</script>

<template>
    <div class="flex gap-2 items-center">
        <Form class="flex" method="POST" :action="route('posts.like-toggle', [post.profile, post])" reset-on-success #default="{ errors }">

        <button class="hover:text-pixl" :class="{ 'text-pixl': post.is_like }">
            <HeartIcon/>
        </button>
        </Form>
        <span class="text-sm">{{ post.likes_count }}</span>
    </div>

</template>

<style scoped>

</style>
