<script setup lang="ts">
const skills = [
  {
    id: 1,
    name: 'Faire une chainette',
    credits: 10,
  },
  {
    id: 2,
    name: 'Faire une chainette',
    credits: 10,
  },
];
</script>

<template>
  <section class="bg-pink-50 rounded-lg p-6 shadow-md">
    <h2 class="text-lg font-bold text-gray-800 mb-2">Compétences recommandés</h2>
    <ul class="space-y-3">
      <li
        v-for="skill in skills"
        :key="skill.id"
        class="flex items-center justify-between bg-white rounded-md border border-gray-200 p-3 shadow-sm"
      >
        <span class="text-gray-700 text-sm">{{ skill.name }}</span>
        <span class="bg-orange-600 text-white text-sm font-medium px-4 py-1 rounded-md">
          {{ skill.credits }} crédit
        </span>
      </li>
    </ul>
  </section>
</template>

<style scoped>
</style>
