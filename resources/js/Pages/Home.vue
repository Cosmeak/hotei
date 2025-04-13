<script setup>
import { Button } from '@/Components/ui/button';
import { usePage } from '@inertiajs/vue3';
import { ArrowRight } from 'lucide-vue-next';
import { RadioGroup, RadioGroupItem } from '@/Components/ui/radio-group'
import { Label } from '@/Components/ui/label';
import { Card, CardContent } from '@/Components/ui/card';

const craftmanships = usePage().props.meta.craftsmanships;
const props = defineProps([
  "craftmen"
]);
console.log(props.craftmen);

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

let subscriptionsChoice = 'subscriptions';
</script>

<template>
    <section class="container flex flex-col md:flex-row gap-12 justify-between items-center my-6 md:my-24">
        <div>
            <h1 class="text-5xl">Apprenez à maîtriser <span class="underline underline-offset-14 decoration-primary">la poterie</span></h1>
            <p class="md:w-1/2 my-4 text-xl">Grâce à des cours en ligne réaliser par des artisans professionnels.</p>
            <Button variant="accent" class="font-bold text-lg">Je m'abonne</Button>
        </div>

        <div>
            <img src="/assets/craftmanships/poterie.svg" alt="">
            <!-- <img v-for="craftmanship in craftmanships" :key="craftmanship.id" :src="`/assets/craftmanships/${craftmanship.name.toLowerCase()}.svg`" alt=""> -->
        </div>
    </section>

    <section class="mt-6 bg-primary text-primary-foreground py-12">
        <div class="container">
            <h2 class="text-3xl mb-4">Découvrez nos artisanats</h2>

            <div class="flex justify-between gap-2 flex-wrap">

                <Button v-for="craftmanship in craftmanships" :key="craftmanship.id" class="flex justify-between w-full md:w-48 bg-background text-foreground hover:bg-background/80 rounded-lg">{{ craftmanship.name }} <ArrowRight /></Button>
            </div>
        </div>
    </section>

    <section class="container py-12">
        <h2 class="text-3xl mb-6 lg:mb-12">Une plateforme d'e-learning adaptée à vous</h2>
        <div class="flex flex-col lg:flex-row justify-betwen gap-8 lg:gap-32">
            <div>
                <p class="mb-4">Hotei vous connecte avec une communauté d'experts artisans qui partagent leur savoir-faire. Nos artisans vous guident pas à pas dans l'apprentissage de techniques dans le domaine de votre choix.</p>
                <p>Posez vos questions, perfectionnez vos créations et développez votre passion avec un accompagnement personnalisé pour tous les niveaux.</p>
            </div>

            <div class="flex gap-4 h-fit">
                <Card>
                  <CardContent class="flex flex-col items-center">
                    <span class="text-6xl">+50</span>
                    <span>artisans</span>
                  </CardContent>
                </Card>
                <Card>
                  <CardContent class="flex flex-col items-center">
                    <span class="text-6xl">20h</span>
                    <span>de contenus</span>
                  </CardContent>
                </Card>
            </div>
        </div>
    </section>

    <section class="container">
        <h2 class="text-3xl mb-6 lg:mb-12">Vous souhaitez acheter des cours ?</h2>
        <p class="mb-4">Alimentez votre passion créative en <b>rechargeant votre porte-monnaie de Craftout</b> qui vous donnent accès à tous nos cours.</p>
        <p class="mb-4">Optez pour un <b>abonnement mensuel</b> pour un approvisionnement régulier ou choisissez un <b>pack unique</b> selon vos besoins. </p>
        <InertiaLink class="text-primary underline">
            Découvrir ce que vous pouvez acheter avec vos Craftout
        </InertiaLink>

        <div class="md:ms-4 bg-secondary-lighter rounded-xl p-4 my-16 flex flex-col md:flex-row justify-center items-center gap-6 md:gap-16 relative">
            <div class="bg-secondary-darker rounded-lg p-3 h-fit md:absolute md:-left-6 -mt-8 md:mt-0 w-full md:w-fit">
                <RadioGroup v-model="subscriptionsChoice">
                    <div class="flex items-center space-x-2">
                        <RadioGroupItem id="subscriptions" value="subscriptions" />
                        <Label for="subscriptions">Abonnement</Label>
                    </div>
                    <div class="flex items-center space-x-2">
                        <RadioGroupItem id="packs" value="packs" />
                        <Label for="packs">Packs</Label>
                    </div>
                </RadioGroup>
            </div>

            <div class="flex flex-col flex-wrap gap-6 md:gap-12 items-center">
                <div class="flex justify-center flex-col md:flex-row flex-wrap gap-6 md:-m-8">
                    <div class="bg-accent-lighter py-4 px-8 rounded-xl text-center w-full flex-1" v-for="(element, i) in billingCategories[subscriptionsChoice]" :key="i">
                        <p class="text-3xl"><b>{{ element.price }}</b></p>
                        <p>{{ element.description}}</p>
                    </div>
                </div>
                <Button variant="accent" class="flex-none">Je m'abonne</Button>
            </div>
        </div>
    </section>

    <section class="container mb-24">
      <h2 class="text-3xl mb-6 lg:mb-12">Découvrez les artisans qui vont tous vous apprendre</h2>

      <div class="flex gap-6">
        <div v-for="craftman in props.craftmen" :key="craftman.id" class="relative max-w-72 flex-1">
          <img class="h-72 w-full object-cover rounded-md" :src="craftman.avatar" alt="">
          <div class="absolute bg-accent-lighter/50 bottom-0 left-0 right-0 p-2 h-1/4 ">
            <p class="text-accent-foreground text-lg font-bold">{{ craftman.user.firstname }} {{ craftman.user.lastname }}</p>
            <p class="truncate">{{ craftman.description }}</p>
          </div>
        </div>
      </div>
    </section>
</template>
