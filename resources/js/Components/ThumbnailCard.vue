<script setup lang="ts">
import { Badge } from "@/Components/ui/badge";
import { Button } from "@/Components/ui/button";
import { Link } from "@inertiajs/vue3";
import type { Course } from "@/types";

defineProps<{
  course: Course
}>()

function displayDifficulty(level?: number) {
  if (level === 1) return 'Débutant';
  if (level === 2) return 'Intermédiaire';
  if (level === 3) return 'Avancé';
  return 'Niveau inconnu';
}

</script>

<template>
  <div class="flex flex-col max-w-[250px] bg-white rounded-lg">
    <div class="relative">
      <img :src="course.imageSrc || '../assets/default/placeholder.jpg'" class="rounded-t-lg" alt="Course image" />
      <Button class="absolute -bottom-4 right-2" variant="secondary" :as="Link" :href="route('projects.show', course.id)">
        Lire
      </Button>
    </div>
    <div class="mt-2 p-2">
      <Badge class="bg-accent text-black">{{ course.category }}</Badge>
      <p class="text-xl">{{ course.title }}</p>
      <p>par {{ course.craftman.user.firstname }}</p>
      <hr class="bg-primary my-2" />
      <div class="flex flex-row justify-between">
        <Badge class="bg-secondary-lighter text-black">{{ displayDifficulty() ?? 'Facile' }}</Badge>
        <p>{{ course.duration }} heures</p>
      </div>
    </div>
  </div>
</template>
