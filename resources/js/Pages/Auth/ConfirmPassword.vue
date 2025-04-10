<script setup lang="ts">
import { Label } from '@/Components/ui/label';
import { Input } from '@/Components/ui/input';
import { useForm } from '@inertiajs/vue3';
import { Button } from '@/Components/ui/button';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => {
            form.reset();
        },
    });
};
</script>

<template>
    <InertiaHead title="Confirm Password" />

    <form @submit.prevent="submit">
        <div>
            <Label for="password">Password</Label>
            <Input
                id="password"
                type="password"
                class="mt-1 block w-full"
                v-model="form.password"
                required
                autocomplete="current-password"
                autofocus
            />
            <InputError class="mt-2" :message="form.errors.password" />
        </div>

        <div class="flex justify-end mt-4">
            <Button class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Confirm
            </Button>
        </div>
    </form>
</template>
