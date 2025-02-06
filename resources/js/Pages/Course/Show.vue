<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
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
const project = props.project ?? { description: 'No description available' };
</script>

<template>
  <Head :title="course.title" />
  <main class="bg-background">
    <Header :header="{ title: course.title, duration: course.duration }" />
    <div class="flex px-40 gap-4">
      <section>
        <h3 class="mb-2 font-bold text-2xl">Description</h3>
        <div class="min-w-[58rem]">
          <div class="relative pt-[56.25%] mb-2">
            <iframe class="absolute top-0 left-0 w-full h-full" src="https://www.youtube.com/embed/JwPptEwX4DE?si=Ij5BnJWQDAITB0Di" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
          </div>
          <p>{{ project.description }}</p>
        </div>
      </section>
      <section>
        <Materials :materials="course.materials" />
        <div class="mt-6">
          <ArtisanResume :artisan="craftman" />
        </div>
        <FollowCourse />
      </section>
    </div>
  </main>
</template>
