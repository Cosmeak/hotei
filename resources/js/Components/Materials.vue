<script setup lang="ts">
import { Button } from "@/Components/ui/button";

interface Materials {
  id: number;
  image?: string;
  quantity?: number;
  content: string;
  url?: string;
}

const materials: Materials[] = [
  { id: 1, image: 'public/1234', quantity: 2, content: 'Material 1 description', url: 'https://example.com/' },
  { id: 2, image: 'public/5678', quantity: 5, content: 'Material 2 description', url: 'https://example.com/' }
];
</script>

<template>
  <section class="bg-amber-100 rounded-lg p-6 shadow-sm">
    <h2 class="text-lg font-semibold leading-none tracking-tight text-primary mb-2">Matériel Recommandé</h2>
    <p class="text-sm text-muted-foreground mb-4">Pour cette partie du projet</p>
    <ul class="space-y-3">
      <li v-for="material in materials" :key="material.id" class="flex items-center justify-between rounded-lg border bg-background p-4 shadow hover:shadow-lg transition">
        <div class="flex items-center gap-4">
          <img :src="material.image" alt="Material" class="h-10 w-10 rounded-lg border object-cover" />
          <div>
            <p class="text-sm font-medium text-foreground">{{ material.quantity }} {{ material.content }}</p>
          </div>
        </div>
        <a :href="material.url">
          <Button class="bg-yellow-400 hover:bg-yellow-500">
            <p class="text-black font-bold">En savoir plus</p>
          </Button>
        </a>
      </li>
    </ul>
  </section>
</template>
