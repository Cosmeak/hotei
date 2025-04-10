<script setup lang="ts">
import { Label } from '@/Components/ui/label';
import { Input } from '@/Components/ui/input';
import { Button } from '@/Components/ui/button';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    firstname: '',
    lastname: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};
</script>

<template>
    <InertiaHead title="Register" />

    <form @submit.prevent="submit">
        <div>
            <Label for="firstname">Firstname</Label>

            <Input
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.firstname"
                required
                autofocus
                autocomplete="firstname"
            />

            <InputError class="mt-2" :message="form.errors.firstname" />
        </div>

        <div class="mt-4">
            <Label for="lastname">Lastname</Label>

            <Input
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.lastname"
                required
                autofocus
                autocomplete="lastname"
            />

            <InputError class="mt-2" :message="form.errors.lastname" />
        </div>

        <div class="mt-4">
            <Label for="email">Email</Label>

            <Input
                id="email"
                type="email"
                class="mt-1 block w-full"
                v-model="form.email"
                required
                autocomplete="username"
            />

            <InputError class="mt-2" :message="form.errors.email" />
        </div>

        <div class="mt-4">
            <Label for="password">Password</Label>

            <Input
                id="password"
                type="password"
                class="mt-1 block w-full"
                v-model="form.password"
                required
                autocomplete="new-password"
            />

            <InputError class="mt-2" :message="form.errors.password" />
        </div>

        <div class="mt-4">
            <Label for="password_confirmation">Confirm Password</Label>

            <Input
                id="password_confirmation"
                type="password"
                class="mt-1 block w-full"
                v-model="form.password_confirmation"
                required
                autocomplete="new-password"
            />

            <InputError class="mt-2" :message="form.errors.password_confirmation" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <InertiaLink
                :href="route('login')"
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Already registered?
            </InertiaLink>

            <Button class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Register
            </Button>
        </div>
    </form>
</template>
