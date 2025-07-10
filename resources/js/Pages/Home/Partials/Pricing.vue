<script setup>
import { ref } from 'vue';
import { Button } from '@/Components/ui/button';

const subscriptionsChoice = ref('subscriptions');
const billingCategories = {
  subscriptions: [
    {
      price: '30€ / mois',
      description: "200 + 10 craftout bonus"
    },
    {
      price: '60€ / mois',
      description: "400 + 25 craftout bonus"
    },
    {
      price: '90€ / mois',
      description: "600 + 40 craftout bonus"
    }
  ],
  packs: [
    {
      price: '10€',
      description: "50 craftout"
    },
    {
      price: '20€',
      description: "100 + 5 craftout bonus"
    },
    {
      price: '50€',
      description: "250 + 10 craftout bonus"
    },
    {
      price: '100€',
      description: "500 + 20 craftout bonus"
    },
    {
      price: '200€',
      description: "1000 + 50 craftout bonus"
    },
  ],
};
</script>

<template>
  <section class="container">
    <h2 class="text-3xl mb-6 lg:mb-12">Vous souhaitez acheter des cours ?</h2>
    <p class="mb-4">Alimentez votre passion créative en <b>rechargeant votre porte-monnaie de Craftout</b> qui vous donnent accès à tous nos cours.</p>
    <p class="mb-4">Optez pour un <b>abonnement mensuel</b> pour un approvisionnement régulier ou choisissez un <b>pack unique</b> selon vos besoins. </p>
    <a href="/assets/infographie-hotei-acces-produits-services.pdf" target="_blank" class="text-primary underline">
      Découvrir ce que vous pouvez acheter avec vos Craftout
    </a>

    <div class="md:ms-4 bg-secondary-lighter rounded-xl py-4 md:px-42 my-16 flex flex-col md:flex-row justify-center items-center gap-6 md:gap-16 relative">
      <div class="bg-secondary-darker rounded-lg p-3 h-fit md:absolute md:-left-6 -mt-8 md:mt-0 w-4/5 mx-auto md:w-fit flex flex-col gap-2 top-6">

        <div class="flex items-center space-x-2">
          <input type="radio" name="subscription-choice" id="subscriptions" v-model="subscriptionsChoice" value="subscriptions" class="peer hidden" />
          <label for="subscriptions" class="flex items-center gap-2 py-1 px-2 rounded-lg cursor-pointer peer-checked:bg-secondary w-full relative">
            <span class="absolute -translate-y-1/2 top-1/2" v-if="subscriptionsChoice === 'subscriptions'">✓</span>
            <span class="w-4 h-4 rounded-full bg-white"></span>
            <span>Abonnement</span>
          </label>
        </div>

        <div class="flex items-center space-x-2">
          <input type="radio" name="subscription-choice" id="packs" v-model="subscriptionsChoice" value="packs" class="peer hidden" />
          <label for="packs" class="flex items-center gap-2 py-1 px-2 rounded-lg cursor-pointer peer-checked:bg-secondary w-full relative" >
            <span class="absolute -translate-y-1/2 top-1/2" v-if="subscriptionsChoice === 'packs'">✓</span>
            <span class="w-4 h-4 rounded-full bg-white"></span>
            <span>Packs</span>
          </label>
        </div>

      </div>

      <div class="flex flex-col flex-wrap gap-6 md:gap-12 items-center w-full">
        <div class="flex justify-center flex-col md:flex-row flex-wrap gap-6 md:-m-8 w-full px-4 md:px-0">
          <div class="bg-accent-lighter py-4 px-8 rounded-xl text-center w-full md:flex-1/4"  v-for="(element, i) in billingCategories[subscriptionsChoice]" :key="i">
            <p class="text-3xl"><b>{{ element.price }}</b></p>
            <p>{{ element.description}}</p>
          </div>
        </div>
        <Button variant="accent" class="flex-none" disabled>Je m'abonne</Button>
      </div>
    </div>
  </section>
</template>
