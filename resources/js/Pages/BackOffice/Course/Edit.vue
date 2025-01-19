<script setup lang="ts">
import BackOfficeLayout from "@/Layouts/BackOfficeLayout.vue";
import CourseForm from "@/Components/forms/CourseForm.vue";

const { craftmen, categories, course } = defineProps([
  "craftmen",
  "categories",
  "course",
]);
</script>

<template>
  <BackOfficeLayout>
    <CourseForm
      :course="course"
      :craftmen="craftmen"
      :categories="categories"
    />
  </BackOfficeLayout>
</template>
