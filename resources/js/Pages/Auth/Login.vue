<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import { Label } from "@/components/ui/label";
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";

const form = useForm({
    email: "",
    password: "",
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <InertiaHead title="Se connecter" />

    <h1 class="text-3xl mb-8 text-center">Connectez-vous !</h1>

    <form @submit.prevent="submit">
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

        <div class="flex flex-col gap-2 mt-4">
            <Label for="password">Mot de passe</Label>
            <Input
                id="password"
                v-model="form.password"
                type="password"
                required
                autocomplete="password"
            />
        </div>

        <div class="flex items-center gap-4  justify-end mt-4">
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
</template>
