<script setup>
import ProfileHeader from "../Components/ProfileHeader.vue";
import Post from "../Components/Post.vue";
import Layout from "../../Layouts/layout.vue";

defineProps({
    profile: Object,
    posts: Array
})
</script>

<template>
    <Layout>
    <a :href="route('posts.index')" class="flex gap-2 group">
        <div class="text-pixl-light/40"><<</div>
        <span class="group-hover:underline">
back
            </span>
    </a>

    <img :src="profile.cover_url" alt="">
    <div class="-mt-20 flex flex-col gap-5 [&_a]:text-pixl [&_a]:hover:underline">
        <ProfileHeader :profile="profile"/>

        <ul class="flex flex-col gap-2">
            <Post :key="post.id" v-for="post in posts"
                  :show-engagement="true"
                  :show-replies="false"
                  :post="post"
            />

        </ul>
    </div>
    </Layout>
</template>

<style scoped>

</style>
