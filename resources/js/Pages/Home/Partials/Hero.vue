<script setup>
import { Button } from '@/Components/ui/button';
import { usePage } from '@inertiajs/vue3';
import { ref, computed, onMounted, onBeforeUnmount } from "vue";
import { motion } from "motion-v";

const craftsmanships = usePage().props.meta.craftsmanships;

// Variable réactive pour l'indice du mot actuellement affiché
const currentIndex = ref(0);
// Variable réactive pour déclencher la transition d'animation
const animating = ref(false);

// Calcul automatique du mot suivant (bouclage avec modulo)
const nextIndex = computed(() => (currentIndex.value + 1) % craftsmanships.length);

let intervalId = null;

onMounted(() => {
  intervalId = setInterval(() => {
    animating.value = true;
    // Laisser le temps à l'animation de s'exécuter (1.2s)
    setTimeout(() => {
      currentIndex.value = nextIndex.value;
      animating.value = false;
    }, 1200);
  }, 3000);
});

onBeforeUnmount(() => {
  clearInterval(intervalId);
});

// Positions prédéfinies pour assurer la cohérence de la transition
const topPosition = -60;       // Position haute (mot entrant)
const centerPosition = 0;     // Position centrale (affichage)
const bottomPosition = 60;     // Position basse (mot sortant)
const rightOffset = 0;        // Décalage horizontal initial (pour le mot entrant);

// Fonction qui retourne les propriétés d'animation en fonction de l'indice
function getAnimationProps(index) {
  // Pour le mot actif
  if (index === currentIndex.value) {
    return {
      initial: { top: `${centerPosition}px`, x: "0px", opacity: 1 },
      animate: animating.value
        ? { top: `${bottomPosition}px`, x: "0px", opacity: 0 }
        : { top: `${centerPosition}px`, x: "0px", opacity: 1 },
    };
  }
  // Pour le mot suivant
  if (index === nextIndex.value) {
    return {
      initial: { top: `${topPosition}px`, x: `${rightOffset}px`, opacity: 0.2 },
      animate: animating.value
        ? { top: `${centerPosition}px`, x: "0px", opacity: 1 }
        : { top: `${topPosition}px`, x: `${rightOffset}px`, opacity: 0.5 },
    };
  }
  // Pour les autres éléments, on les cache
  return {
    initial: { top: `${topPosition}px`, x: `${rightOffset}px`, opacity: 0 },
    animate: { top: `${topPosition}px`, x: `${rightOffset}px`, opacity: 0 },
  };
}
</script>

<template>
  <img src="/assets/home-page/hero.svg" class="hidden md:block absolute top-0 left-0 -z-10" alt="">
  <section class="container flex flex-col md:flex-row gap-12 justify-between items-center my-6 md:my-24 relative w-full overflow-x-hidden">
      <div>
          <h1 class="text-5xl relative">Apprenez à maîtriser :
            <span class="relative block h-[60px] overflow-hidden mt-2 md:mt-0">
              <motion.span
                v-for="(craftsmanship, index) in craftsmanships"
                :key="index"
                :initial="getAnimationProps(index).initial"
                :animate="getAnimationProps(index).animate"
                :transition="{ duration: 1.2, ease: 'easeInOut' }"
                class="absolute font-bold text-transparent bg-clip-text underline underline-offset-10 decoration-primary bg-gradient-to-r from-primary to-primary/80 text-center"
              >
                {{ craftsmanship.name.toLowerCase() }}
              </motion.span>
            </span>
          </h1>
          <p class="md:w-2/3 my-4 text-xl">Grâce à des cours en ligne réaliser par des artisans professionnels.</p>
          <Button variant="accent" class="font-bold text-lg">Je m'abonne</Button>
      </div>

      <div>
          <img src="/assets/craftmanships/poterie.svg" alt="">
          <!-- <img v-for="craftmanship in craftmanships" :key="craftmanship.id" :src="`/assets/craftmanships/${craftmanship.name.toLowerCase()}.svg`" alt=""> -->
      </div>
  </section>
</template>
