<script setup>
import {Link} from "@inertiajs/vue3";

defineProps({
    profile: Object
})
</script>

<template>
    <!--       User profile start-->
    <div class="flex flex-wrap flex-row justify-between gap-2 items-end">
        <div class="flex gap-4 items-end mt-5">
            <img class="md:size-30 lg:40 size-20 object-cover" :src="profile.avatar_url" alt="">
            <div class="flex flex-col gap-2">
                <p>{{ profile.display_name }}</p>
                <a :href="route('profiles.show', profile)" class="text-pixl-light/40">{{ '@' + profile.handle }}</a>
            </div>
        </div>
        <a href="#" class="bg-pixl-light/10 border border-transparent px-4 py-0.5">Edit profile</a>
    </div>
    <!--       User profile end-->

    <p>{{ profile.bio }}</p>
    <div class="flex gap-6 text-sm">
        <div class="flex gap-2">
            <p>{{ profile.followings_count }}</p>
            <p class="text-pixl-light/40">Following</p>
        </div>
        <div class="flex gap-2">
            <p>{{ profile.followers_count }}</p>
            <p class="text-pixl-light/40">Followers</p>
        </div>
    </div>

    <!-- Navigation tab-->
    <ul class="flex gap-6 justify-end">
        <li>
            <Link :href="route('profiles.show', profile)" :class="route().current('profiles.show') ? 'text-pixl-light!' : 'text-pixl-light/60!'">Posts</Link>
        </li>
        <li>
            <Link :href="route('profiles.replies', profile)" :class="route().current('profiles.replies') ? 'text-pixl-light!' : 'text-pixl-light/60!'">Replies</Link>
        </li>
        <li>
            <a href="" class="text-pixl-light/60!">Highlight</a>
        </li>
        <li>
            <a href="" class="text-pixl-light/60!">Inspiration</a>
        </li>
        <li>
            <a href="" class="text-pixl-light/60!">Stream</a>
        </li>
    </ul>
    <!-- Navigation end tab-->

</template>

<style scoped>

</style>
