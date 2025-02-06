<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import Materials from "@/Components/Materials.vue";
import ArtisanResume from "@/Components/ArtisanResume.vue";
import FollowCourse from "@/Components/FollowCourse.vue";
import Header from "@/Pages/Course/Partials/Header.vue";

interface Material {
  id: number;
  image?: string;
  quantity?: number;
  content: string;
  url?: string;
}

interface CourseShow {
  description: string;
  title: string;
  duration: number;
  materials: Material[];
  craftman: Craftman;
}

interface Craftman {
  avatar: string;
  description: string;
  categories: string[];
}

interface Project {
  title: string;
  description: string;
}

const { course, project } = defineProps<{
  course?: CourseShow;
  project?: Project;
}>();

</script>

<template>
  <Head :title="course.title" />
  <main class="bg-background">
    <Header :header="{ title: course.title, duration: course.duration }" />
    <div class="flex px-40 gap-4">
      <section>
        <h3 class="mb-2 font-bold text-2xl">Description</h3>
        <div class="min-w-[58rem]">
          <p>{{ project.description }}</p>
        </div>
      </section>
      <section>
        <Materials :materials="course.materials" />
        <div class="mt-6">
          <ArtisanResume :craftman="course.craftman" />
        </div>
        <FollowCourse />
      </section>
    </div>
  </main>
</template>
