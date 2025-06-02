<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import { Label } from "@/components/label";
import { Input } from "@/components/input";
import { Button } from "@/components/button";
import { Checkbox } from "@/components/checkbox";

const form = useForm({
    firstname: "",
    lastname: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password", "password_confirmation"), 
    });  
};
</script>

<template>
    <InertiaHead title="Se connecter" />
    <form @submit.prevent="submit">
        <div>
            <Label for="firstname">Prénom</Label>
            <Input
                id="firstname"
                v-model="form.firstname"
                required
                autofocus
                autocomplete="firstname"
            />
        </div>

        <div>
            <Label for="lastname">Nom</Label>
            <Input
                id="lastname"
                v-model="form.lastname"
                required
                autocomplete="lastname"
            />
        </div>

        <div>
            <Label for="email">Email</Label>
            <Input
                id="email"
                v-model="form.email"
                type="email"
                required
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

        <Button class="mx-auto" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
            Se connecter
        </Button>
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

    <p class="text-center">
        Vous avez déjà un compte ?
        <InertiaLink
            :href="route('login')"
            class="font-bold"
        >
            Se connecter
         </InertiaLink>
    </p>
</template>
