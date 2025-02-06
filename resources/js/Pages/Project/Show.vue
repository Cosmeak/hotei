<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Materials from "@/Components/Materials.vue";
import ArtisanResume from "@/Components/ArtisanResume.vue";
import FollowCourse from "@/Components/FollowCourse.vue";
import Header from "@/Pages/Project/Partials/Header.vue";
import Skills from "@/Pages/Project/Partials/Skills.vue";

interface Course {
  description: string;
  title: string;
  duration: number;
  materials: string[];
}

interface Craftman {
  avatar: string;
  description: string;
  categories: string[];
}

interface Project {
  title: string;
  description: string;
  courses: Course[];
  craftman: Craftman;
}

const { project } = defineProps<{
  project?: Project;
}>();

console.log(project)
console.log(project.craftman)
</script>

<template>
  <Head :title="project.title" />
  <main>
    <Header :header="{ title: project.title, duration: project.duration }" />
    <div class="gap-4">
      <Materials class="md:px-40" />
      <Skills />
      <section class="md:flex justify-around px-4 md:px-40">
        <div class="md:w-3/5">
          <FollowCourse />
        </div>
        <div class="md:w-1/3">
          <ArtisanResume :craftman="project.craftman" />
        </div>
      </section>
      <!--<Commantary />-->
    </div>
  </main>
</template>
