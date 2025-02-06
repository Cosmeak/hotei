<script setup lang="ts">
import { Button } from "@/Components/ui/button";

interface Craftman {
  avatar?: string;
  firstname?: string;
  lastname?: string;
  description?: string;
  url?: string;
}

const props = defineProps<{ craftman: Craftman }>();

function getFirstLetterOnly(text?: string): string {
  return text ? text.charAt(0).toUpperCase() + "." : "";
}
</script>

<template>
  <div class="bg-background_green_light bg-opacity-30 rounded-lg p-6 flex flex-col items-center text-center mb-6">
    <img :src="props.craftman.avatar" alt="Artisan picture" class="h-44 w-44 rounded-lg border object-cover" />
    <div class="w-full text-left">
      <h3 class="font-bold text-black mb-4">
        {{ props.craftman.firstname }} {{ getFirstLetterOnly(props.craftman.lastname) }}
      </h3>
    </div>
    <div>
      <p class="mb-4">{{ props.craftman.description }}</p>
    </div>
    <a :href="props.craftman.url">
      <Button class="bg-yellow_darker hover:bg-yellow_darker">
        <p class="text-black font-bold">En savoir plus</p>
      </Button>
    </a>
  </div>
</template>
