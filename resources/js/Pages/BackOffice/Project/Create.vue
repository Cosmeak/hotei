<script setup lang="ts">
import {Card, CardContent} from "@/Components/ui/card";
import ProjectForm from "@/Components/forms/ProjectForm.vue";

const { craftmen, crafmanships } = defineProps([
  "craftmen",
  "crafmanships",
])
</script>
<template>
  <Card class="container max-w-4xl bg-white">
    <CardContent>
      <ProjectForm :craftmen="craftmen" :craftsmanships="crafmanships" />
    </CardContent>
  </Card>
</template>
