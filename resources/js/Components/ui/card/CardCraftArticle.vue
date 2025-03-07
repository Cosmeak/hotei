<script setup lang="ts">
defineProps<{
  image: string;
  title: string;
  author: string;
  difficulty: string;
  duration: string;
}>();
</script>

<template>
    <div class="min-w-[200px] bg-white border-2 border-[#104730] rounded-lg p-3 shadow-sm flex-shrink-0">
      <img :src="image" :alt="title" class="rounded mb-2 object-cover w-full h-24" />
      <div class="flex items-center justify-between text-xs mb-1">
        <span class="bg-[#F7DCB9] text-[#104730] px-1 py-0.5 rounded">
          Projet
        </span>
        <span class="bg-[#104730] text-white px-1 py-0.5 rounded">
          lire
        </span>
      </div>
      <p class="font-bold text-[#104730] text-sm mb-1">{{ title }}</p>
      <p class="text-xs text-gray-600 mb-1">par {{ author }}</p>
      <hr class="my-2 border-gray-300" />
      <div class="flex items-center text-xs text-gray-600 justify-between">
        <span>{{ difficulty }}</span>
        <span>{{ duration }}</span>
      </div>
    </div>
  </template>