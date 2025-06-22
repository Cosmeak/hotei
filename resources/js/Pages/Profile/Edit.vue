<script setup lang="ts">
import { useForm } from 'laravel-precognition-vue-inertia';
import { usePage } from '@inertiajs/vue3';
import { Link } from "@inertiajs/vue3";
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import { Button } from '@/Components/ui/button';
import TableView from "@/Components/TableView.vue";
import { Check } from "lucide-vue-next";

const user = usePage().props.auth.user;
const { craftman } = usePage().props;

const userProfileForm = useForm("put", route('profile.update'), {
  firstname: user.firstname,
  lastname: user.lastname,
  email: user.email
});

const updatePasswordForm = useForm("put", route('password.update'), {
  current_password: '',
  password: '',
  password_confirmation: '',
})

const deleteAccountForm = useForm('delete', route('profile.destroy'), {
  password: ''
});

const HistoryHeaders = ['Nom', "Date d'achat", 'Tarif']
const HistoryRows = [
  ['Pack de 60 craftout', '19/01/24', '23€'],
  ['Boîte surprise', '22/02/24', '15€'],
  ['Abonnement premium', '01/03/24', '49€'],
]
const CourseHeaders = ['Nom', "Type", 'Status']
const CourseRows = [
  ['Echarpe', 'Projet', 'En cours'],
  ['Rond Magique', 'Compétence', 'Fini'],
]
</script>

