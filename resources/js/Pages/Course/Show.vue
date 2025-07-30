<script setup lang="ts">
import { Course, Project, Comment } from "@/types";
import { formatDuration } from "@/utils/time";
import { Badge } from "@/Components/ui/badge";
import { Timer } from "lucide-vue-next";
import CraftsmanResume from "@/Components/CraftsmanResume.vue";
import CommentList from "@/Components/comments/CommentList.vue";

const { course, project } = defineProps<{
  comments: Comment[];
  course: Course;
  project: Project;
  skills: Course[];
}>();
</script>

<template>
  <InertiaHead :title="course.title" />
  <div class="flex flex-col gap-4 container mx-auto my-6">
    <header class="flex flex-col md:flex-row justify-between gap-4">
      <h1 class="md:w-1/2">{{ course.title }}</h1>
      <div class="flex items-center gap-4">
        <Badge variant="secondary" class="text-base">{{ course.difficulty }}</Badge>
        <span class="flex gap-1 items-center"><Timer /> {{ formatDuration(course.duration) }}</span>
      </div>
    </header>

    <!-- Display this layout only on desktop -->
    <div class="flex gap-8 mt-8">
      <div class="w-2/3 flex flex-col gap-8">
        <div>
          <h2>Description</h2>
          <div v-html="course.description" class="mt-4" />
        </div>

        <div class="bg-gray-300 h-96 rounded-lg">
          <!-- TODO: manage video -->
        </div>
        <div v-if="course.transcription">
          <h3 class="font-bold text-2xl">Transcription</h3>
          <div class="mt-4" v-html="course.transcription" />
        </div>

        <div v-if="course.annexes">
          <h3 class="font-bold text-2xl">Annexes</h3>
          <!-- TODO: manage annexes -->
        </div>
      </div>

      <div class="w-1/3 flex flex-col gap-4">
        <CraftsmanResume :craftsman="course.craftman" />

        <!-- Materials -->
        <section
          v-if="project.materials && project.materials?.length > 0"
          class="bg-secondary"
        >
          <div class="container mx-auto py-8">
            <h3 class="text-lg font-bold">Matériel nécessaire pour le cours :</h3>
            <p>Ravitaillez-vous en équipement chez nos partenaires !</p>

            <div class="flex flex-col gap-4">
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

        <!-- Skills -->
        <section class="bg-secondary p-4 rounded-lg">
          <h3 class="text-lg font-bold">Compétences recommandées</h3>

          <div class="flex flex-col gap-4 mt-4  ">
            <template v-for="skill in skills" :key="skill.id">
              <InertiaLink
                :href="route('skills.show', { course: skill.id })"
                class="bg-white rounded-lg overflow-hidden flex justify-between"
              >
                <span class="p-2">{{ skill.title }}</span>
                <span class="bg-primary text-primary-foreground py-2 px-4 flex items-center">Lire</span>
              </InertiaLink>
            </template>
          </div>
        </section>
      </div>
    </div>
  </div>

  <CommentList :comments="comments" scope="course" :scopeId="course.id" />
</template>
