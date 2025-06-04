<script setup lang="ts">
import {onMounted} from 'vue';
import {useForm} from '@inertiajs/vue3';
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle
} from '@/Components/ui/dialog';
import {Button} from '@/Components/ui/button';
import {Input} from '@/Components/ui/input';
import {Label} from '@/Components/ui/label';
import {Card, CardContent, CardHeader as CardTop} from '@/Components/ui/card';

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
  (e: 'update:open', value: boolean): void;
}>();
const form = useForm({
  firstname: '',
  lastname: '',
  email: '',
});
onMounted(() => {
  form.defaults({
    firstname: props.user.firstname,
    lastname: props.user.lastname,
    email: props.user.email,
  });
  form.reset();
});

function onSubmit() {
  form.put(route('settings.update'), {
    onSuccess: () => emit('update:open', false),
  });
}
</script>

<template>
  <Dialog :open="open" @update:open="emit('update:open', $event)">
    <DialogContent>
      <DialogHeader>
        <DialogTitle class="text-lg font-semibold">Modifier le Profil</DialogTitle>
      </DialogHeader>
      <Card class="w-full">
        <CardTop>
        </CardTop>
        <CardContent>
          <form @submit.prevent="onSubmit" class="space-y-4 text-base">
            <div>
              <Label for="firstname">Prénom</Label>
              <Input id="firstname" v-model="form.firstname" type="text"/>
            </div>
            <div>
              <Label for="lastname">Nom de famille</Label>
              <Input id="lastname" v-model="form.lastname" type="text"/>
            </div>
            <div>
              <Label for="email">Email</Label>
              <Input id="email" v-model="form.email" type="email"/>
            </div>
            <div class="flex justify-end pt-4">
              <Button type="submit" :disabled="form.processing"
                      class="bg-background_green_darker hover:bg-background_green_light">
                Sauvegarder
              </Button>
            </div>
          </form>
        </CardContent>
      </Card>
    </DialogContent>
  </Dialog>
</template>
