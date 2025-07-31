<script setup lang="ts">
import {Course} from "@/types";
import {Button} from "@/Components/ui/button";
import {Link} from "@inertiajs/vue3"
import {Badge} from "@/Components/ui/badge";

defineProps<{
  skill: Course;
}>();

</script>

<template>
  <div class="relative rounded-lg bg-white p-4 flex m-4 overflow-hidden max-w-[600px]">
    <Badge class="absolute top-2 left-2" variant="accent">
      Compétence
    </Badge>
    <div class="rounded object-cover h-full w-64 bg-gray-300">
      <img v-if="skill.thumbnail" :src="skill.thumbnail" :alt="skill.title"/>
    </div>
    <div class="flex flex-col grow justify-between">
      <div>
        <p class="text-sm font-bold mb-1">{{ skill.title }}</p>
        <p class="text-xs text-gray-600">par {{ skill.craftman?.user?.firstname || 'Auteur inconnu' }}</p>
        <hr class="my-2 border-gray-300"/>
        <p class="text-xs text-gray-600">
          {{ skill.description.length > 125 ? skill.description.substring(0, 125) + '…' : skill.description }}
        </p></div>
      <div class="flex justify-between items-end">
        <div class="text-xs flex flex-col items-start my-1 gap-1">
          <p class="bg-secondary p-1 rounded">{{ skill.difficulty }}</p>
          <p>{{ skill.duration }}h</p>
        </div>
        <Button class="text-white text-xs" :as="Link" :href="route('skills.show', { course: skill.id })">
          Lire
        </Button>
      </div>
    </div>
  </div>
</template>
