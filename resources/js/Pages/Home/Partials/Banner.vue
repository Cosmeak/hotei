<script setup>
import { Button } from '@/Components/ui/button';
import { usePage } from '@inertiajs/vue3';
import { ArrowRight } from 'lucide-vue-next';
import { Link } from "@inertiajs/vue3";

const craftsmanships = usePage().props.meta.craftsmanships;
</script>

<template>
  <section class="mt-6 bg-primary text-primary-foreground py-12 relative overflow-hidden">
    <img class="absolute top-0 md:left-0 -right-10 md:right-0 rotate-90 md:rotate-0 z-0" src="/assets/home-page/banner-left.svg" alt="">
    <img class="hidden sm:block absolute bottom-0 right-0 z-0" src="/assets/home-page/banner-right.svg" alt="">
    <div class="container relative z-10">
      <h2 class="text-3xl mb-4">Découvrez nos artisanats</h2>

      <div class="flex justify-between gap-2 flex-wrap">
        <Button v-for="index in 3" :key="index" :as="Link" :href="route('craftsmanships.show', { slug: craftsmanships[index-1].id })" class="flex justify-between w-full md:w-48 bg-background text-foreground hover:bg-background/80 rounded-lg">{{ craftsmanships[index-1].name }} <ArrowRight /></Button>
      </div>
    </div>
  </section>
</template>
