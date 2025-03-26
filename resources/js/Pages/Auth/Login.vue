<script setup lang="ts">
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";
import Footer from "@/Components/Footer.vue";
import { Label } from '@/Components/ui/label';
import { Input } from '@/Components/ui/input';
import { Checkbox } from "@/Components/ui/checkbox"
import { Button } from '@/Components/ui/button';
import { useForm } from 'laravel-precognition-vue-inertia';

defineProps<{
  canResetPassword?: boolean;
  status?: string;
}>();

const form = useForm({
  email: "",
  password: "",
  remember: false,
});

const submit = () => {
  form.post(route("login"), {
    onFinish: () => {
      form.reset("password");
    },
  });
};
</script>

<template>
  <InertiaHead title="Se connecter" />
  <div class="bg-[#d9e8dc] relative min-h-screen flex flex-col">
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

              <form @submit.prevent="submit">
            <div>
                <Label for="email">Email</Label>

                <Input
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <Label for="password">Password</Label>

          <TextInput
            id="password"
            type="password"
            class="mt-1 block w-full"
            v-model="form.password"
            required
            autocomplete="current-password"
          />

          <InputError class="mt-2" :message="form.errors.password" />
        </div>

        <div class="block mt-4">
          <label class="flex items-center">
            <Checkbox name="remember" v-model:checked="form.remember" />
            <span class="ms-2 text-sm text-gray-600">Se souvenir de moi </span>
          </label>
        </div>

            <div class="flex items-center justify-end mt-4">
                <InertiaLink
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Forgot your password?
                </InertiaLink>

                <Button class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </Button>
            </div>
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
        <!-- <a
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
        </a> -->
      </div>
      <hr class="px-4 border-t border-gray-500 w-52 border-1 mx-auto mt-6" />

      <div class="flex items-center mt-6">
        <p>Vous n'avez pas de compte ?</p>
        <Link
          :href="route('register')"
          class="flex justify-center items-center px-4 py-2 w-40 bg-transparent border-none font-bold"
        >
          S'inscrire
        </Link>
      </div>
    </div>
  </div>
  <Footer />
</template>
