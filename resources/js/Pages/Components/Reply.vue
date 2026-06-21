<script setup>
import ReplyButton from "./ReplyButton.vue";
import LikeButton from "./LikeButton.vue";
import RepostButton from "./RepostButton.vue";
import SaveButton from "./SaveButton.vue";
import ShareButton from "./ShareButton.vue";

defineProps({
    reply: Object,
    showEngagement: {
        type: Boolean,
        default: false
    },
    showReplies: {
        type: Boolean,
        default: false
    },
})
</script>

<template>
    <li class="flex gap-2 pt-4 relative group/li">
        <div class="absolute w-px h-full bg-pixl-light/10 left-5 top-0 group-last/li:h-4"></div>
        <img class="size-10 object-cover isolate" :src="reply.profile.avatar_url">
        <div class="border-t border-pixl-light/10 grow">
            <!--Thread meta user data start-->
            <div class="flex gap-2 items-center">
                <div class="mt-4 grow text-pixl-light/50 pb-4">
                    <div class="flex gap-2 justify-between">
                        <div class="flex gap-2">
                            <a href="{{route('profiles.show', reply.profile)}}" class="hover:underline !text-pixl-light/50">{{reply.profile.display_name}}</a>
                            <a href="{{route('posts.show', [reply.profile, reply])}}" class="text-sm text-pixl-light/50 hover:text-pixl-light">{{reply.created_at}} {{"@{reply.profile.handle}"}}</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--Thread meta user data end-->

            <p class="mt-3">{{reply.content}}</p>
<!--            @if($showEngagement)-->
            <div v-if="showEngagement" class="flex justify-between">
                <!--Meta action start-->
                <div class="flex justify-between mt-4">
                    <div class="flex justify-between">
                        <div class="flex gap-6">
                            <LikeButton :post="reply"></LikeButton>
                            <ReplyButton :post="reply"></ReplyButton>
                            <RepostButton :post="reply"></RepostButton>
                        </div>
                    </div>
                </div>
                <!--Meta action end-->

                <!--Meta right action start-->
                <div class="flex justify-between">
                    <div class="flex gap-4">
                        <SaveButton :id="reply.id"></SaveButton>
                        <ShareButton :id="reply.id"></ShareButton>
                    </div>
                </div>
                <!--Meta right action end-->
            </div>

<!--            @endif-->
<!--            @if($showReplies)-->
            <ol v-if="showReplies" class="">
                <Reply
                v-for="reply in reply.replies"
                :key="reply.id"
                :reply="reply"
                :show-engagement="showEngagement"
                :show-replies="showReplies"
                />
            </ol>
<!--            @endif-->
        </div>

    </li>

</template>

<style scoped>

</style>
