<script setup>

import {Link} from "@inertiajs/vue3";
</script>

<template>
    <div class="flex min-h-0 flex-1 flex-col justify-between gap-8">
        <nav class="min-h-0 overflow-y-auto">
            <ol class="flex flex-col gap-4">
                <li><a class="hover:underline" :href="route('posts.index')" :class="{'text-pixl': $page.component === 'Posts/Index'}">Home</a></li>
                <li><a class="hover:underline" href="">Explorer</a></li>
                <li class="-ml-4 flex items-center gap-2">
                    <div class="bg-pixl size-2 shrink-0"></div>
                    <a class="hover:underline" href="">Notifications</a>
                </li>
                <li><a class="hover:underline" href="">Lists</a></li>
                <li><a class="hover:underline" href="">Explorer</a></li>
                <li><a class="hover:underline" href="">Explorer</a></li>
                <li><a class="hover:underline" href="">Explorer</a></li>
                <li><a class="hover:underline" href="">Explorer</a></li>
                <li><a class="hover:underline" href="">Explorer</a></li>
                <li><a class="hover:underline" href="">Explorer</a></li>
                <li><a class="hover:underline" href="">Explorer</a></li>
            </ol>
        </nav>
        <!--     Button   -->
        <div class="flex shrink-0 flex-col gap-4 pb-10" v-if="$page.props.auth.user">
    <!--        @if(!request()->routeIs('posts.index'))-->
            <Link v-show="$page.component !== 'Posts/Index'" :href="route('posts.index')"  class="text-center bg-pixl border border-transparent px-4 py-0.5 text-pixl-dark text-center pointer-fine:">Post</Link>
    <!--        @endif-->
            <div class="flex gap-4">
                <img class="size-10 object-cover isolate" :src="$page.props.auth.user.profile.avatar_url" alt="">
                <div class="flex flex-col gap-2">
                    <p>{{$page.props.auth.user.profile.display_name}}</p>
                    <p class="text-pixl-light/40">@{{$page.props.auth.user.profile.handle}}</p>
                </div>
                <button class="flex gap-2">
                    <span class="w-1 h-1 bg-pixl-light/20"></span>
                    <span class="w-1 h-1 bg-pixl-light/20"></span>
                    <span class="w-1 h-1 bg-pixl-light/20"></span>
                </button>
            </div>
        </div>
        <!--    Button end-->
    </div>
</template>

<style scoped>

</style>
