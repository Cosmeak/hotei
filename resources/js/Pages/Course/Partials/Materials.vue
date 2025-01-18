<script setup lang="ts">
const materials = [
  {
    id: 1,
    image: '/path-to-image.jpg',
    description: '1 pelote pour crochet 5mm',
  },
  {
    id: 2,
    image: '/path-to-image.jpg',
    description: '1 pelote pour crochet 5mm',
  },
  {
    id: 3,
    image: '/path-to-image.jpg',
    description: '1 pelote pour crochet 5mm',
  },
];
</script>

<template>
  <section class="bg-pink-50 rounded-lg p-6 shadow-md">
    <h2 class="text-lg font-bold text-gray-800 mb-2">Matériel nécessaire</h2>
    <p class="text-sm text-gray-600 mb-4">Pour cette partie du projet</p>
    <ul class="space-y-3">
      <li
        v-for="material in materials"
        :key="material.id"
        class="flex items-center justify-between bg-white rounded-md shadow-sm p-4 hover:shadow-md transition"
      >
        <div class="flex items-center space-x-3">
          <img
            :src="material.image"
            alt="Material"
            class="h-10 w-10 rounded-md object-cover"
          />
          <span class="text-gray-700 text-sm">{{ material.description }}</span>
        </div>
        <button
          class="text-gray-400 hover:text-gray-700 transition"
          aria-label="Details"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-5 w-5"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M9 5l7 7-7 7"
            />
          </svg>
        </button>
      </li>
    </ul>
  </section>
</template>

<style scoped>
</style>
