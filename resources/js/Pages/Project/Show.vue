<script setup lang="ts">
import { Course, Material, Project } from "@/types";
import { Badge } from "@/Components/ui/badge";
import { Timer } from "lucide-vue-next";
import { formatDuration } from "@/utils/time";
import { Button } from "@/Components/ui/button";
import { Link } from "@inertiajs/vue3";
import ThumbnailCard from "@/Components/ThumbnailCard.vue";

const { project } = defineProps<{
  courses: Course[],
  materials: Material[],
  percentageCompleted: number,
  project: Project;
  skills: Course[],
}>();
</script>

<template>
  <InertiaHead :title="project.title" />
  <div class="flex flex-col gap-4 container mx-auto mt-6">
    <header class="flex flex-col md:flex-row justify-between gap-4">
      <h1 class="md:w-1/2">{{ project.title }}</h1>
      <div class="flex items-center gap-4">
        <Badge variant="secondary" class="text-base">{{ project.difficulty }}</Badge>
        <span class="flex gap-1 items-center"><Timer /> {{ formatDuration(project.duration) }}</span>
      </div>
    </header>

    <main class="flex flex-col-reverse md:flex-row justify-between object-center my-6">
      <div class="md:w-1/2 py-4 text-lg" v-html="project.description" />

      <!-- this image can be not set by the craftman, so the placeholder is used in this case. -->
      <div class="rounded-lg overflow-hidden">
        <img
          v-if="project.thumbnail"
          :src="project.thumbnail"
        />
        <div
          v-else
          class="bg-gray-300 w-140 h-80"
        />
      </div>
    </main>
  </div>

  <!-- Needed materials banner -->
  <section
    v-if="project.materials && project.materials?.length > 0"
    class="bg-secondary"
  >
    <div class="container mx-auto py-8">
      <h2>Matériel nécessaire pour le projet :</h2>
      <p>Ravitaillez-vous en équipement chez nos partenaires !</p>

      <div class="grid grid-cols-3 justify-between">
        <div
          v-for="(material, index) in project.materials"
          :key="index"
          class="bg-white p-2 rounded-lg"
        >
          <p>{{ material.quantity }}x {{ material.name }}</p>
        </div>
      </div>
    </div>
  </section>

  <section
    v-if="skills.length > 0"
    class="container mx-auto my-8"
  >
    <h2>Ces compétences techniques seront utilisées dans ce projet</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-8 mt-4">
      <template
        v-for="skill in skills"
        :key="skill.id"
      >
        <ThumbnailCard type="Compétence" :scope="skill" />
      </template>
    </div>
  </section>

  <div class="container mx-auto mb-8 flex flex-col md:flex-row justify-between gap-8">
    <!-- Courses -->
    <section class="md:w-2/3 bg-muted p-8 rounded-lg">
      <div class="flex flex-col md:flex-row gap-4 md:justify-between md:items-center">
        <h2>Maintenant à votre tour !</h2>
        <Button variant="accent" disabled>Continuer le cours</Button>
      </div>
      <!-- Completion -->
      <!-- TODO: complete percentage -->
      <div class="my-8 flex gap-4 items-center">
        <div class="flex rounded-full bg-white overflow-x-hidden w-full h-3">
          <div class="bg-secondary-darker" :style="`width: ${percentageCompleted}%;`" />
        </div>
        <p>{{ percentageCompleted }}%</p>
      </div>
      <!-- Courses list -->
      <div class="flex flex-col gap-4">
        <div
          v-for="course in courses"
          :key="course.id"
          class="rounded-lg py-2 px-4"
          :class="{ 'bg-primary': course.is_completed, 'bg-white': !course.is_completed }"
        >
          <p>Etape {{ course.pivot.position }} : {{ course.title }}</p>
          <p class="text-sm mt-2">{{ formatDuration(course.duration) }}</p>
        </div>
      </div>
    </section>

    <!-- Craftman -->
    <article class="bg-secondary md:w-1/3 h-full p-4 rounded-lg flex flex-col gap-4">
      <div class="w-full h-48 bg-white rounded-lg overflow-hidden">
        <img src="" alt="">
      </div>
      <p class="font-bold">{{ project.craftman.user.firstname }} {{ project.craftman.user.lastname }}</p>
      <div v-html="project.craftman.description" />
      <Button class="md:w-fit md:mx-auto" variant="accent" :as="Link" href="">En savoir plus</Button>
    </article>
  </div>
</template>
