<script setup lang="ts">
import CourseForm from "@/Components/forms/CourseForm.vue";
import { Card, CardContent } from "@/Components/ui/card";

const { craftmen, craftsmanships } = defineProps([
  "craftmen",
  "craftsmanships",
]);
</script>

<template>
  <Card class="container max-w-4xl bg-white">
    <CardContent>
      <CourseForm :craftmen="craftmen" :craftsmanships="craftsmanships" />
    </CardContent>
  </Card>
</template>
