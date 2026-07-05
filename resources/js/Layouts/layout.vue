<script setup>

import Navigation from "../Pages/Components/Navigation.vue";
import Aside from "../Pages/Components/Aside.vue";
import Logo from "../Pages/Components/Icons/Logo.vue";
</script>

<template>
    <div class="p-2 bg-pixl-dark text-pixl-light flex xl:gap-16 gap-4 px-4 h-dvh overflow-clip justify-between">
        <header class="flex-col justify-between gap-8 w-40 shrink-0 pl-4 ml-24 lg:flex hidden">
            <div class="flex flex-col gap-8 justify-between ">
                <a href="/">
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


</template>

<style scoped>

</style>
