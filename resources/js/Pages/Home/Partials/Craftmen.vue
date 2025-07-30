<script setup>
import { Card, CardContent } from '@/Components/ui/card';
import { Button } from '@/Components/ui/button';

const props = defineProps([
  "craftmen"
]);
</script>

<template>
  <section class="container mb-12">
    <h2 class="text-3xl mb-6">Découvrez les artisans qui vont tous vous apprendre</h2>

    <div class="flex flex-col md:flex-row gap-6">
      <div v-for="craftman in props.craftmen" :key="craftman.id" class="relative md:max-w-74 flex-1 rounded-xl overflow-hidden">
        <img class="h-72 min-h-72 bg-gray-200 w-full object-cover" :src="craftman.avatar" alt="">
        <div class="absolute bg-accent-lighter/50 bottom-0 left-0 right-0 p-2 h-1/4 ">
          <p class="text-accent-foreground text-lg font-bold">{{ craftman.user.fullname }}</p>
          <p class="truncate">{{ craftman.description }}</p>
        </div>
      </div>

      <Card class="md:w-2/5">
        <CardContent class="flex flex-col gap-6">
          <p>Découvrez notre communauté d'artisans passionnés, experts dans leur domaine qui  partagent avec vous leur <b>savoir-faire</b> unique, leurs <b>astuces</b> et <b>techniques personnelles</b>.</p>
          <p>Enrichissez votre expérience en <b>participant à nos webinaires</b> où vous pourrez <b>échanger directement avec eux</b> et perfectionner vos compétences créatives.</p>
          <Button variant="accent" class="w-fit mx-auto" disabled>S'inscrire à un webinaires</Button>
        </CardContent>
      </Card>
    </div>
  </section>
</template>
