<script setup>


import ImageIcon from "./Icons/ImageIcon.vue";
import VideoIcon from "./Icons/VideoIcon.vue";
import {Form} from "@inertiajs/vue3";

defineProps({
    profile: Object,
    label: String,
    name: String,
    placeHolder: String,
    action: String,
})
</script>

<template>
    <div class="bg-pixl-light/20 p-4 grow">

        <Form method="POST" :action="action" class="mt-4 grow" reset-on-success #default="{ errors }">
            <label :for="name" class="sr-only">{{ label }}</label>
            <div class="flex gap-2 justify-start items-center">
                <textarea cols="30" rows="5" :name="name" :id="name" class="border-none w-full resize-none"
                          :placeholder="placeHolder"></textarea>
            </div>
            <div v-if="errors.content" v-text='errors.content' class="text-red-400"></div>
            <div class="flex justify-between">
                <div class="flex gap-2 mt-2">
                    <button>
                    <ImageIcon/>
                    </button>
                    <button>
                     <VideoIcon/>
                    </button>
                </div>
                <input type="submit" class="bg-pixl border border-transparent px-4 py-0.5 text-pixl-dark" value="Post">
            </div>
        </Form>
    </div>

</template>

<style scoped>

</style>
