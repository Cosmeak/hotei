<script setup>
import { Button } from '@/Components/ui/button';
import { usePage } from '@inertiajs/vue3';
import { ArrowRight } from 'lucide-vue-next';
import { RadioGroup, RadioGroupItem } from '@/Components/ui/radio-group'
import { Label } from '@/Components/ui/label'

const craftmanships = usePage().props.meta.craftsmanships;
// const props = defineProps([
//     "craftmen"
// ])
</script>

<template>
    <section class="container flex gap-12 justify-between items-center my-24">
        <div>
            <h1 class="text-5xl">Apprenez à maîtriser <span class="underline underline-offset-14 decoration-primary">la poterie</span></h1>
            <p class="w-1/2 my-4 text-xl">Grâce à des cours en ligne réaliser par des artisans professionnels.</p>
            <Button variant="secondary" class="font-bold text-lg">Je m'abonne</Button>
        </div>

        <div>
            <img src="/assets/craftmanships/pottery.svg" alt="">
        </div>
    </section>

    <section class="mt-6 bg-primary text-primary-foreground py-12">
        <div class="container">
            <h2 class="text-3xl mb-4">Découvrez nos artisanats</h2>

            <div class="flex justify-between gap-2">

                <Button v-for="craftmanship in craftmanships" :key="craftmanship.id" variant="secondary" class="flex justify-between w-48">{{ craftmanship.name }} <ArrowRight /></Button>
            </div>
        </div>
    </section>

    <section class="container py-12">
        <h2 class="text-3xl mb-12">Une plateforme d'e-learning adaptée à vous</h2>
        <div class="flex flex-col md:flex-row justify-betwen gap-32">
            <div>
                <p class="mb-4">Hotei vous connecte avec une communauté d'experts artisans qui partagent leur savoir-faire. Nos artisans vous guident pas à pas dans l'apprentissage de techniques dans le domaine de votre choix.</p>
                <p>Posez vos questions, perfectionnez vos créations et développez votre passion avec un accompagnement personnalisé pour tous les niveaux.</p>
            </div>

            <div class="flex gap-4">
                <div class="bg-primary text-primary-foreground p-4 rounded-xl flex flex-col items-center">
                    <span class="text-6xl">+50</span>
                    <span>artisans</span>
                </div>
                <div class="bg-primary text-primary-foreground p-4 rounded-xl flex flex-col items-center">
                    <span class="text-6xl">20h</span>
                    <span>de contenus</span>
                </div>
            </div>
        </div>
    </section>

    <section class="container"> 
        <h2 class="text-3xl mb-12">Vous souhaitez acheter des cours ?</h2>
        <p class="mb-4">Alimentez votre passion créative en <b>rechargeant votre porte-monnaie de Craftout</b> qui vous donnent accès à tous nos cours.</p>
        <p class="mb-4">Optez pour un <b>abonnement mensuel</b> pour un approvisionnement régulier ou choisissez un <b>pack unique</b> selon vos besoins. </p>
        <InertiaLink class="text-primary underline">
            Découvrir ce que vous pouvez acheter avec vos Craftout
        </InertiaLink>

        <div class="ms-4 bg-primary rounded-xl p-4 my-16 flex justify-center items-center gap-16 relative">
            <div class="bg-secondary rounded-lg p-3 border-primary border h-fit absolute -left-6">
                <RadioGroup default-value="option-one">
                    <div class="flex items-center space-x-2">
                        <RadioGroupItem id="option-one" value="option-one" />
                        <Label for="option-one">Abonnement</Label>
                    </div>
                    <div class="flex items-center space-x-2">
                        <RadioGroupItem id="option-two" value="option-two" />
                        <Label for="option-two">Packs</Label>
                    </div>
                </RadioGroup>
            </div>

            <div class="flex flex-col flex-wrap gap-12 items-center">
                <div class="flex justify-center flex-row flex-wrap gap-8 -m-8">
                    <div class="bg-secondary border-primary border p-4 rounded-xl text-center">
                        <p class="text-3xl"><b>30€ / mois</b></p>
                        <p>200 + 10 craftout bonus</p>
                    </div>
                    <div class="bg-secondary border-primary border p-4 rounded-xl text-center">
                        <p class="text-3xl"><b>30€ / mois</b></p>
                        <p>200 + 10 craftout bonus</p>
                    </div>
                    <div class="bg-secondary border-primary border p-4 rounded-xl text-center">
                        <p class="text-3xl"><b>30€ / mois</b></p>
                        <p>200 + 10 craftout bonus</p>
                    </div>
                </div>
                <Button variant="secondary" class="flex-none">Je m'abonne</Button>
            </div>
        </div>  
    </section>

    <section>

    </section>
</template>
