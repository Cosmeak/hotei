<script setup lang="ts">
import { PaginatedResponse } from '@/types/laravel';
import { Pagination, PaginationContent, PaginationFirst, PaginationPrevious, PaginationItem, PaginationNext, PaginationLast } from './ui/pagination';
import { Course, Craftsmanship, Project, User } from '@/types';
import { router } from '@inertiajs/vue3'
const { paginatedResponse, preserveScroll } = defineProps<{ paginatedResponse: PaginatedResponse<User|Course|Project|Craftsmanship>, preserveScroll: boolean|undefined }>();

const handleUpdate = (event: number) => {
  // the number given by event is directly the index of the page in the array
  // because the firt element in the array is the previous link and the last
  // is the next
  router.visit(paginatedResponse.links[event].url!, {
    preserveScroll: preserveScroll ?? false
  });
}
</script>

<template>
  <Pagination
    v-slot="{ page }"
    :total="paginatedResponse.total"
    :page="paginatedResponse.current_page"
    :items-per-page="paginatedResponse.per_page"
    @update:page="handleUpdate"
  >
    <PaginationContent v-slot="{ items }" class="flex items-center gap-1">
      <PaginationFirst />
      <PaginationPrevious />

      <template v-for="(item, index) in items" :key="index">
        <PaginationItem
          v-if="item.type === 'page'"
          :value="item.value"
          :is-active="item.value === page"
        >
          {{ item.value }}
        </PaginationItem>
      </template>

      <PaginationNext />
      <PaginationLast />
    </PaginationContent>
  </Pagination>
</template>
