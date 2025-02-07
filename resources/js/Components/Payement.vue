<script setup>
import { ref } from 'vue'
import { Dialog, DialogPanel, TransitionChild, TransitionRoot } from '@headlessui/vue'

const steps = ref(["Étape 1 : Début", "Étape 2 : Milieu", "Étape 3 : Fin"]);
const currentStep = ref(0);

const nextStep = () => {
  if (currentStep.value < steps.value.length - 1) {
    currentStep.value++;
  }
};

const prevStep = () => {
  if (currentStep.value > 0) {
    currentStep.value--;
  }
};

const activeBlock = ref('bloc1');
const selectedArticle = ref(null);
const open = ref(false);

// Liste des abonnements avec différents prix
const articlesAbonnement = ref([
  { id: 1, price: "30€", credits: "200 + 10 crédits bonus" },
  { id: 2, price: "50€", credits: "400 + 20 crédits bonus" },
  { id: 3, price: "80€", credits: "700 + 50 crédits bonus" }
]);

// Liste des packs avec différents prix
const articlesPack = ref([
  { id: 4, price: "15€", credits: "100 crédits" },
  { id: 5, price: "25€", credits: "180 crédits" },
  { id: 6, price: "40€", credits: "320 crédits" },
  { id: 7, price: "60€", credits: "500 crédits" },
  { id: 8, price: "100€", credits: "900 crédits" }
]);
</script>

