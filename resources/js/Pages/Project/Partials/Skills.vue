<script setup lang="ts">
import { type Course } from "@/types";

const { skills } = defineProps<{ skills: Course[] }>();
</script>

<template>
  <div class="rounded-lg p-6 px-8 md:px-40">
    <h2 class="text-2xl font-bold text-gray-800 mb-2">Ces compétences technique seront utilisées dans ce projet</h2>
    <ul class="grid md:grid-cols-4 gap-4">
      <li v-for="skill in skills" :key="skill.id" class="border shadow-xs rounded-3xl p-1 bg-green-800">
        <div class="bg-white rounded-3xl">
          <img src="https://i.ytimg.com/vi/jA5t68THJ1Q/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLCkZtEpczLs5PmSD_zKNOfKkHk4dw" alt="crochet" class="rounded-3xl">
          <div class="p-4">
            <span class="text-gray-700 text-sm bg-yellow-500 p-2 rounded-xl">Projet</span>
            <div>
              <span class="text-gray-700 text-sm">{{ skill.title }}</span>
              <span class="text-gray-700 text-sm">par {{ skill.craftman.user.firstname }} {{ skill.craftman.user.lastname }}</span>
            </div>
            <hr>
            <div>
              <span class="text-gray-700 text-sm">par {{ skill.difficulty }}</span>
              <span class="text-gray-700 text-sm">par {{ skill.duration }} minutes</span>
            </div>
          </div>
        </div>
      </li>
    </ul>
  </div>
</template>
