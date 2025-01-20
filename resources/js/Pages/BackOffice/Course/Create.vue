<script setup lang="ts">
import BackOfficeLayout from "@/Layouts/BackOfficeLayout.vue";
import CourseForm from "@/Components/forms/CourseForm.vue";

const { craftmen, craftsmanships } = defineProps([
  "craftmen",
  "craftsmanships",
]);
</script>

<template>
  <BackOfficeLayout>
    <CourseForm :craftmen="craftmen" :craftsmanships="craftsmanships" />
  </BackOfficeLayout>
</template>
