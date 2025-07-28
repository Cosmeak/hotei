<script setup lang="ts">
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import { Card, CardContent, CardHeader, CardTitle } from "@/Components/ui/card";
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogTrigger } from "@/Components/ui/dialog";
import { Button } from "@/Components/ui/button";
const user = usePage().props.auth.user;
const showProfileModal = ref(false);
const showEditProfileModal = ref(false);
</script>

<template>
  <Dialog v-model:open="showProfileModal">
    <DialogTrigger as-child>
      <Button @click="showProfileModal = true">
        Voir le Profil
      </Button>
    </DialogTrigger>

    <DialogContent>
      <DialogHeader>
        <div class="flex items-center justify-between mt-4">
          <DialogTitle class="text-lg font-semibold">Votre Profil</DialogTitle>
          <Button @click="showEditProfileModal = true">
            Modifier
          </Button>
        </div>
      </DialogHeader>

      <Card class="w-full">
        <CardHeader>
          <CardTitle>Informations</CardTitle>
        </CardHeader>
        <CardContent>
          <div class="space-y-4 text-base">
            <p>Prénom : {{ user.firstname }}</p>
            <p>Nom : {{ user.lastname.toUpperCase() }}</p>
            <p>Email : {{ user.email }}</p>
          </div>
        </CardContent>
      </Card>
    </DialogContent>
  </Dialog>
</template>
