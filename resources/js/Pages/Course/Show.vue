<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Materials from "@/Components/Materials.vue";
import ArtisanResume from "@/Components/ArtisanResume.vue";
import FollowCourse from "@/Components/FollowCourse.vue";
import Header from "@/Pages/Course/Partials/Header.vue";

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
    <div class="flex px-40 gap-4">
      <section>
        <div class="min-w-[58rem]">
          <p>{{ project.description }}</p>
        </div>
      </section>
      <section>
        <Materials :materials="course.materials" />
        <div class="mt-6">
          <ArtisanResume :craftman="craftman" />
        </div>
        <FollowCourse />
      </section>
    </div>
  </main>
</template>
