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
  <div class="relative flex flex-col md:flex-row bg-white rounded-lg p-4 m-4 overflow-hidden max-w-full md:max-w-[600px] shadow">
    <Badge class="absolute top-2 left-2" variant="accent">
      Compétence
    </Badge>

    <div class="w-full md:w-64 h-48 md:h-auto flex-shrink-0 mb-4 md:mb-0 md:mr-4 rounded bg-gray-300 overflow-hidden">
      <img
        v-if="skill.thumbnail"
        :src="skill.thumbnail"
        :alt="skill.title"
        class="w-full h-full object-cover"
      />
    </div>

    <!-- Content -->
    <div class="flex flex-col justify-between grow">
      <div>
        <p class="text-sm font-bold mb-1">{{ skill.title }}</p>
        <p class="text-xs text-gray-600">par {{ skill.craftman?.user?.firstname || 'Auteur inconnu' }}</p>
        <hr class="my-2 border-gray-300" />
        <p class="text-xs text-gray-600">
          {{ skill.description.length > 125 ? skill.description.substring(0, 125) + '…' : skill.description }}
        </p>
      </div>

      <!-- Bottom -->
      <div class="flex justify-between items-end mt-4">
        <div class="text-xs flex flex-col items-start gap-1">
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

