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
    <button @click="open = true" class="px-4 py-2 bg-green-600 text-white rounded-md  shadow hover:bg-background_green_darker">
      Ouvrir la modal
    </button>
  </div>

  <TransitionRoot as="template" :show="open">
    <Dialog class="relative z-10" @close="open = false">
      <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
        <div class="fixed inset-0 bg-gray-500/75 transition-opacity" />
      </TransitionChild>

      <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 sm:items-center sm:p-0">
          <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <DialogPanel class="bg-green-50 rounded-3xl w-4/5">
              <div class="flex justify-between p-4">
                <div class="w-1/3 flex justify-start">
                  <button v-if="currentStep !== 0" @click="prevStep" :disabled="currentStep === 0" class="font-bold"><svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.6172 32.7734L18.8828 34.5078C18.1484 35.2422 16.9609 35.2422 16.2344 34.5078L1.04687 19.3281C0.3125 18.5938 0.3125 17.4063 1.04687 16.6797L16.2344 1.49219C16.9687 0.757813 18.1563 0.757813 18.8828 1.49219L20.6172 3.22656C21.3594 3.96875 21.3437 5.17969 20.5859 5.90625L11.1719 14.875H33.625C34.6641 14.875 35.5 15.7109 35.5 16.75V19.25C35.5 20.2891 34.6641 21.125 33.625 21.125H11.1719L20.5859 30.0937C21.3516 30.8203 21.3672 32.0313 20.6172 32.7734Z" fill="#6E6C6C"/>
                  </svg>
                  </button>
                </div>
                <h1 class="w-1/3 text-2xl font-bold text-center p-4">HOTEI</h1>
                <div class="w-1/3 flex justify-end">
                  <button @click="open = false" v-if="currentStep === 0" class="top-2 right-2 text-gray-600 hover:text-gray-900">✖</button>
                </div>
              </div>
              <div class="flex justify-around">
                <div class="w-5/6">
                  <div class="flex justify-center">
                    <div class="flex">
                      <div v-for="(step, index) in steps" :key="index" class="flex items-center">
                        <div class="w-10 h-10 flex items-center justify-center rounded-full text-white font-bold" :class="{'bg-background_green_darker': index <= currentStep,'bg-gray-300': index > currentStep}">{{ index + 1 }}</div>
                        <div v-if="index < steps.length - 1" class="h-1 w-16 m-2" :class="{'bg-background_green_darker': index < currentStep,'bg-gray-300': index >= currentStep}"></div>
                      </div>
                    </div>
                  </div>

                  <!-- Étape 1 -->
                  <div v-if="currentStep === 0" class="flex flex-col items-center p-8">
                    <h2 class="font-bold text-2xl p-8">Obtenir des craftouts</h2>

                    <div class="mx-auto border items-center rounded-xl border-green-800 border-2 w-4/5 bg-background_component">
                      <div class="flex">
                        <div
                          class="w-1/2 text-center cursor-pointer rounded-tl-lg border-green-800 border-2"
                          :class="{ 'bg-background_green_darker text-white': activeBlock === 'bloc1', 'bg-background_component': activeBlock !== 'bloc1' }"
                          @click="activeBlock = 'bloc1'"
                        >
                          Abonnement
                        </div>
                        <div
                          class="w-1/2 text-center cursor-pointer rounded-tr-lg border-green-800 border-2"
                          :class="{ 'bg-background_green_darker text-white': activeBlock === 'bloc2', 'bg-background_component': activeBlock !== 'bloc2' }"
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
                            class="relative rounded-3xl p-8 border-4 m-4 cursor-pointer transition-all duration-300 border-background_green_darker"
                            @click="selectedArticle = article.id"
                            :class="{
                                'bg-background_green_light': selectedArticle !== article.id,
                                'bg-green-500': selectedArticle === article.id
                              }"
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
                        <div v-if="activeBlock === 'bloc2'" class="grid grid-cols-3 gap-4">
                          <article
                            v-for="article in articlesPack"
                            :key="article.id"
                            class="relative rounded-3xl p-8 border-4 cursor-pointer transition-all duration-300 border-green-800"
                            @click="selectedArticle = article.id"
                            :class="{
                              'bg-background_green_light': selectedArticle !== article.id,
                              'bg-green-500': selectedArticle === article.id
                             }"
                          >
                            <!-- Rond de sélection -->
                            <div
                              class="absolute top-2 right-2 w-6 h-6 rounded-full transition-all duration-300"
                              :class="{
                                  'bg-gray-300': selectedArticle !== article.id,
                                  'bg-yellow-400': selectedArticle === article.id
                                }"
                            ></div>
                            <h3 class="font-bold">{{ article.price }}</h3>
                            <p>{{ article.credits }}</p>
                          </article>
                        </div>

                      </div>
                    </div>

                    <button @click="nextStep" :disabled="currentStep === 2" class="bg-yellow-500 px-12 py-1 rounded-xl font-bold mt-4 flex">
                      Passez à la suite <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M10.9297 3.13593L11.9703 2.0953C12.4109 1.65468 13.1234 1.65468 13.5594 2.0953L22.6719 11.2031C23.1125 11.6437 23.1125 12.3562 22.6719 12.7922L13.5594 21.9047C13.1188 22.3453 12.4063 22.3453 11.9703 21.9047L10.9297 20.8641C10.4844 20.4187 10.4938 19.6922 10.9484 19.2562L16.5969 13.875H3.125C2.50156 13.875 2 13.3734 2 12.75V11.25C2 10.6266 2.50156 10.125 3.125 10.125H16.5969L10.9484 4.74374C10.4891 4.3078 10.4797 3.58124 10.9297 3.13593Z" fill="#111111"/>
                    </svg>

                    </button>
                  </div>
                  <div v-if="currentStep === 1" class="flex flex-col items-center p-4 w-auto">
                    <h2 class="font-bold text-2xl p-4">Connectez-vous</h2>
                    <div class="rounded-xl border-green-800 border-2 p-4 bg-background_component">
                      <div>
                        <article>
                          <p>Adresse mail</p>
                          <input type="text" class="w-full">
                        </article>
                        <article>
                          <p>Mot de passe</p>
                          <input type="text" class="w-full" >
                        </article>
                        <button @click="nextStep" :disabled="currentStep === 2" class="bg-yellow-500 px-12 py-1 rounded-xl font-bold mt-4 w-full">
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
                    <h2 class="font-bold p-4 text-2xl">Informations de paiement</h2>
                    <div class="rounded-xl border-green-800 border-2 p-4 bg-background_component">


                      <!--<div class="md:flex">
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
                      </div>-->
                    </div>
                    <button @click="nextStep" :disabled="currentStep === 2" class="bg-yellow-500 px-12 py-1 rounded-xl font-bold mt-4 flex">
                      Payer <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M9 16.8703L4.83 12.7003L3.41 14.1103L9 19.7003L21 7.70028L19.59 6.29028L9 16.8703Z" fill="#111111"/>
                    </svg>
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
