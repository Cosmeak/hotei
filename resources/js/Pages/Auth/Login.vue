<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import { Label } from "@/components/label";
import { Input } from "@/components/input";
import { Button } from "@/components/button";
import { Checkbox } from "@/components/checkbox";

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
    <form @submit.prevent="submit">
        <div>
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

        <div class="mt-4">
            <Label for="password">Mot de passe</Label>
            <Input
                id="password"
                v-model="form.password"
                type="password"
                required
                autocomplete="password"
            />
        </div>

        <div class="flex items-center justify-end mt-4">
            <InertiaLink
                :href="route('password.request')"
                class="underline text-sm text-gray-600 hover:text-gray-900"
            >
                Mot de passe oublié ?
            </InertiaLink>

            <Button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Se connecter
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
            <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" />
        </a>
    </div>

    <div class="flex items-center mt-6">
        <p>Vous n'avez pas de compte ?</p>
        <InertiaLink
            :href="route('register')"
            class="flex justify-center items-center px-4 py-2 w-40 bg-transparent border-none font-bold"
        >
            S'inscrire
        </InertiaLink>
    </div>
</template>
