<script setup>

import Layout from "@/Layouts/layout.vue";
import PostForm from "../Components/PostForm.vue";
import Post from "../Components/Post.vue";

defineProps({
    profile: Object,
    posts: Array
})
</script>
<template>
    <Layout>
            <div>
                <nav class="overflow-x-auto [scrollbar-width:none]">
                    <ul class="flex justify-end gap-4">
                        <li><a href="" class="hover:text-pixl-light text-pixl-light/50">Home</a></li>
                        <li><a href="" class="hover:text-pixl-light text-pixl-light/50">Idea streaming</a></li>
                        <li><a href="" class="hover:text-pixl-light text-pixl-light/50">Following</a></li>
                    </ul>
                </nav>
            </div>
            <div class="flex gap-2 mb-4">
                <img class="size-10 object-cover"  :src="profile.avatar_url" alt="" />
<!--                   src="$profile->avatar_url"-->
<!--                     src=""-->

                    <PostForm
                        :label="'Post Body'"
                        :name="'content'"
                        :place-holder="`What's on ${profile.handle}?`"
                        :action="route('posts.store')"
                    />
<!--                <x-post-form-->
<!--                    :label="'Post Body'"-->
<!--                    :name="'content'"-->
<!--                    :placeHolder="'What\'s on ' . $profile->handle . '?'"-->
<!--                    :action="route('posts.store')"-->
<!--                >-->


<!--                </x-post-form>-->

            </div>
            <!--Thread replies start-->
            <ol class="">
                <Post
                 v-for="post in posts"
                 :key="post.id"
                 :post="post"
                />
<!--                @forelse($posts as $post)-->
<!--                <x-post :post="$post"></x-post>-->
<!--                @empty-->
<!--                @endforelse-->
            </ol>
            <!--Thread replies end-->


    </Layout>
</template>
