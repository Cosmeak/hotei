<script setup lang="ts">
import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from '@/components/ui/accordion';

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
      Chaque cours dispose d'une <b>section commentaires</b> où vous pouvez poser vos questions. <br>
      Nos artisans y répondent <b>au plus vite</b> pour vous accompagner dans votre progression. <br>
      Vous pouvez également participer aux sessions de <b>questions-réponses organisées régulièrement lors des webinaires</b>.
    `,
  },
  {
    question: "Puis-je télécharger les cours pour les visionner hors ligne ?",
    answer:`
      Chaque cours dispose d'une <b>section commentaires</b> où vous pouvez poser vos questions. <br>
      Nos artisans y répondent <b>au plus vite</b> pour vous accompagner dans votre progression. <br>
      Vous pouvez également participer aux sessions de <b>questions-réponses organisées régulièrement lors des webinaires</b>.
    `,
  },
  {
    question: "Combien coûte un cours de crochet ?",
    answer:`
      Chaque cours dispose d'une <b>section commentaires</b> où vous pouvez poser vos questions. <br>
      Nos artisans y répondent <b>au plus vite</b> pour vous accompagner dans votre progression. <br>
      Vous pouvez également participer aux sessions de <b>questions-réponses organisées régulièrement lors des webinaires</b>.
    `,
  },
];
</script>

<template>
  <section class="bg-muted text-muted-foreground p-12">
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
