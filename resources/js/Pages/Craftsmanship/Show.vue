<script setup lang="ts">
import CardCraftArticle from "@/Components/ui/card/CardCraftArticle.vue";
import CardCraftSkills from "@/Components/ui/card/CardCraftSkills.vue";
import CardCraftProject from "@/Components/ui/card/CardCraftProject.vue";
import CardCraftExperts from "@/Components/ui/card/CardCraftExperts.vue";
import {Course, Craftsmanship, Project} from "@/types";
import {PaginatedResponse} from "@/types/laravel";
import LaravelPagination from "@/Components/LaravelPagination.vue";

const {craftsmanship, projects, skills} = defineProps<{
  craftsmanship: Craftsmanship,
  projects: PaginatedResponse<Project>,
  skills: Course[]
}>();

console.log(projects)
</script>

<template>

  <section class="mx-auto flex max-w-7xl flex-col gap-16 px-6 py-16 lg:px-8">
    <div class="flex flex-row bg-secondary p-8 rounded-lg justify-between items-center">
      <div class="flex flex-col">
        <h2 class="text-4xl font-bold tracking-tight text-gray-900">
          {{ craftsmanship.name }}
        </h2>
        <p class="max-w-3xl text-lg text-gray-600 py-4">
          {{ craftsmanship.description }}
        </p>
        <p class="font-bold">
          Rejoignez-nous dès maintenant et commencez à créer vos propres créations !
        </p>
      </div>
      <div>
        <img class="rounded-xl" width="500px" height="300px" src="https://placeholderimage.eu/api">
      </div>
    </div>
  </section>

  <section class="flex flex-row gap-16 rounded justify-around items-center bg-muted px-6 py-16 lg:px-8">
    <div class="bg-secondary-lighter max-w-[450px] px-4 py-8 rounded-lg">
      <h3 class="text-4xl pb-3">Découvrez le crochet !</h3>
      <p class="text-justify">
        <b>Avec nos cours introductif offert,</b> que vous soyez débutant ou simplement curieux, ces cours vous
        permettra de
        vous familiariser les bases et <b>réalisez vos premiers projets en toute simplicité.</b>
      </p>
    </div>
    <div v-if="skills">
      <CardCraftSkills
        v-for="skill in skills"
        :key="skill.id"
        :skill="skill"
      />
    </div>
  </section>

  <section>
    <LaravelPagination :paginated-response="projects" />
  </section>

</template>
