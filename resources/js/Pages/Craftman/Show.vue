<script setup lang="ts">
import { Avatar, AvatarImage, AvatarFallback } from '@/Components/ui/avatar';
import { Craftman, Filters, Difficulty, Project, Course } from '@/types';
import { PaginatedResponse } from '@/types/laravel';
import SearchCard from '@/Components/SearchCard.vue';
import ThumbnailCard from '@/Components/ThumbnailCard.vue';
import LaravelPagination from '@/Components/LaravelPagination.vue';
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card';
import { Button } from '@/Components/ui/button';

const { craftman, filters, availableDifficulties, projects, courses } = defineProps<{ craftman: Craftman, filters: Filters, availableDifficulties: Difficulty[], projects: PaginatedResponse<Project>, courses: PaginatedResponse<Course> }>()
</script>

<template>
  <section class="container mx-auto my-12 flex flex-col lg:flex-row justify-between">
    <div class="flex flex-col md:flex-row items-center gap-8">
      <Avatar class="size-32">
        <AvatarImage :src="craftman.avatar" />
        <AvatarFallback>{{ (craftman.user.firstname.substring(0,1) + craftman.user.lastname.substring(0,1)).toUpperCase() }}</AvatarFallback>
      </Avatar>
      <div class="flex flex-col gap-4">
        <h1 class="text-center md:text-start">{{ craftman.user.firstname }} {{ craftman.user.lastname }}</h1>
        <p>{{ craftman.description }}</p>
      </div>
    </div>
    <Card class="w-full md:w-1/3 mt-8 md:mt-0" v-if="craftman.instagram || craftman.website || craftman.facebook">
      <CardHeader>
        <CardTitle>
          Suivre mon actualité
        </CardTitle>
      </CardHeader>
      <CardContent class="flex flex-col gap-2">
        <Button v-if="craftman.instagram" class="bg-white w-full text-foreground hover:text-primary-foreground" as="a" :href="craftman.instagram">
          Instagram
        </Button>
        <Button v-if="craftman.facebook" class="bg-white w-full text-foreground hover:text-primary-foreground" as="a" :href="craftman.facebook">
          Facebook
        </Button>
        <Button v-if="craftman.website" class="bg-white w-full text-foreground hover:text-primary-foreground" as="a" :href="craftman.website">
          Site Web
        </Button>
      </CardContent>
    </Card>
  </section>

  <section class="container mx-auto mb-12">
    <h2>Découvrir mes vidéos</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 my-4">
      <div class="lg:col-span-2">
        <SearchCard
          scope="Project"
          type="Project"
          :slug="craftman.id"
          :initialSearch="filters.search"
          :initialDifficulties="filters.difficulties"
          :initialMinPrice="filters.min_price"
          :initialMaxPrice="filters.max_price"
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
    <LaravelPagination :paginated-response="projects" :preserve-scroll="true" />
  </section>
</template>
