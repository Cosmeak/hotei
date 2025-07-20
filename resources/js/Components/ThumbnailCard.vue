<script setup lang="ts">
import {Badge} from "@/Components/ui/badge";
import {Button} from "@/Components/ui/button";
import {Link} from "@inertiajs/vue3";
import type {Course, Project} from "@/types";

defineProps<{
  type: string
  scope: Course | Project
}>()

</script>

<template>
  <div class="flex flex-col bg-white rounded-lg overflow-hidden">
    <div class="relative">
      <div class="w-full h-42 bg-gray-300">
        <img v-if="scope.thumbnail" :src="scope.thumbnail"/>
      </div>
      <Button class="absolute -bottom-4 right-2" :as="Link" :href="route('projects.show', scope.id)">
        <span v-if="scope.cost > 0">{{ scope.cost }}</span>
        <span v-else>Lire</span></Button>
    </div>
    <div class="mt-2 p-2">
      <Badge variant="accent">{{ type }}</Badge>
      <p class="text-lg">{{ scope.title }}</p>
      <p>par {{ scope.craftman.user.firstname }} {{ scope.craftman.user.lastname }}</p>
    </div>
    <div class="mt-auto p-2">
      <hr class="border-primary my-2"/>
      <div class="flex flex-row justify-between">
        <Badge variant="secondary">{{ scope.difficulty }}</Badge>
        <p>{{ scope.duration }} heures</p>
      </div>
    </div>
  </div>
</template>
