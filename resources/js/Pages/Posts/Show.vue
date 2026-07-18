<script setup>

import Layout from "../../Layouts/layout.vue";
import ProfileHeader from "../Components/ProfileHeader.vue";
import Post from "../Components/Post.vue";


defineProps({
    post: Object
})
</script>

<template>
<Layout>
    <a href="" class="flex gap-2 group">
        <div class="text-pixl-light/40"><<</div>
        <span class="group-hover:underline">
back
            </span>
    </a>

    <img :src="post.profile.cover_url" alt="">

    <div class="-mt-20 flex flex-col gap-5 [&_a]:text-pixl [&_a]:hover:underline">
        <ProfileHeader :profile="post.profile" />
        <ul class="flex flex-col gap-2">
            <Post
                :post="post"
                :showEngagement="true"
                :showReplies="true"/>
<!--            <x-post :post="post" :show-replies="true" :show-engagement="true"/>-->
        </ul>
    </div>
</Layout>
</template>

<style scoped>

</style>
