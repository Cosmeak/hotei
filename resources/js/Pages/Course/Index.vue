<script setup lang="ts">
import {Head} from '@inertiajs/vue3';
import Materials from "@/Pages/Course/Partials/Materials.vue";

const props =
  defineProps<{
    name: string;
    theme: string;
    time: number;
  }>();

</script>

<template>
  <Head title="Course"/>
  <main class="bg-red-500">
    <header>
    </header>
  </main>
</template>

<style scoped>
</style>
