<script setup lang="ts">

interface Materials {
  id: number;
  image?: string;
  quantity?: number;
  content: string;
  url?: string;
}

const materials: Materials[] = [
  { id: 1, image: 'https://assets.bellepaga.com/3311-large_default/pelote-de-laine.jpg', quantity: 2, content: 'Material 1 description', url: 'https://example.com/' },
  { id: 2, image: 'https://assets.bellepaga.com/3311-large_default/pelote-de-laine.jpg', quantity: 5, content: 'Material 2 description', url: 'https://example.com/' },
  { id: 3, image: 'https://assets.bellepaga.com/3311-large_default/pelote-de-laine.jpg', quantity: 5, content: 'Material 2 description', url: 'https://example.com/' },
  { id: 4, image: 'https://assets.bellepaga.com/3311-large_default/pelote-de-laine.jpg', quantity: 5, content: 'Material 2 description', url: 'https://example.com/' },
  { id: 5, image: 'https://assets.bellepaga.com/3311-large_default/pelote-de-laine.jpg', quantity: 5, content: 'Material 2 description', url: 'https://example.com/' },
  { id: 6, image: 'https://assets.bellepaga.com/3311-large_default/pelote-de-laine.jpg', quantity: 5, content: 'Material 2 description', url: 'https://example.com/' }
];
</script>

<template>
  <section class="bg-green-400 bg-opacity-30 rounded-lg p-6 shadow-sm px-8 md:px-40">
    <h2 class="text-2xl font-bold leading-none tracking-tight text-primary mb-2">Matériel nécessaire pour le projet :</h2>
    <p class="text-sm text-muted-foreground mb-4">Ravitaillez-vous en équipement chez nos partenaires !</p>


    <div class="grid md:grid-cols-3 gap-4">
      <li v-for="material in materials" :key="material.id" class="flex items-center justify-between rounded-lg border bg-background p-2 shadow hover:shadow-lg transition">
        <div class="flex items-center gap-4">
          <img :src="material.image" alt="Material" class="h-10 w-10 rounded-lg border object-cover" />
          <div>
            <p class="text-sm font-medium text-foreground">{{ material.quantity }} {{ material.content }}</p>
          </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-1/12"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l370.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128z"/></svg>
      </li>
    </div>
  </section>
</template>
