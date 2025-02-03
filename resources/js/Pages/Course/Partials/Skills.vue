<script setup lang="ts">

const skills = [
  { id: 1, title: "noeud"},
  { id: 2, title: "test"},
  { id: 3, title: "aiguille"}
];

</script>

<template>
  <div class="bg-amber-100 rounded-lg p-6">
    <h2 class="text-lg font-bold text-gray-800 mb-2">Compétences recommandées</h2>
    <ul class="space-y-3">
      <li v-for="skill in skills" :key="skill.id" class="flex items-center justify-between bg-white rounded-md border p-3 shadow-sm">
        <span class="text-gray-700 text-sm">{{ skill.title }}</span>
        <span class="bg-orange-600 text-white text-sm font-medium px-4 py-1 rounded-md">{{ skill.credits }} crédit</span>
      </li>
    </ul>
  </div>
</template>
