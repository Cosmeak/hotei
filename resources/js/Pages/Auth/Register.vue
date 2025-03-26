<script setup lang="ts">
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Footer from "@/Components/Footer.vue";

const form = useForm({
  lastname: "",
  firstname: "",
  email: "",
  password: "",
  password_confirmation: "",
});

const submit = () => {
  form.post(route("register"), {
    onFinish: () => {
      form.reset("password", "password_confirmation");
    },
  });
};
</script>

<template>
  <GuestLayout class="bg-[#d9e8dc] relative min-h-screen flex flex-col">
    <div
      class="absolute top-2 right-7 bg-no-repeat z-0 opacity-10 pb-[2cm]"
      style="
        background-image: url(&quot;/cercle.png&quot;);
        background-size: cover;
        background-position: top right;
        width: 850px;
        height: 850px;
      "
    ></div>
    <div
      class="relative z-10 bg-[rgb(255,247,242)] p-6 rounded-lg w-full max-w-md sm:max-w-lg md:max-w-xl lg:max-w-2xl xl:max-w-3xl mb-6 flex-grow"
      style="border-color: rgb(65 113 84); border-width: 2px"
    >
      <Head title="Register" />
      <img
        src="/arrow_arrows_back_direction_left_navigation_right_icon_123237.png"
        alt="Flêche retour"
        class="w-10 h-10 object-cover"
      />
      <h1 class="text-center text-2xl font-semibold mb-6">Crée ton compte</h1>
      <form @submit.prevent="submit" class="space-y-4">
        <div>
          <InputLabel for="lastname" value="Nom" />
          <!-- <TextInput
                        id="lastname"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.lastname"
                        required
                        autofocus
                        autocomplete="lastname"
                    /> -->
          <TextInput
            id="lastname"
            type="text"
            class="mt-1 block w-full"
            v-model="form.lastname"
            required
            autocomplete="lastname"
          />
          <InputError class="mt-2" :message="form.errors.lastname" />
        </div>
        <div>
          <InputLabel for="firstname" value="Prénom" />
          <TextInput
            id="firstname"
            type="text"
            class="mt-1 block w-full"
            v-model="form.firstname"
            required
            autocomplete="firstname"
          />
          <InputError class="mt-2" :message="form.errors.firstname" />
        </div>
        <div>
          <InputLabel for="email" value="Email" />
          <TextInput
            id="email"
            type="email"
            class="mt-1 block w-full"
            v-model="form.email"
            required
            autocomplete="email"
          />
          <InputError class="mt-2" :message="form.errors.email" />
        </div>
        <div>
          <InputLabel for="password" value="Mot de passe" />
          <TextInput
            id="password"
            type="password"
            class="mt-1 block w-full"
            v-model="form.password"
            required
            autocomplete="new-password"
          />
          <InputError class="mt-2" :message="form.errors.password" />
        </div>
        <div>
          <InputLabel
            for="password_confirmation"
            value="Confirmez le mot de passe"
          />
          <TextInput
            id="password_confirmation"
            type="password"
            class="mt-1 block w-full"
            v-model="form.password_confirmation"
            required
            autocomplete="new-password"
          />
          <InputError
            class="mt-2"
            :message="form.errors.password_confirmation"
          />
        </div>
        <PrimaryButton
          class="flex justify-center items-center w-full bg-yellow-500 sm:bg-[rgb(65,113,84)] hover:bg-[#e0a845] text-white font-semibold py-2 rounded"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Créer un compte
        </PrimaryButton>
      </form>
      <div class="flex items-center my-4 justify-center">
        <hr class="border-t border-gray-500 border-1 w-20" />
        <span class="px-4 text-gray-500">ou</span>
        <hr class="border-t border-gray-500 border-1 w-20" />
      </div>
      <div class="flex justify-center space-x-4 mt-4">
        <a :href="route('auth.google')">
          <img
            src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png"
          />
        </a>
        <a
          class="btn btn-primary"
          :href="route('auth.facebook')"
          style="display: flex"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="40"
            height="40"
            viewBox="0 0 32 32"
          >
            <path
              fill="#FFFFFF"
              d="M32 16.084c0-8.837-7.162-16-16-16S0 7.247 0 16.084c0 8.013 5.873 14.644 13.568 15.843v-11.22h-4.087v-4.623h4.087v-3.489c0-4.041 2.423-6.279 6.118-6.279 1.775 0 3.628.312 3.628.312v3.985h-2.046c-2.017 0-2.637 1.255-2.637 2.539v2.931h4.467l-.713 4.623h-3.754v11.22C26.127 30.728 32 24.097 32 16.084z"
            />
          </svg>
          Login with Facebook
        </a>
      </div>
      <hr class="px-4 border-t border-gray-500 w-52 border-1 mx-auto mt-6" />
      <div class="flex items-center mt-6">
        <p>Vous avez déjà un compte ?</p>
        <Link
          :href="route('login')"
          class="flex justify-center items-center px-4 py-2 w-40 bg-transparent border-none font-bold"
          >Se connecter</Link
        >
      </div>
    </div>
  </GuestLayout>
  <Footer />
</template>
