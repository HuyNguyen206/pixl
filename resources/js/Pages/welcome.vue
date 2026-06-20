<script setup>
import Layout from "../Layouts/layout.vue";

defineProps({
    greeting: ''
})
</script>
<template>
    <Layout>
        {{greeting}}
    </Layout>
</template>
