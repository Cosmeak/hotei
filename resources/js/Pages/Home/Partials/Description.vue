<script setup>
import { Card, CardContent } from '@/Components/ui/card';
</script>

<template>
 <section class="container py-12">
    <h2 class="text-3xl mb-6 lg:mb-12">Une plateforme d'e-learning adaptée à vous</h2>
    <div class="flex flex-col lg:flex-row justify-betwen gap-8 lg:gap-32">
      <div>
        <p class="mb-4">Hotei vous connecte avec une communauté d'experts artisans qui partagent leur savoir-faire. Nos artisans vous guident pas à pas dans l'apprentissage de techniques dans le domaine de votre choix.</p>
        <p>Posez vos questions, perfectionnez vos créations et développez votre passion avec un accompagnement personnalisé pour tous les niveaux.</p>
      </div>

      <div class="flex gap-4 h-fit">
        <Card class="bg-secondary-darker">
          <CardContent class="flex flex-col items-center">
            <span class="text-6xl">+50</span>
            <span>artisans</span>
          </CardContent>
        </Card>
        <Card class="bg-secondary-darker">
          <CardContent class="flex flex-col items-center">
            <span class="text-6xl">20h</span>
            <span>de contenus</span>
          </CardContent>
        </Card>
      </div>
    </div>
  </section>
</template>
