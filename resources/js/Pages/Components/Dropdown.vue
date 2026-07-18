<template>
    <Menu as="div" class="relative inline-block">
        <MenuButton class="inline-flex w-full text-white justify-center gap-x-1.5 rounded-md bg-gray-700 px-3 py-2 text-sm font-semibold  shadow-xs">
<!--            Options-->
                                <button class="flex gap-1 py-2 group">
                                    <span class="bg-pixl-light/50 size-1 group-hover:bg-pixl-light/70"></span>
                                    <span class="bg-pixl-light/50 size-1 group-hover:bg-pixl-light/70"></span>
                                    <span class="bg-pixl-light/50 size-1 group-hover:bg-pixl-light/70"></span>

                                </button>
        </MenuButton>

        <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform scale-100" leave-to-class="transform opacity-0 scale-95">
            <MenuItems class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-pixl-light shadow-lg">
                <div class="rounded-2xl" v-if="post.can_delete">
                    <MenuItem v-slot="{ active }">
                        <Link method="delete" :href="route('posts.destroy', [post?.profile, post])" class="text-white bg-gray-600 px-4 py-2 text-sm hover:text-gray-700 hover:bg-white">Delete</Link>
                    </MenuItem>
                </div>
                <div class="rounded-2xl">
                    <MenuItem v-slot="{ active }">
                        <Link :href="route('posts.show', [post?.profile, post])" class="text-white bg-gray-600 block px-4 py-2 text-sm hover:text-gray-700 hover:bg-white">View post</Link>
                    </MenuItem>
                </div>
            </MenuItems>
        </transition>
    </Menu>
</template>

<script setup>
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import {Link, useForm} from "@inertiajs/vue3";
// import { ChevronDownIcon } from '@heroicons/vue/20/solid'
defineProps({
    post: Object
})

const form = useForm({});

function destroy(post) {
    if (confirm("Are you sure you want to delete this post?")) {
        form.delete(route("posts.destroy", [post.profile, post]), {
            preserveScroll: true,
        });
    }
}
</script>
