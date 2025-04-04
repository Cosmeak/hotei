<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import Materials from "@/Components/Materials.vue";
import ArtisanResume from "@/Components/ArtisanResume.vue";
import FollowCourse from "@/Components/FollowCourse.vue";
import Header from "@/Pages/Course/Partials/Header.vue";
import { Course, Project } from "@/types";

const { course, project } = defineProps<{
  course: Course;
  project: Project;
}>();
</script>

<template>
  <Head :title="course.title" />
  <main class="bg-background">
    <Header :header="{ title: course.title, duration: course.duration }" />
    <div class="flex x-40 gap-4">
      <section>
        <h3 class="mb-2 font-bold text-2xl">Description</h3>
        <div class="min-w-[58rem]">
          <p>{{ project.description }}</p>
        </div>
      </section>
      <section>
        <Materials :materials="course.materials!" />
        <div class="mt-6">
          <ArtisanResume :craftman="course.craftman" />
        </div>
        <FollowCourse />
      </section>
    </div>
  </main>
</template>
