<script setup lang="ts">
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";
import { Card, CardContent, CardHeader, CardTitle } from "@/Components/ui/card";
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogTrigger } from "@/Components/ui/dialog";
import { Button } from "@/Components/ui/button";
import EditProfileModal from "@/Components/EditProfileModal.vue";

interface User {
  firstname: string;
  lastname: string;
  email: string;
}

const user = usePage().props.auth.user;
const showProfileModal = ref(false);
const showEditModal = ref(false);

function handleSave(updatedUser: User) {
  console.log("Saved user info:", updatedUser);
  // You can later use Inertia to submit
}
</script>

<template>
  <!-- Profile Modal -->
  <Dialog v-model:open="showProfileModal">
    <DialogTrigger as-child>
      <Button class="bg-background_green_darker hover:bg-background_green_light" @click="showProfileModal = true">
        Voir le Profil
      </Button>
    </DialogTrigger>
    <DialogContent>
      <DialogHeader>
        <div class="flex items-center justify-between mt-4">
          <DialogTitle class="text-lg font-semibold">Votre Profil</DialogTitle>
          <Button class="bg-blue-600 hover:bg-blue-500 text-white" @click="showEditModal = true">
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
  <EditProfileModal
    :open="showEditModal"
    :user="user"
    @close="showEditModal = false"
    @save="handleSave"
  />
</template>
