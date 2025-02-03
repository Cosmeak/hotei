<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Materials from "@/Components/Materials.vue";
import Commantary from "@/Components/Commentary.vue";
import ArtisanResume from "@/Components/ArtisanResume.vue";
import FollowCourse from "@/Components/FollowCourse.vue";
import Header from "@/Pages/Project/Partials/Header.vue";
import Skills from "@/Pages/Project/Partials/Skills.vue";

interface CourseShow {
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
}

const props = defineProps<{
  course?: CourseShow;
  craftman?: Craftman;
  project?: Project;
}>();

const course = props.course ?? { description: 'Description not available', title: 'Untitled', duration: 0, materials: [] };
const craftman = props.craftman ?? { avatar: '', description: '', categories: [] };
const project = props.project ?? { title: 'Untitled Project', description: 'No description available' };
</script>

<template>
  <Head :title="course.title" />
  <main class="bg-amber-50">
    <Header :header="{ title: project.title, duration: course.duration }" />
    <div class=" gap-4">
      <Materials :materials="course.materials" />
      <Skills />
      <section class="flex justify-around px-40">
        <div class="w-3/5">
          <FollowCourse />
        </div>
        <div class="w-1/3">
          <ArtisanResume :craftman="craftman" />
        </div>
      </section>
      <Commantary />
    </div>
  </main>
</template>
