<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import { Label } from "@/Components/ui/label";
import { Input } from "@/Components/ui/input";
import { Button } from "@/Components/ui/button";
import { Checkbox } from "@/Components/ui/checkbox";

const form = useForm({
    firstname: "",
    lastname: "",
    email: "",
    password: "",
    password_confirmation: "",
    cgu: false,
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <InertiaHead title="Se connecter" />

    <h1 class="text-3xl mb-8 text-center">Créez votre compte</h1>

    <form @submit.prevent="submit" class="flex flex-col gap-4">
        <div class="flex flex-col gap-2">
            <Label for="firstname">Prénom</Label>
            <Input
                id="firstname"
                v-model="form.firstname"
                required
                autofocus
                autocomplete="firstname"
            />
            <p class="text-red-700 text-sm">{{ form.errors.firstname }}</p>
        </div>

        <div class="flex flex-col gap-2">
            <Label for="lastname">Nom</Label>
            <Input
                id="lastname"
                v-model="form.lastname"
                required
                autocomplete="lastname"
            />
            <p class="text-red-700 text-sm">{{ form.errors.lastname }}</p>
        </div>

        <div class="flex flex-col gap-2">
            <Label for="email">Email</Label>
            <Input
                id="email"
                v-model="form.email"
                type="email"
                required
                autocomplete="email"
            />
            <p class="text-red-700 text-sm">{{ form.errors.email }}</p>
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
            <p class="text-red-700 text-sm">{{ form.errors.password }}</p>
        </div>

        <div class="flex flex-col gap-2">
            <Label for="password_confirmation">Confirmer votre mot de passe</Label>
            <Input
                id="password_confirmation"
                v-model="form.password_confirmation"
                type="password"
                required
                autocomplete="password"
            />
            <p class="text-red-700 text-sm">{{ form.errors.password_confirmation }}</p>
        </div>

        <Label for="cgu"><Checkbox id="cgu" v-model="form.cgu" required /> J’accepte les <b>conditions générales d’utilisation</b></Label>

        <Button variant="accent" class="mx-auto" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
          Se connecter
        </Button>
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

    <p class="text-center">
        Vous avez déjà un compte ?
        <InertiaLink
            :href="route('login')"
            class="font-bold"
        >
            S'enregistrer
         </InertiaLink>
    </p>
</template>