<template>
  <div class="flex justify-center mt-5">
    <button @click="open = true" class="px-4 py-2 bg-green-600 text-white rounded-md  shadow hover:bg-green-500">
      Ouvrir la modal
    </button>
  </div>

  <TransitionRoot as="template" :show="open">
    <Dialog class="relative z-10" @close="open = false">
      <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 bg-gray-500/75 transition-opacity" />
      </TransitionChild>

      <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
          <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <DialogPanel class="bg-green-50 rounded-3xl">
              <div class="flex justify-between p-4">
                <div class="w-1/3 flex justify-start">
                  <button v-if="currentStep !== 0" @click="prevStep" :disabled="currentStep === 0" class="font-bold"><-</button>
                </div>
                <h1 class="w-1/3 text-2xl font-bold text-center">HOTEI</h1>
                <div class="w-1/3 flex justify-end">
                  <button @click="open = false" v-if="currentStep === 0" class="top-2 right-2 text-gray-600 hover:text-gray-900">✖</button>
                </div>
              </div>
              <div class="flex justify-around">
                <div class="p-4 w-5/6">
                  <div class="flex justify-center">
                    <div class="flex">
                      <div v-for="(step, index) in steps" :key="index" class="flex items-center">
                        <div class="w-10 h-10 flex items-center justify-center rounded-full text-white font-bold" :class="{'bg-green-500': index <= currentStep,'bg-gray-300': index > currentStep}">{{ index + 1 }}</div>
                        <div v-if="index < steps.length - 1" class="h-1 w-16 m-2" :class="{'bg-green-500': index < currentStep,'bg-gray-300': index >= currentStep}"></div>
                      </div>
                    </div>
                  </div>

                  <!-- Étape 1 -->
                  <div v-if="currentStep === 0" class="flex flex-col items-center">
                    <h2 class="font-bold">Obtenir des craftouts</h2>

                    <div class="mx-auto border items-center rounded-xl border-green-800 border-2">
                      <div class="flex">
                        <div
                          class="w-1/2 text-center cursor-pointer rounded-tl-lg border-green-800 border-2"
                          :class="{ 'bg-green-500 text-white': activeBlock === 'bloc1', 'bg-gray-200': activeBlock !== 'bloc1' }"
                          @click="activeBlock = 'bloc1'"
                        >
                          Abonnement
                        </div>
                        <div
                          class="w-1/2 text-center cursor-pointer rounded-tr-lg border-green-800 border-2"
                          :class="{ 'bg-green-500 text-white': activeBlock === 'bloc2', 'bg-gray-200': activeBlock !== 'bloc2' }"
                          @click="activeBlock = 'bloc2'"
                        >
                          Pack
                        </div>
                      </div>

                      <!-- Contenu des blocs -->
                      <div class="p-4">
                        <!-- Bloc 1 : Abonnements -->
                        <div v-if="activeBlock === 'bloc1'" class="flex justify-around">
                          <article
                            v-for="article in articlesAbonnement"
                            :key="article.id"
                            class="relative bg-green-500 rounded-3xl p-8 border-4 m-4 cursor-pointer transition-all duration-300 border-green-800"
                            @click="selectedArticle = article.id"
                          >
                            <!-- Rond de sélection -->
                            <div
                              class="absolute top-2 right-2 w-6 h-6 rounded-full transition-all duration-300"
                              :class="{
                                'bg-gray-300': selectedArticle !== article.id,
                                'bg-yellow-400': selectedArticle === article.id
                              }"
                            ></div>
                            <h3 class="font-bold">{{ article.price }} / mois</h3>
                            <p>{{ article.credits }}</p>
                          </article>
                        </div>

                        <!-- Bloc 2 : Connexion -->
                        <div v-if="activeBlock === 'bloc2'" class="flex justify-around">
                          <article
                            v-for="article in articlesPack"
                            :key="article.id"
                            class="relative bg-green-500 rounded-3xl p-8 border-4 m-4 cursor-pointer transition-all duration-300 border-green-800"
                            @click="selectedArticle = article.id"
                          >
                            <!-- Rond de sélection -->
                            <div
                              class="absolute top-2 right-2 w-6 h-6 rounded-full transition-all duration-300"
                              :class="{
                                'bg-gray-300': selectedArticle !== article.id,
                                'bg-yellow-400': selectedArticle === article.id
                              }"
                            ></div>
                            <h3>{{ article.price }}</h3>
                            <p>{{ article.credits }}</p>
                          </article>
                        </div>
                      </div>
                    </div>

                    <button @click="nextStep" :disabled="currentStep === 2" class="bg-yellow-500 px-12 py-1 rounded-xl font-bold mt-4">
                      Passez à la suite ->
                    </button>
                  </div>
                  <div v-if="currentStep === 1" class="flex flex-col items-center p-4 w-auto">
                    <h2 class="font-bold p-4">Connectez-vous</h2>
                    <div class="rounded-xl border-green-800 border-2 p-4">
                      <div>
                        <article>
                          <p>Adresse mail</p>
                          <input type="text">
                        </article>
                        <article>
                          <p>Mot de passe</p>
                          <input type="text">
                        </article>
                        <button @click="nextStep" :disabled="currentStep === 2" class="bg-yellow-500 px-12 py-1 rounded-xl font-bold mt-4">
                          Connexion
                        </button>
                      </div>
                      <div class="flex justify-between flex items-center">
                        <div class="h-0.5 w-16 m-2 bg-gray-300"></div>
                        <p>ou</p>
                        <div class="h-0.5 w-16 m-2 bg-gray-300"></div>
                      </div>
                      <div class="flex justify-center w-full">
                        <a href="" class="p-4">
                          <img class="h-8" src="https://img.icons8.com/?size=512&id=17949&format=png" alt="">
                        </a>
                        <a href="" class="p-4">
                          <img class="h-8" src="https://get-picto.com/wp-content/uploads/2023/08/logo-facebook-blanc.webp" alt="">
                        </a>
                      </div>
                      <div class="text-xs">
                        <p>Vous n'avez pas de compte ? <a href="" class="font-bold">S'inscrire</a></p>
                      </div>
                    </div>
                  </div>
                  <div v-if="currentStep === 2" class="flex flex-col items-center p-4 w-auto">
                    <h2 class="font-bold p-4">Informations de paiement</h2>
                    <div class="rounded-xl border-green-800 border-2 p-4">
                      <div class="md:flex">
                        <article>
                          <p>Nom sur la carte</p>
                          <input type="text">
                        </article>
                        <article>
                          <p>Date d'expiration</p>
                          <input type="text">
                        </article>
                      </div>
                      <div class="md:flex">
                        <article>
                          <p>Numéro de carte</p>
                          <input type="text">
                        </article>
                        <article>
                          <p>CVV</p>
                          <input type="text">
                        </article>
                      </div>
                    </div>
                    <button @click="nextStep" :disabled="currentStep === 2" class="bg-yellow-500 px-12 py-1 rounded-xl font-bold mt-4">
                      Payer
                    </button>
                  </div>
                </div>
              </div>
            </DialogPanel>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
</template>
