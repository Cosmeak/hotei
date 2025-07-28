<script setup lang="ts">
import { useForm } from 'laravel-precognition-vue-inertia';
import { Input } from '@/Components/ui/input';
import { SendHorizontal } from 'lucide-vue-next';

const { scope, scopeId } = defineProps<{ scope: 'project'|'course', scopeId: string }>();

const form = useForm("post", route('comments.store'), {
  scope: scope,
  scope_id: scopeId,
  text: '',
});

function submit() {
  form.submit({
    preserveScroll: true,
    onSuccess: () => form.reset()
  });
}
</script>

<template>
  <form @submit.prevent="submit" class="flex bg-white border border-secondary p-2 rounded-lg gap-2">
    <Input
      v-model="form.text"
      class="border-none shadow-none placeholder:text-gray-400"
      placeholder="Rédiger un commentaire..."
    />
    <button class="cursor-pointer rounded-lg hover:text-secondary-darker duration-200" type="submit"><SendHorizontal /></button>
  </form>
</template>
