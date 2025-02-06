<script setup lang="ts">
import { Button } from "@/Components/ui/button";

interface Materials {
  id: number;
  image?: string;
  quantity?: number;
  content: string;
  url?: string;
}

const props = defineProps<{ materials: Materials[] }>();
</script>

<template>
  <section class="bg-background_component rounded-lg p-6 shadow-sm">
    <h2 class="text-lg font-semibold leading-none tracking-tight text-primary mb-2">Matériel Recommandé</h2>
    <p class="text-sm text-muted-foreground mb-4">Pour cette partie du projet</p>
    <ul class="space-y-3">
      <li v-for="material in props.materials" :key="material.id" class="flex items-center justify-between rounded-lg border bg-background p-4 shadow hover:shadow-lg transition">
        <div class="flex items-center gap-4">
          <img :src="material.image" alt="Material" class="h-10 w-10 rounded-lg border object-cover" />
          <div>
            <p class="text-sm font-medium text-foreground">{{ material.quantity }} {{ material.content }}</p>
          </div>
        </div>
        <a :href="material.url">
          <Button class="bg-background_component hover:bg-background_component">
            <p class="text-black font-bold">En savoir plus</p>
          </Button>
        </a>
      </li>
    </ul>
  </section>
</template>
