<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Materials from "@/Pages/Course/Partials/Materials.vue";
import Skills from "@/Pages/Course/Partials/Skills.vue";

const props = defineProps<{
  name: string;
  theme: string;
  time: number;
}>();
</script>

<template>
  <Head title="Course" />
  <main>
    <header>
      <h1 class="text-2xl font-bold text-white">{{ props.name }}</h1>
      <p class="text-gray-200">Theme: {{ props.theme }}</p>
      <p class="text-gray-200">Duration: {{ props.time }} minutes</p>
    </header>

    <section class="mt-6">
      <Materials />
    </section>

    <section class="mt-6">
      <Skills />
    </section>
  </main>
</template>

<style scoped>
</style>
