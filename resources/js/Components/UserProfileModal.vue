<script setup lang="ts">
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import { Card, CardContent, CardHeader, CardTitle } from "@/Components/ui/card";
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogTrigger } from "@/Components/ui/dialog";
import { Button } from "@/Components/ui/button";

interface User {
  firstname: string;
  lastname: string;
  email: string;
}

const user = usePage().props.auth.user;
const showModal = ref(false);

function toUpper(text?: string): string {
  return text?.toUpperCase();
}
</script>

<template>
  <Dialog v-model:open="showModal">
    <DialogTrigger as-child>
      <Button class="bg-background_green_darker hover:bg-background_green_light" @click="showModal = true">Voir le Profil</Button>
    </DialogTrigger>
    <DialogContent>
      <DialogHeader>
        <DialogTitle>Votre Profil</DialogTitle>
      </DialogHeader>
      <Card class="w-full">
        <CardHeader>
          <CardTitle>Informations</CardTitle>
        </CardHeader>
        <CardContent>
          <div class="space-y-4 text-base">
            <p>Prénom : {{ user.firstname }}</p>
            <p>Nom : {{ toUpper(user.lastname) }}</p>
            <p>Email : {{ user.email }}</p>
          </div>
        </CardContent>
      </Card>
    </DialogContent>
  </Dialog>
</template>
