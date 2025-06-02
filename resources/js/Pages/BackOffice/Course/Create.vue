<script setup lang="ts">
import CourseForm from "@/Components/forms/CourseForm.vue";

const { craftmen, craftsmanships } = defineProps([
  "craftmen",
  "craftsmanships",
]);
</script>

<template>
  <inertia-head title="Create a new course" />
  <CourseForm :craftmen="craftmen" :craftsmanships="craftsmanships" />
</template>
