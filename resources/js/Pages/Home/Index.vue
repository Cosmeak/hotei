<script setup>
import FAQ from './Partials/FAQ.vue';
import Pricing from './Partials/Pricing.vue';
import Description from './Partials/Description.vue';
import Craftmen from './Partials/Craftmen.vue';
import Banner from './Partials/Banner.vue';
import Hero from './Partials/Hero.vue';

const props = defineProps([
  "craftmen"
]);
</script>

<template>
  <Hero />
  <Banner />
  <Description />
  <Pricing />
  <Craftmen :craftmen="props.craftmen" />
  <FAQ />
</template>
