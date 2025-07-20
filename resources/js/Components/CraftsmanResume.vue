<script setup lang="ts">
import { Craftman } from '@/types';
import { Link } from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button';

const { craftsman } = defineProps<{ craftsman: Craftman }>();
</script>

<template>
  <article class="bg-secondary h-full p-4 rounded-lg flex flex-col gap-2">
    <div class="w-full h-48 bg-white rounded-lg overflow-hidden">
      <img src="" alt="">
    </div>
    <p class="font-bold">{{ craftsman.user.fullname }}</p>
    <div v-html="craftsman.description" />
    <Button class="md:w-fit md:mx-auto" variant="accent" :as="Link" href="">En savoir plus</Button>
  </article>
</template>
