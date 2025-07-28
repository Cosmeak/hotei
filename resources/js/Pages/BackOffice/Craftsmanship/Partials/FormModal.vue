<script setup lang="ts">
import { useForm } from 'laravel-precognition-vue-inertia';
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from '@/Components/ui/dialog'
import { Input } from '@/Components/ui/input';
import { Label } from '@/Components/ui/label';
import { Textarea } from '@/Components/ui/textarea';
import { Button, ButtonVariants } from '@/Components/ui/button';
import { ref } from 'vue';

const { triggerText, triggerVariant } = defineProps<{ triggerText: string, triggerVariant: ButtonVariants['variant'] }>();

const form = useForm('post', route('backoffice.craftsmanship.store'), {
  name: '',
  description: '',
  color: '#ffffff',
});

const open = ref(false);

const handleSubmit = () => {
  form.submit({
    preserveScroll: true,
    onSuccess: () => (open.value = false),
  });
};
</script>

<template>
  <Dialog v-model:open="open">
    <DialogTrigger as-child>
      <Button :variant="triggerVariant">
        {{ triggerText }}
      </Button>
    </DialogTrigger>

    <DialogContent class="sm:max-w-[425px]">
      <DialogHeader>
        <DialogTitle>Ajouter un artisanat</DialogTitle>
        <DialogDescription>
          Remplissez les informations ci-dessous pour ajouter un nouveau artisanat à la liste.
        </DialogDescription>
      </DialogHeader>
      <form id="form" @submit.prevent="handleSubmit" class="flex flex-col gap-4">
        <div>
          <Label for="title">Titre</Label>
          <Input id="title" name="title" v-model="form.name" required />
        </div>

        <div>
          <Label for="description">Description</Label>
          <Textarea id="description" name="description" v-model="form.description" required style="min-height: 128px;" />
        </div>

        <div>
          <Label for="color">Couleur de l'étiquette</Label>
          <Input id="color" name="color" v-model="form.color" required type="color"/>
        </div>

        <Button :disabled="form.processing" type="submit">Sauvegarder</Button>
      </form>
    </DialogContent>
  </Dialog>
</template>
