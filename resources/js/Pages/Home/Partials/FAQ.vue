<script setup lang="ts">
import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from '@/Components/ui/accordion';

const faq = [
  {
    question: "Comment contacter un artisan pour une question spécifique ?",
    answer:`
      Chaque cours dispose d'une <b>section commentaires</b> où vous pouvez poser vos questions. <br>
      Nos artisans y répondent <b>au plus vite</b> pour vous accompagner dans votre progression. <br>
      Vous pouvez également participer aux sessions de <b>questions-réponses organisées régulièrement lors des webinaires</b>.
    `,
  },
  {
    question: "Les webinaires sont-ils inclus dans l'abonnement ?",
    answer:`
      Les webinaires ne sont pas inclus directement dans l’abonnement. En revanche, votre abonnement vous donne accès à des craftout, notre système de crédits. Ces craftout peuvent être utilisés pour débloquer l’accès aux webinaires de votre choix.
    `,
  },
  {
    question: "Puis-je télécharger les cours pour les visionner hors ligne ?",
    answer:`
      Non, le téléchargement des cours n’est pas disponible. Les contenus sont accessibles uniquement en ligne, via la plateforme.
    `,
  },
  {
    question: "Combien coûte un cours de crochet ?",
    answer:`
      Chaque cours de crochet est accessible pour seulement 150 craftout. Vous pouvez obtenir ces craftout grâce à nos packs à l’unité ou via l’un de nos abonnements, qui vous offrent des crédits chaque mois pour progresser à votre rythme. Apprenez quand vous voulez, selon vos envies !
    `,
  },
];
</script>

<template>
  <section class="bg-muted text-muted-foreground p-6 md:p-12">
    <h2 class="text-3xl mb-6 lg:mb-12 text-center">Vous avez des questions ?</h2>
      <Accordion type="single" collapsible class="container">
        <AccordionItem v-for="(element, i) in faq" :key="i" :value="`item-${i}`">
          <AccordionTrigger class="text-xl">{{ element.question }}</AccordionTrigger>
          <AccordionContent class="text-base">
            <p v-html="element.answer" />
          </AccordionContent>
        </AccordionItem>
      </Accordion>
  </section>
</template>