<template>
  <InertiaHead title="Paramètres du compte"/>

  <div class="container flex flex-col gap-4 my-12">
    <div class="flex justify-between items-center">
      <div class="flex items-center">
        <div v-if="craftman">
          <img class="size-24 mr-6 rounded-full" alt="profile picture" :src="craftman.avatar"/>
        </div>
        <h1 class="text-2xl">Compte</h1>
      </div>

      <Button method="post" :href="route('logout')" :as="Link" variant="secondary">
        Se déconnecter
      </Button>
    </div>

    <h3 class="text-xl">
      Informations Personnelles
    </h3>
    <form @submit.prevent="userProfileForm.submit()">
      <div class="flex flex-col gap-2">
        <div class="flex flex-col md:flex-row gap-2">
          <div class="w-full">
            <Label for="firstname">
              Prénom
            </Label>

            <Input
              id="firstname"
              type="text"
              class="mt-1 block w-full bg-white border border-secondary-darker"
              v-model="userProfileForm.firstname"
              required
              autofocus
              autocomplete="firstname"
            />

            <!-- <InputError class="mt-2" :message="userProfileForm.errors.firstname"/> -->
          </div>
          <div class="w-full">
            <Label for="lastname">
              Nom
            </Label>

            <Input
              id="lastname"
              type="text"
              class="mt-1 block w-full bg-white border border-secondary-darker"
              v-model="userProfileForm.lastname"
              required
              autofocus
              autocomplete="lastname"
            />

            <!-- <InputError class="mt-2" :message="userProfileForm.errors.lastname"/> -->
          </div>
        </div>

        <div class="flex md:flex-row gap-2 items-end">
          <div class="w-1/2 justify-center">
            <Label for="email">
              Email
            </Label>

            <Input
              id="email"
              type="email"
              class="mt-1 block w-full bg-white border border-secondary-darker"
              v-model="userProfileForm.email"
              required
              autocomplete="username"
            />
          </div>

          <Button :disabled="userProfileForm.processing" variant="accent">Enregistrer les modifications</Button>
          <Transition
            enter-active-class="transition ease-in-out"
            enter-from-class="opacity-0"
            leave-active-class="transition ease-in-out"
            leave-to-class="opacity-0"
          >
            <p v-if="userProfileForm.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
          </Transition>
        </div>
        <!-- <InputError class="mt-2" :message="userProfileForm.errors.email"/> -->

        <!-- <div v-if="mustVerifyEmail && user.email_verified_at === null">
            <p class="text-sm mt-2 text-gray-800">
                Your email address is unverified.
                <InertiaLink
                    :href="route('verification.send')"
                    method="post"
                    as="button"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Click here to re-send the verification email.
                </InertiaLink>
            </p>
            <div
                v-show="status === 'verification-link-sent'"
                class="mt-2 font-medium text-sm text-green-600"
            >
                A new verification link has been sent to your email address.
            </div>
        </div> -->
      </div>
    </form>
    <h3 class="text-xl">Mot de passe</h3>
    <form @submit.prevent="() => updatePasswordForm.submit({ onSuccess: () => updatePasswordForm.reset() })">
      <div class="flex flex-col gap-2">
        <div class="flex flex-col md:flex-row gap-2">
          <div class="w-full">
            <Label for="current_password">
              Mot de passe actuel
            </Label>

            <Input
              id="current_password"
              ref="currentPasswordInput"
              v-model="updatePasswordForm.current_password"
              type="password"
              class="mt-1 block w-full bg-white border border-secondary-darker"
              autocomplete="current-password"
            />

            <!-- <InputError :message="updatePasswordForm.errors.current_password" class="mt-2"/> -->
          </div>

          <div class="w-full">
            <Label for="password">
              Nouveau mot de passe
            </Label>

            <Input
              id="password"
              ref="passwordInput"
              v-model="updatePasswordForm.password"
              type="password"
              class="mt-1 block w-full bg-white border border-secondary-darker"
              autocomplete="new-password"
            />

            <!-- <InputError :message="updatePasswordForm.errors.password" class="mt-2"/> -->
          </div>
        </div>
        <div class="flex flex-col md:flex-row gap-2 items-end">
          <div class="w-1/2">
            <Label for="password_confirmation">
              Confirmer le nouveau mot de passe
            </Label>

            <Input
              id="password_confirmation"
              v-model="updatePasswordForm.password_confirmation"
              type="password"
              class="mt-1 block w-full bg-white border border-secondary-darker"
              autocomplete="new-password"
            />

            <!-- <InputError :message="updatePasswordForm.errors.password_confirmation" class="mt-2"/> -->
          </div>

          <div class="flex flex-col gap-1">
            <Button :disabled="updatePasswordForm.processing" variant="accent">
              Enregistrer les modifications
            </Button>

            <Transition
              enter-active-class="transition ease-in-out"
              enter-from-class="opacity-0"
              leave-active-class="transition ease-in-out"
              leave-to-class="opacity-0"
            >
              <p v-if="updatePasswordForm.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
            </Transition>
          </div>
        </div>

      </div>
    </form>
    <h3 class="text-xl">Craftout</h3>
    <form>
      <div class="grid grid-cols-2">
        <div class="flex flex-col md:flex-row md:items-center">
          <div class="flex flex-col md:flex-row md:items-center gap-3 md:gap-4 w-full justify-around">
            <Label for="craftout_subscription">Abonnement (mensuel)</Label>
            <p id="craftout_subscription" class="text-sm md:text-base font-medium">
              {{ user.subscription_credits }} € / mois
            </p>
            <Button variant="accent">
              <span>Modifier</span>
              <span>Chargement...</span>
            </Button>

            <Transition
              enter-active-class="transition-opacity duration-300"
              enter-from-class="opacity-0"
              leave-active-class="transition-opacity duration-300"
              leave-to-class="opacity-0"
            >
              <div
                class="flex items-center gap-1 text-green-600 text-sm"
                role="status"
              >
                <Check class="w-4 h-4"/>
                <span>Modifié avec succès</span>
              </div>
            </Transition>
          </div>
        </div>

        <!-- Point Purchases (Total) -->
        <div class="flex flex-col md:flex-row md:items-center gap-4">
          <div class="flex flex-col md:flex-row md:items-center gap-3 md:gap-4 w-full justify-around">
            <div class="flex items-center">
              <Label for="craftout_total" class="mr-2">Total des craftout :</Label>
              <p id="craftout_total" class="text-sm md:text-base font-medium">
                {{ user.subscription_credits }} €
              </p>
            </div>
            <Button variant="accent">
              <span>Mettre à jour</span>
              <span>Chargement...</span>
            </Button>

            <Transition
              enter-active-class="transition-opacity duration-300"
              enter-from-class="opacity-0"
              leave-active-class="transition-opacity duration-300"
              leave-to-class="opacity-0"
            >
              <div
                class="flex items-center gap-1 text-green-600 text-sm"
                role="status"
              >
                <Check class="w-4 h-4"/>
                <span>Modifié avec succès</span>
              </div>
            </Transition>
          </div>
        </div>
      </div>
    </form>

    <h3 class="text-xl">Historique des achats</h3>
    <TableView :headers="HistoryHeaders" :rows="HistoryRows" caption="Liste des achats"/>

    <h3 class="text-xl">Mes Cours</h3>
    <TableView :headers="CourseHeaders" :rows="CourseRows" caption="Liste des cours"/>

    <h3 class="text-xl">Supprimer mon compte</h3>
    <form @submit.prevent="() => deleteAccountForm.submit()">
      <div class="flex flex-col gap-2">
        <div class="flex flex-col md:flex-row gap-2 items-end">
          <div class="w-1/2">
            <Label for="password">Mot de passe</Label>
            <Input
              id="password"
              type="password"
              class="mt-1 block w-full bg-white border border-secondary-darker"
              v-model="deleteAccountForm.password"
              required
            />
            <!-- <InputError :message="deleteAccountForm.errors.password" class="mt-2"/> -->
          </div>

          <Button variant="destructive" :disabled="deleteAccountForm.processing">
            Supprimer mon compte
          </Button>
        </div>
      </div>
    </form>
  </div>
</template>
