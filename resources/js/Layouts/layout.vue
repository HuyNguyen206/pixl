<script setup>

import Navigation from "../Pages/Components/Navigation.vue";
import Aside from "../Pages/Components/Aside.vue";
import Logo from "../Pages/Components/Icons/Logo.vue";
import FlashMessage from "../Pages/Components/FlashMessage.vue";
</script>

<template>
    <div class="p-2 bg-pixl-dark text-pixl-light flex xl:gap-16 gap-4 px-4 h-dvh overflow-clip justify-between">
        <header class="flex-col justify-between gap-8 w-40 shrink-0 pl-4 ml-24 lg:flex hidden">
            <div class="flex min-h-0 flex-1 flex-col gap-8">
                <a href="/" class="shrink-0">
                    <Logo/>
                </a>
                <Navigation></Navigation>
            </div>

        </header>
        <div class="h-full overflow-y-auto">
            <slot/>
        </div>

        <Aside/>
    </div>
        <footer class="mt-4">
            <p class="text-center">That all, folks</p>
            <hr class="border-b-pixl-light/10 my-4">
            <div class="h-12 inset-x-0 bg-[url(/resources/images/white-noise.gif)]"></div>
        </footer>
    <FlashMessage/>
</template>

<style scoped>

</style>
