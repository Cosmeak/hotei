<script setup lang="ts">
import BackOfficeLayout from "@/Layouts/BackOfficeLayout.vue";
import CourseForm from "@/Components/forms/CourseForm.vue";

const { craftmen, categories } = defineProps(["craftmen", "categories"]);
</script>

<template>
  <BackOfficeLayout>
    <CourseForm :craftmen="craftmen" :categories="categories" />
  </BackOfficeLayout>
</template>
