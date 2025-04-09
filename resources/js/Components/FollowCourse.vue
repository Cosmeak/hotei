<script setup lang="ts">
interface Course {
  id: number;
  name: string;
  duration: number;
  isFinish: boolean;
}

const { courses } = defineProps<{ courses?: Course[] }>();

function calculateCompletionPercentage(): number {
  const totalCourses = courses?.length;
  const finishedCourses = courses?.filter(course => course.isFinish).length;
  return totalCourses && finishedCourses && totalCourses > 0 ? (finishedCourses / totalCourses) * 100 : 0;
}
</script>

<template>
  <div class="bg-background_component p-4 rounded-lg">
    <h2 class="text-lg font-bold mb-4">Progression des cours</h2>
    <p class="text-sm my-2">Progression : {{ calculateCompletionPercentage().toFixed(2) }}%</p>
    <div class="w-full bg-gray-300 rounded-full h-4 overflow-hidden">
      <div class="bg-yellow_darker h-full rounded-lg" :style="{ width: `${calculateCompletionPercentage()}%` }"></div>
    </div>

    <ul class="mt-4 space-y-3">
      <li v-for="course in courses" :key="course.id" :class="course.isFinish ? 'bg-background_green_darker' : 'bg-background_green_light'" class="flex items-center justify-between rounded-md border border-gray-400 p-3 shadow-xs">
        <span class="text-sm font-semibold">{{ course.name }}</span>
        <span class="text-sm">Durée : {{ course.duration }} heures</span>
        <span :class="course.isFinish ? 'text-white' : 'text-red-600'" class="text-sm font-bold">{{ course.isFinish ? 'Terminé' : 'A faire' }}</span>
      </li>
    </ul>
  </div>
</template>
