<script setup lang="ts">

import ProjectForm from "@/Components/forms/ProjectForm.vue";
import {Card, CardContent} from "@/Components/ui/card";

const {craftmen, project} = defineProps([
  "project",
  "craftmen",
]);
</script>

<template>
  <Card class="container max-w-4xl bg-white">
    <CardContent>
      <ProjectForm :project="project" :craftmen="craftmen"/>
    </CardContent>
  </Card>
</template>
