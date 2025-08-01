<script setup lang="ts">
import {Card, CardContent, CardHeader} from "@/Components/ui/card";
import ProjectForm from "@/Components/forms/ProjectForm.vue";

const {craftmen, craftsmanships} = defineProps([
  "craftmen",
  "craftsmanships",
])
</script>
<template>
  <Card class="container max-w-4xl bg-white">
    <CardHeader>
      Create a Project
    </CardHeader>
    <CardContent>
      <ProjectForm :craftmen="craftmen" :craftsmanships="craftsmanships"/>
    </CardContent>
  </Card>
</template>
