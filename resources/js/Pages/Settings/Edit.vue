<script setup lang="ts">
import { useForm } from 'laravel-precognition-vue-inertia';
import { Card, CardContent, CardDescription, CardHeader } from '@/Components/ui/card';
import { usePage } from '@inertiajs/vue3';
import CardFooter from '@/Components/ui/card/CardFooter.vue';
import Input from '@/Components/ui/input/Input.vue';
import Label from '@/Components/ui/label/Label.vue';
import Button from '@/Components/ui/button/Button.vue';
import CardTitle from '@/Components/ui/card/CardTitle.vue';

// defineProps<{
//     mustVerifyEmail?: boolean;
//     status?: string;
// }>();

const user = usePage().props.auth.user;

const userProfileForm = useForm("put", route('settings.update'), {
    firstname: user.firstname,
    lastname: user.lastname,
    email: user.email
});

const updatePasswordForm = useForm("put", route('password.update'), {
    current_password: '',
    password: '',
    password_confirmation: '',
})
</script>

<template>
    <InertiaHead title="Paramètres du compte" />   

    <div class="container flex flex-col gap-4 my-12">
        <Card>
            <CardHeader>
                <CardTitle>
                    Paramètres
                </CardTitle>
                <CardDescription>
                    Vous pouvez mettre à jour vos informations ici.
                </CardDescription>
            </CardHeader>
            <form @submit="() => userProfileForm.submit">
                <CardContent class="flex flex-col gap-2">
                    <div class="flex flex-col md:flex-row gap-2">
                        <div class="w-full">
                            <Label for="firstname">
                                Prénom
                            </Label>

                            <Input
                                id="firstname"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="userProfileForm.firstname"
                                required
                                autofocus
                                autocomplete="firstname"
                            />

                            <InputError class="mt-2" :message="userProfileForm.errors.firstname" />
                        </div>
                        <div class="w-full">
                            <Label for="lastname">
                                Nom
                            </Label>

                            <Input
                                id="lastname"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="userProfileForm.firstname"
                                required
                                autofocus
                                autocomplete="lastname"
                            />

                            <InputError class="mt-2" :message="userProfileForm.errors.lastname" />
                        </div>
                    </div>

                    <div>
                        <Label for="email">
                            Email
                        </Label>

                        <Input
                            id="email"
                            type="email"
                            class="mt-1 block w-full"
                            v-model="userProfileForm.email"
                            required
                            autocomplete="username"
                        />

                        <InputError class="mt-2" :message="userProfileForm.errors.email" />
                    </div>

                    <!-- <div v-if="mustVerifyEmail && user.email_verified_at === null">
                        <p class="text-sm mt-2 text-gray-800">
                            Your email address is unverified.
                            <InertiaLink
                                :href="route('verification.send')"
                                method="post"
                                as="button"
                                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                                Click here to re-send the verification email.
                            </InertiaLink>
                        </p>

                        <div
                            v-show="status === 'verification-link-sent'"
                            class="mt-2 font-medium text-sm text-green-600"
                        >
                            A new verification link has been sent to your email address.
                        </div>
                    </div> -->
                </CardContent>
                <CardFooter>
                    <Button :disabled="userProfileForm.processing">Enregistrer les modifications</Button>
                    <Transition
                        enter-active-class="transition ease-in-out"
                        enter-from-class="opacity-0"
                        leave-active-class="transition ease-in-out"
                        leave-to-class="opacity-0"
                    >
                        <p v-if="userProfileForm.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                    </Transition>
                </CardFooter>
            </form>
        </Card>

        <Card>
            <CardHeader>
                <CardTitle>
                    Mot de passe
                </CardTitle>
                <CardDescription>
                    Mettre à jour votre mot de passe. <br>
                    Assurez-vous d'utiliser un mot passe de minium 8 caractères et relativement aléatoire pour être sécurisé.
                </CardDescription>
            </CardHeader>
            <form @submit.prevent="() => updatePasswordForm.submit({ onSuccess: () => updatePasswordForm.reset() })">
                <CardContent class="flex flex-col gap-2">
                    <div>
                        <Label for="current_password">
                            Mot de passe actuel
                        </Label>

                        <Input
                            id="current_password"
                            ref="currentPasswordInput"
                            v-model="updatePasswordForm.current_password"
                            type="password"
                            class="mt-1 block w-full"
                            autocomplete="current-password"
                        />

                        <InputError :message="updatePasswordForm.errors.current_password" class="mt-2" />
                    </div>

                    <div>
                        <Label for="password">
                            Nouveau mot  de passe
                        </Label>

                        <Input
                            id="password"
                            ref="passwordInput"
                            v-model="updatePasswordForm.password"
                            type="password"
                            class="mt-1 block w-full"
                            autocomplete="new-password"
                        />

                        <InputError :message="updatePasswordForm.errors.password" class="mt-2" />
                    </div>

                    <div>
                        <Label for="password_confirmation">
                            Confirmer le nouveau mot de passe
                        </Label>

                        <Input
                            id="password_confirmation"
                            v-model="updatePasswordForm.password_confirmation"
                            type="password"
                            class="mt-1 block w-full"
                            autocomplete="new-password"
                        />

                        <InputError :message="updatePasswordForm.errors.password_confirmation" class="mt-2" />
                    </div>
                </CardContent>
                <CardFooter>
                    <Button :disabled="updatePasswordForm.processing">Enregistrer les modifications</Button>
                    <Transition
                        enter-active-class="transition ease-in-out"
                        enter-from-class="opacity-0"
                        leave-active-class="transition ease-in-out"
                        leave-to-class="opacity-0"
                    >
                        <p v-if="updatePasswordForm.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                    </Transition>
                </CardFooter>
            </form>
        </Card>

        <Card>
            <CardHeader>
                <CardTitle>
                    Supprimer mon compte
                </CardTitle>
                <CardDescription>
                    Une fois que votre compte est supprimé, toutes vos ressources et données seront supprimé définitivement. <br>
                    Assurez-vous d'être certain de votre choix.
                </CardDescription>
            </CardHeader>
            <CardContent>
                <!-- TODO -->
            </CardContent>
        </Card>
    </div>
</template>
