<script setup lang="ts">
interface Course {
  id: number;
  name: string;
  duration: number;
  isFinish: boolean;
}

const defaultCourses: Course[] = [
  { id: 1, name: 'Cours de crochet', duration: 2, isFinish: true },
  { id: 2, name: 'Cours de tricot', duration: 3, isFinish: false }
];

const props = defineProps<{ courses?: Course[] }>();
const courses = props.courses ?? defaultCourses;

function calculateCompletionPercentage(): number {
  const totalCourses = courses.length;
  const finishedCourses = courses.filter(course => course.isFinish).length;
  return totalCourses > 0 ? (finishedCourses / totalCourses) * 100 : 0;
}
</script>

<template>
  <div class="bg-amber-100 p-4 rounded-lg">
    <h2 class="text-lg font-bold mb-4">Progression des cours</h2>
    <p class="text-sm my-2">Progression : {{ calculateCompletionPercentage().toFixed(2) }}%</p>
    <div class="w-full bg-gray-300 rounded-full h-4 overflow-hidden">
      <div class="bg-yellow-500 h-full rounded-lg" :style="{ width: `${calculateCompletionPercentage()}%` }"></div>
    </div>

    <ul class="mt-4 space-y-3">
      <li v-for="course in courses" :key="course.id" :class="course.isFinish ? 'bg-green-700 text-white' : 'bg-green-400'" class="flex items-center justify-between rounded-md border border-gray-400 p-3 shadow-sm">
        <span class="text-sm font-semibold">{{ course.name }}</span>
        <span class="text-sm">Durée : {{ course.duration }} heures</span>
        <span :class="course.isFinish ? 'text-white' : 'text-red-600'" class="text-sm font-bold">{{ course.isFinish ? 'Terminé' : 'A faire' }}</span>
      </li>
    </ul>
  </div>
</template>
