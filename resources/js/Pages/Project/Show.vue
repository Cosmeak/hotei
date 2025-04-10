<script setup lang="ts">
import { Project } from "@/types";
import Materials from "@/Components/Materials.vue";
import ArtisanResume from "@/Components/ArtisanResume.vue";
import FollowCourse from "@/Components/FollowCourse.vue";
import Header from "@/Pages/Project/Partials/Header.vue";
import Skills from "@/Pages/Project/Partials/Skills.vue";

const { project } = defineProps<{
  project: Project;
}>();
</script>

<template>
    <InertiaHead :title="project.title" />
    <main>
      <Header :header="{ title: project.title, duration: project.duration }" />
      <div class="gap-4">
        <Materials class="md:px-40" :materials="project.materials!" />
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
