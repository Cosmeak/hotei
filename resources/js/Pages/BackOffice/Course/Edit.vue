<script setup lang="ts">
import CourseForm from "@/Components/forms/CourseForm.vue";

const { craftmen, categories, course } = defineProps([
  "craftmen",
  "categories",
  "course",
]);
</script>

<template>
  <CourseForm :course="course" :craftmen="craftmen" :categories="categories" />
</template>
