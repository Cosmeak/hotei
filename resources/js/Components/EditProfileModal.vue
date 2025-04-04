<script setup lang="ts">
import { watch, computed } from "vue";
import { useForm } from "@inertiajs/vue3";
import { Dialog, DialogContent, DialogHeader, DialogTitle } from "@/Components/ui/dialog";
import { Card, CardHeader, CardTitle, CardContent } from "@/Components/ui/card";
import { Button } from "@/Components/ui/button";
import { Input } from "@/Components/ui/input";

interface User {
  firstname: string;
  lastname: string;
  email: string;
}

const props = defineProps<{
  open: boolean;
  user: User;
}>();

const emit = defineEmits<{
  (e: "close"): void;
}>();

const form = useForm({
  firstname: props.user.firstname,
  lastname: props.user.lastname,
  email: props.user.email,
});

watch(() => props.open, (val) => {
  if (val) {
    form.firstname = props.user.firstname;
    form.lastname = props.user.lastname;
    form.email = props.user.email;
  }
});

function saveChanges() {
  form.put(route('profile.update'), {
    preserveScroll: true,
    onSuccess: () => emit("close"),
  });
}
</script>

<template>
  <Dialog :open="open" @update:open="val => !val && emit('close')">
    <DialogContent>
      <DialogHeader>
        <DialogTitle>Modifier</DialogTitle>
      </DialogHeader>
      <Card class="w-full">
        <CardHeader>
          <CardTitle>Modifier ses informations</CardTitle>
        </CardHeader>
        <CardContent>
          <div class="space-y-4 text-base">
            <div>
              <label>Prénom</label>
              <Input v-model="form.firstname" />
              <p v-if="form.errors.firstname" class="text-red-500 text-sm">{{ form.errors.firstname }}</p>
            </div>
            <div>
              <label>Nom</label>
              <Input v-model="form.lastname" />
              <p v-if="form.errors.lastname" class="text-red-500 text-sm">{{ form.errors.lastname }}</p>
            </div>
            <div>
              <label>Email</label>
              <Input v-model="form.email" />
              <p v-if="form.errors.email" class="text-red-500 text-sm">{{ form.errors.email }}</p>
            </div>
          </div>
          <div class="mt-6 flex justify-end space-x-2">
            <Button variant="outline" @click="emit('close')">Annuler</Button>
            <Button :disabled="form.processing" class="bg-background_green_darker hover:bg-background_green_light text-white" @click="saveChanges">
              Enregistrer
            </Button>
          </div>
        </CardContent>
      </Card>
    </DialogContent>
  </Dialog>
</template>
