<script setup lang="ts">
import { Label } from '@/Components/ui/label';
import { Input } from '@/Components/ui/input';
import { Checkbox } from "@/Components/ui/checkbox"
import { Button } from '@/Components/ui/button';
import { useForm } from 'laravel-precognition-vue-inertia';

defineProps<{
    canResetPassword?: boolean;
    status?: string;
}>();

const form = useForm("post", route('login'), {
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.submit({
        onFinish: () => {
            form.reset('password');
        },
    });
};
</script>

<template>
        <InertiaHead title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

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

                <Input
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
                    <Checkbox name="remember" :model-value="form.remember" @update:model-value="(value) => form.remember = value as boolean" />
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
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
</template>
