<script setup lang="ts">
import { useForm } from 'laravel-precognition-vue-inertia';
import { usePage } from '@inertiajs/vue3';
import { Link } from "@inertiajs/vue3";
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import { Button } from '@/Components/ui/button';
import TableView from "@/Components/TableView.vue";
import Payement from "@/Components/Payement.vue";

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

interface Props {
  history: Array<Array<string | number>>;
  subscriptionPrice: number;
  courseOrders: Array<Array<string | number>>;
}

const props = defineProps<Props>();

const HistoryHeaders = ['Nom', "Date", 'Prix']
const CourseHeaders = ['Nom', "Type", 'Status']

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
      <div class="flex flex-col gap-4">
        <div class="flex flex-col md:flex-row gap-4">
          <div class="w-full md:w-1/2">
            <Label for="firstname">Prénom</Label>
            <Input
              id="firstname"
              type="text"
              class="mt-1 block w-full bg-white border border-secondary-darker"
              v-model="userProfileForm.firstname"
              required
              autofocus
              autocomplete="firstname"
            />
          </div>
          <div class="w-full md:w-1/2">
            <Label for="lastname">Nom</Label>
            <Input
              id="lastname"
              type="text"
              class="mt-1 block w-full bg-white border border-secondary-darker"
              v-model="userProfileForm.lastname"
              required
              autocomplete="lastname"
            />
          </div>
        </div>

        <div class="flex flex-col md:flex-row gap-4 items-end">
          <div class="w-full md:w-1/2">
            <Label for="email">Email</Label>
            <Input
              id="email"
              type="email"
              class="mt-1 block w-full bg-white border border-secondary-darker"
              v-model="userProfileForm.email"
              required
              autocomplete="username"
            />
          </div>
          <div class="flex flex-col gap-1">
            <Button :disabled="userProfileForm.processing" variant="accent">
              Enregistrer les modifications
            </Button>
            <Transition
              enter-active-class="transition ease-in-out"
              enter-from-class="opacity-0"
              leave-active-class="transition ease-in-out"
              leave-to-class="opacity-0"
            >
              <p v-if="userProfileForm.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
            </Transition>
          </div>
        </div>
      </div>
    </form>
    <h3 class="text-xl">Mot de passe</h3>
    <form @submit.prevent="() => updatePasswordForm.submit({ onSuccess: () => updatePasswordForm.reset() })">
      <div class="flex flex-col gap-4">
        <div class="flex flex-col md:flex-row gap-4">
          <div class="w-full md:w-1/2">
            <Label for="current_password">Mot de passe actuel</Label>
            <Input
              id="current_password"
              v-model="updatePasswordForm.current_password"
              type="password"
              class="mt-1 block w-full bg-white border border-secondary-darker"
              autocomplete="current-password"
            />
          </div>
          <div class="w-full md:w-1/2">
            <Label for="password">Nouveau mot de passe</Label>
            <Input
              id="password"
              v-model="updatePasswordForm.password"
              type="password"
              class="mt-1 block w-full bg-white border border-secondary-darker"
              autocomplete="new-password"
            />
          </div>
        </div>

        <div class="flex flex-col md:flex-row gap-4 items-end">
          <div class="w-full md:w-1/2">
            <Label for="password_confirmation">Confirmer le nouveau mot de passe</Label>
            <Input
              id="password_confirmation"
              v-model="updatePasswordForm.password_confirmation"
              type="password"
              class="mt-1 block w-full bg-white border border-secondary-darker"
              autocomplete="new-password"
            />
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
      <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-4">
        <!-- Subscription -->
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between bg-white p-4 rounded">
          <div class="flex flex-col gap-2">
            <Label for="craftout_subscription">Abonnement (mensuel)</Label>
            <p id="craftout_subscription" class="text-sm md:text-base font-medium">
              {{ props.subscriptionPrice }} € / mois
            </p>
          </div>
          <div class="md:ml-auto">
            <Button variant="accent">
              <Payement />
            </Button>
          </div>
        </div>

        <!-- Point Purchases -->
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between bg-white p-4 rounded">
          <div class="flex flex-col gap-2">
            <Label for="craftout_total">Total des craftout :</Label>
            <p id="craftout_total" class="text-sm md:text-base font-medium">
              {{ user.credits }}
            </p>
          </div>
          <div class="md:ml-auto">
            <Button variant="accent">
              <Payement />
            </Button>
          </div>
        </div>
      </div>
    </form>

    <h3 class="text-xl">Historique des achats</h3>
    <TableView :headers="HistoryHeaders" :rows="props.history" caption="Liste des achats"/>

    <h3 class="text-xl">Mes Cours</h3>
    <TableView :headers="CourseHeaders" :rows="props.courseOrders" caption="Liste des cours"/>

    <h3 class="text-xl">Supprimer mon compte</h3>
    <form @submit.prevent="() => deleteAccountForm.submit()">
      <div class="flex flex-col gap-4">
        <div class="flex flex-col md:flex-row gap-4 items-end">
          <div class="w-full md:w-1/2">
            <Label for="password">Mot de passe</Label>
            <Input
              id="password"
              type="password"
              class="mt-1 block w-full bg-white border border-secondary-darker"
              v-model="deleteAccountForm.password"
              required
            />
          </div>

          <div class="flex flex-col gap-1">
            <Button variant="destructive" :disabled="deleteAccountForm.processing">
              Supprimer mon compte
            </Button>
            <Transition
              enter-active-class="transition ease-in-out"
              enter-from-class="opacity-0"
              leave-active-class="transition ease-in-out"
              leave-to-class="opacity-0"
            >
              <p v-if="deleteAccountForm.recentlySuccessful" class="text-sm text-gray-600">
                Compte supprimé.
              </p>
            </Transition>
          </div>
        </div>
      </div>
    </form>

  </div>
</template>
