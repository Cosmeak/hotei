<script setup lang="ts">
import SkillCard from "@/Components/SkillCard.vue";
import {PaginatedResponse} from "@/types/laravel";
import LaravelPagination from "@/Components/LaravelPagination.vue";
import ThumbnailCard from "@/Components/ThumbnailCard.vue";
import SearchCard from "@/Components/SearchCard.vue";
import type {Course, Craftsmanship, Difficulty, Filters, Project} from "@/types";

const {craftsmanship, projects, skills} = defineProps<{
  craftsmanship: Craftsmanship
  projects: PaginatedResponse<Project>
  skills: Course[]
  availableDifficulties: Difficulty[]
  filters: Filters
}>();

</script>

<template>
  <section class="mx-auto flex max-w-7xl flex-col gap-16 px-6 py-16 lg:px-8">
    <div class="flex flex-col lg:flex-row bg-secondary p-8 rounded-lg justify-between items-center gap-6">
      <div class="flex flex-col text-center lg:text-left">
        <h2 class="text-3xl md:text-4xl font-bold tracking-tight text-gray-900">
          {{ craftsmanship.name }}
        </h2>
        <p class="max-w-3xl text-base md:text-lg text-gray-600 py-4">
          {{ craftsmanship.description }}
        </p>
        <p class="font-bold">
          Rejoignez-nous dès maintenant et commencez à créer vos propres créations !
        </p>
      </div>
      <div class="w-full lg:w-auto flex justify-center">
        <img
          class="rounded-xl w-full max-w-md lg:max-w-[500px] h-auto"
          src="https://placeholderimage.eu/api"
          alt="Illustration"
        />
      </div>
    </div>
  </section>

  <section class="bg-muted relative overflow-hidden">
    <div class="relative max-w-7xl mx-auto flex flex-col lg:flex-row px-6 py-16 lg:px-8 justify-between items-center z-10">
      <div class="bg-secondary-lighter md:max-w-[450px] max-w-[600px] mx-4 md:mx-0 px-4 py-8 rounded-lg container">
        <h3 class="text-4xl pb-3">Découvrez {{ craftsmanship.name }} !</h3>
        <p class="text-justify">
          <b>Avec nos cours introductif offert,</b> que vous soyez débutant ou simplement curieux, ces cours vous
          permettront de vous familiariser avec les bases et <b>réaliser vos premiers projets en toute simplicité.</b>
        </p>
      </div>
      <div v-if="skills">
        <SkillCard
          v-for="skill in skills"
          :key="skill.id"
          :skill="skill"
        />
      </div>
    </div>
    <img src="/craftsmanship-bg.svg" class="absolute top-0 right-0">
  </section>

  <section class="container mx-auto">
    <h4 class="text-5xl my-8">Nos projets</h4>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
      <div class="lg:col-span-2">
        <SearchCard
          scope="Project"
          type="Project"
          :slug="craftsmanship.id"
          :initialSearch="filters.search"
          :initialDifficulties="filters.difficulties"
          :initialMinPrice="+filters.min_price"
          :initialMaxPrice="+filters.max_price"
          :availableDifficulties="availableDifficulties"
        />
      </div>

      <template v-if="projects.total > 0">
        <template v-for="project in projects.data" :key="project.id">
          <ThumbnailCard :scope="project" type="Project"/>
        </template>
      </template>

      <template v-else>
        <div class="col-span-2 flex items-center justify-center text-gray-500 italic">
          Aucun projet ne correspond à vos filtres.
        </div>
      </template>
    </div>

    <LaravelPagination
      v-if="projects.total > 0"
      :paginated-response="projects"
      class="py-8"
      :preserve-scroll="true"
    />
  </section>
</template>
