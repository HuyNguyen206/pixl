<script setup>

import {onMounted, onUnmounted, ref} from "vue";
import {router, usePage} from "@inertiajs/vue3";

let flashSuccessMessage = ref(false)

let flashErrorMessage = ref(false)

function flashSuccess(message) {
    if (!message) {
        return
    }

    flashSuccessMessage.value = message

    setTimeout(() => {
        flashSuccessMessage.value = false
    }, 5000)
}

function flashFail(message) {
    if (!message) {
        return
    }

    flashErrorMessage.value = message

    setTimeout(() => {
        flashErrorMessage.value = false
    }, 5000)
}

function showFlash() {
    flashSuccess(usePage().props.flash.success)
    flashFail(usePage().props.flash.fail)
}

// Run on initial load, then after every Inertia response, so the flash
// shows again even when the returned value is unchanged.
let stopListening

onMounted(() => {
    showFlash()
    stopListening = router.on('finish', showFlash)
})

onUnmounted(() => stopListening?.())
</script>

<template>
    <div class="fixed bottom-10 right-4 rounded">
        <div v-if="flashSuccessMessage" v-text="flashSuccessMessage" class="text-white bg-pixl py-2 px-3 duration-75 transition"></div>
        <div v-if="flashErrorMessage" v-text="flashErrorMessage" class="text-red-500 bg-white py-2 px-3 duration-75 transition"></div>
    </div>

</template>

<style scoped>

</style>
