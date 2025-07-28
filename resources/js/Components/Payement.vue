<script setup>
import { ref } from 'vue'
import { Dialog, DialogPanel, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { Button } from "@/Components/ui/button/index.js";
import { Label } from "@/Components/ui/label/index.js";
import { Input } from "@/Components/ui/input/index.js";
import {useForm} from "@inertiajs/vue3";

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

const form = useForm({
  email: "",
  password: "",
});

const submit = () => {
  form.post(route("login"), {
    onSuccess: () => {
      nextStep();
    },
    onFinish: () => form.reset("password"),
  });
};

const activeBlock = ref('bloc1');
const selectedArticle = ref(null);
const open = ref(false);

const articlesAbonnement = ref([
  { id: 805577, price: "30€", credits: "200 + 10 crédits bonus" },
  { id: 805579, price: "60€", credits: "400 + 25 crédits bonus" },
  { id: 805580, price: "90€", credits: "600 + 50 crédits bonus" }
]);

const articlesPack = ref([
  { id: 805582, price: "10€", credits: "50 crédits" },
  { id: 805583, price: "20€", credits: "100 crédits + 5 bonus" },
  { id: 805584, price: "50€", credits: "250 crédit + 10 bonus" },
  { id: 805589, price: "100€", credits: "500 crédit + 20 bonus" },
  { id: 805590, price: "200€", credits: "1000 crédit + 50 bonus" },
]);

function confirmPurchase() {
  if (selectedArticle.value) {
    const url = route('buyLemon.product', { productId: selectedArticle.value.id });
    window.open(url, '_blank');
  }
}
</script>


<template>
  <Button @click="open = true" variant="accent" class="font-bold text-lg">Je m'abonne</Button>

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
                <img src="/logo.svg" class="h-16" alt="">
                <div class="w-1/3 flex justify-end">
                  <button @click="open = false" class="top-2 right-2 text-gray-600 hover:text-gray-900">✖</button>
                </div>
              </div>
              <div class="flex justify-around">
                <div class="w-5/6">
                  <div class="flex justify-center">
                    <div class="flex">
                      <div v-for="(step, index) in steps" :key="index" class="flex items-center">
                        <div class="w-10 h-10 flex items-center justify-center rounded-full text-white font-bold" :class="{'bg-primary': index <= currentStep,'bg-gray-300': index > currentStep}">{{ index + 1 }}</div>
                        <div v-if="index < steps.length - 1" class="h-1 w-16 m-2" :class="{'bg-primary': index < currentStep,'bg-gray-300': index >= currentStep}"></div>
                      </div>
                    </div>
                  </div>

                  <!-- Étape 1 -->
                  <div v-if="currentStep === 0" class="flex flex-col items-center p-8">
                    <h2 class="font-bold text-2xl p-8 my-2">Obtenir des craftouts</h2>
                    <p>Hotei propose un système de crédits, les Craftout, pour accéder aux cours. Obtenez-les via un abonnement mensuel, qui offre un nombre fixe de Craftouts chaque mois à un tarif avantageux, ou achetez des packs ponctuels selon vos besoins. Optez pour la flexibilité tout en profitant d’un apprentissage structuré et immersif avec nos artisans experts.</p>
                    <p class="font-bold my-2">Consultez notre infographie pour plus d’informations sur les Craftout</p>

                    <div class="mx-auto border items-center rounded-xl w-4/5 bg-secondary-lighter">
                      <div class="flex">
                        <div
                          class="w-1/2 text-center cursor-pointer rounded-tl-lg border-primary border-b-2 p-1"
                          :class="{ 'bg-primary text-white': activeBlock === 'bloc1', 'bg-background_component': activeBlock !== 'bloc1' }"
                          @click="activeBlock = 'bloc1'"
                        >
                          Abonnement
                        </div>
                        <div
                          class="w-1/2 text-center cursor-pointer rounded-tr-lg border-primary border-b-2 p-1"
                          :class="{ 'bg-primary text-white': activeBlock === 'bloc2', 'bg-background_component': activeBlock !== 'bloc2' }"
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
                            @click="selectedArticle = { ...article, type: 'abonnement' }"
                            :class="{
                              'bg-white': selectedArticle?.id !== article.id,
                              'bg-primary-foreground': selectedArticle?.id === article.id
                            }"

                          >
                            <!-- Rond de sélection -->
                            <div
                              class="absolute top-2 right-2 w-6 h-6 rounded-full transition-all duration-300"
                              :class="{
                                'bg-gray-300': selectedArticle?.id !== article.id,
                                'bg-accent': selectedArticle?.id === article.id
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
                            class="relative rounded-3xl p-8 cursor-pointer transition-all duration-300"
                            @click="selectedArticle = { ...article, type: 'pack' }"
                            :class="{
                              'bg-white': selectedArticle?.id !== article.id,
                              'bg-primary-foreground': selectedArticle?.id === article.id
                            }"

                          >
                            <!-- Rond de sélection -->
                            <div
                              class="absolute top-2 right-2 w-6 h-6 rounded-full transition-all duration-300"
                              :class="{
                                'bg-gray-300': selectedArticle?.id !== article.id,
                                'bg-accent': selectedArticle?.id === article.id
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
                    <form @submit.prevent="submit" class="flex flex-col gap-4">
                      <div class="flex flex-col gap-2">
                        <Label for="email">Email</Label>
                        <Input
                          id="email"
                          v-model="form.email"
                          type="email"
                          required
                          autofocus
                          autocomplete="email"
                        />
                      </div>

                      <div class="flex flex-col gap-2">
                        <Label for="password">Mot de passe</Label>
                        <Input
                          id="password"
                          v-model="form.password"
                          type="password"
                          required
                          autocomplete="password"
                        />
                      </div>

                      <p v-if="form.errors.length > 0">
                        L'adresse email ou le mot de passe est incorrect.
                      </p>

                      <div class="flex items-center gap-4  justify-end">
                        <InertiaLink
                          :href="route('password.request')"
                          class="underline text-sm text-gray-600 hover:text-gray-900"
                        >
                          Mot de passe oublié ?
                        </InertiaLink>

                        <Button variant="accent" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                          Se connecter
                        </Button>
                      </div>
                    </form>

                    <div class="flex items-center my-4 justify-center">
                      <hr class="border-t border-gray-500 border-1 w-full" />
                      <span class="px-4 text-gray-500">ou</span>
                      <hr class="border-t border-gray-500 border-1 w-full" />
                    </div>

                    <div class="flex justify-center space-x-4 mt-4">
                      <a :href="route('auth.google')">
                        <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" />
                      </a>
                    </div>

                    <hr class="px-4 border-t border-gray-500 border-1 w-full my-4" />

                    <p class="text-sm text-center">
                      Vous n'avez pas de compte ?
                      <InertiaLink
                        :href="route('register')"
                        class="font-bold"
                      >
                        Se connecter
                      </InertiaLink>
                    </p>
                  </div>


                  <div v-if="currentStep === 2" class="flex flex-col items-center p-4 w-auto">
                    <div v-if="selectedArticle" class="text-center space-y-2">
                      <p class="text-xl font-bold">Résumé de votre choix</p>
                      <p>Id : {{ selectedArticle.id }}</p>
                      <p>Type : {{ selectedArticle.type }}</p>
                      <p>Prix : {{ selectedArticle.price }}</p>
                      <p>Crédits : {{ selectedArticle.credits }}</p>

                      <button
                        class="bg-accent p-2 rounded-xl"
                        @click="confirmPurchase"
                      >
                        Confirmer l'achat
                      </button>

                    </div>
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
