<script setup lang="ts">
import {Course} from "@/types";
import {Button} from "@/Components/ui/button";
import {Link} from "@inertiajs/vue3"

defineProps<{
  skill: Course;
}>();

function displayDifficulty(level?: number) {
  if (level === 1) return 'Débutant';
  if (level === 2) return 'Intermédiaire';
  if (level === 3) return 'Avancé';
  return 'Niveau inconnu';
}
</script>

<template>
  <div class="relative rounded-lg bg-white p-4 flex max-w-[500px] m-4">
    <div class="absolute top-2 left-2 text-xs font-semibold px-2 py-0.5 rounded bg-accent">
      Compétence
    </div>
    <div>
      <img :src="skill.project?.description || '../assets/default/placeholder.jpg'" :alt="skill.title"
           class="rounded object-cover pr-3 max-w-[200px]"/>
    </div>
    <div class="flex flex-col grow justify-between">
      <div>
        <p class="text-sm font-bold mb-1">{{ skill.title }}</p>
        <p class="text-xs text-gray-600">par {{ skill.craftman?.user?.firstname || 'Auteur inconnu' }}</p>
        <hr class="my-2 border-gray-300"/>
        <p class="text-xs text-gray-600 mb-2">
          {{ skill.description.length > 125 ? skill.description.substring(0, 125) + '…' : skill.description }}
        </p></div>
      <div class="flex justify-between items-center">
        <div class="text-xs">
          <p class="bg-secondary p-1 rounded mb-1">{{ displayDifficulty(skill.difficulty) }}</p>
          <p>{{ skill.duration }}h</p>
        </div>
        <Button class="text-white text-xs rounded" :as="Link" :href="route('skills.show', { course: skill.id })">
          Lire
        </Button>
      </div>
    </div>
  </div>
</template>
