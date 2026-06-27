<script setup>
import Reply from "./Reply.vue";
import ReplyButton from "./ReplyButton.vue";
import RepostButton from "./RepostButton.vue";
import SaveButton from "./SaveButton.vue";
import ShareButton from "./ShareButton.vue";
import LikeButton from "./LikeButton.vue";

defineProps({
    post: Object,
    showEngagement: {
        type: Boolean,
        default: true
    },
    showReplies: {
        type: Boolean,
        default: true
    },
})
</script>

<template>
    <li class="border-t border-t-pixl-light/10 pt-4">
        <div class="flex gap-2">
<!--            <img class="size-10 object-cover" src="{{$post->profile->avatar_url}}" alt="">-->
            <img class="size-10 object-cover" :src="post.profile.avatar_url" alt="">
            <div class="mt-4 grow text-pixl-light/50 pb-4">
                <div class="flex gap-2 justify-between">
                    <div class="flex gap-2">
<!--                        <a href="{{route('profiles.show', $post->profile)}}" class="hover:underline !text-pixl-light/50">{{$post->profile->display_name}}</a>-->
<!--                        <a href="{{route('posts.show', [$post->profile, $post])}}" class="text-sm text-pixl-light/50 hover:text-pixl-light">{{$post->created_at->diffForHumans()}} {{"@{$post->profile->handle}"}}</a>-->

                        <a :href="route('profiles.show', post.profile)" class="hover:underline !text-pixl-light/50">{{ post.profile.display_name }}</a>
                        <a :href="route('posts.show', [post.profile, post])" class="text-sm text-pixl-light/50 hover:text-pixl-light">{{ post.created_at }} "@{{ post.profile.handle }}"</a>
                    </div>
                    <button class="flex gap-1 py-2 group">
                        <span class="bg-pixl-light/50 size-1 group-hover:bg-pixl-light/70"></span>
                        <span class="bg-pixl-light/50 size-1 group-hover:bg-pixl-light/70"></span>
                        <span class="bg-pixl-light/50 size-1 group-hover:bg-pixl-light/70"></span>

                    </button>
                </div>
                <p class="mt-3 [&_a]:text-pixl [&_a]:hover:underline">
<!--                    {{$post->content}}-->
<!--                    @if($post->parentRepost)-->
                    <blockquote v-if="post.parentRepost" class="p-4 my-4 border-s-4 border-default bg-neutral-secondary-soft">
<!--                        <p class="text-xl italic font-medium leading-relaxed text-heading">-->
                        <div class="text-xl italic font-medium leading-relaxed text-heading">
                            <Post
                                :post="post.parentRepost"
                                :show-engagement="false"
                            />
<!--                            <p/>-->
                        </div>
                    </blockquote>
<!--                    @endif-->

                </p>
<!--                @if($showEngagement)-->
                <div v-if="showEngagement" class="flex justify-between mt-4 pb-4">

                    <!--Meta left action start-->
                    <div class="flex justify-between">
                        <div class="flex gap-6">
                            <LikeButton :post="post"></LikeButton>
                            <ReplyButton :post="post"></ReplyButton>
                            <RepostButton :post="post"></RepostButton>
                        </div>
                    </div>
                    <!--Meta left action end-->


                    <!--Meta right action start-->
                    <div class="flex justify-between">
                        <div class="flex gap-4">
                            <SaveButton :id="post.id"></SaveButton>
                            <ShareButton :id="post.id"></ShareButton>
                        </div>
                    </div>
                    <!--Meta right action end-->
                </div>
<!--                @endif-->
                <x-reply-form post="$post"></x-reply-form>
<!--                @if($showReplies)-->
                <ol class="" v-if="showReplies">
                    <Reply
                    v-for="reply in post.replies"
                    :key="reply.id"
                    :reply="reply"
                    show-engagement="showEngagement"
                    show-replies="showReplies"
                    />
                </ol>
<!--                @endif-->

            </div>
        </div>
    </li>

</template>

<style scoped>

</style>
