<script setup lang="ts">
defineProps<{
  image: string;
  name: string;
  bio: string;
}>();
</script>

<template>
    <div class="relative min-w-[250px] h-[220px] md:min-w-[300px] md:h-full rounded-lg overflow-hidden shadow-md flex-shrink-0">
      <img :src="image" :alt="name" class="object-cover w-full h-full" />
      <div class="absolute bottom-0 w-full bg-black bg-opacity-50 text-white px-4 py-3">
        <p class="font-bold">{{ name }}</p>
        <p class="text-xs">{{ bio }}</p>
      </div>
    </div>
</template>