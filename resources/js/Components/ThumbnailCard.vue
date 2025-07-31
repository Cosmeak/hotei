<script setup lang="ts">
import { Badge } from "@/Components/ui/badge";
import { Button } from "@/Components/ui/button";
import { Link, router } from "@inertiajs/vue3";
import PaymentModal from "@/Components/PaymentModal.vue";
import type { Course, Project, User } from "@/types";
import { ref } from "vue";
import { usePage } from "@inertiajs/vue3";

const props = defineProps<{
  type: string;
  scope: Course | Project;
  user?: User | null;
}>();

const showModal = ref(false);
const isFreeOrOwned = props.scope.cost === 0 || props.scope.is_possessed;
const hasEnoughCredits =  usePage().props.auth.user && usePage().props.auth.user.credits >= props.scope.cost;

function handleClick(e: MouseEvent) {
  e.preventDefault();

  if (!usePage().props.auth.user) {
    return router.visit(route("login"));
  }

  if (isFreeOrOwned) {
    return router.visit(route(`${props.type}s.show`, props.scope.id));
  }

  if (hasEnoughCredits) {
    return router.get(
      route("course.setProject", {
        project: props.scope.id,
      })
    );
  }

  showModal.value = true;
}
</script>

<template>
  <div class="flex flex-col bg-white rounded-lg my-2 md:my-0 overflow-hidden">
    <div class="relative">
      <div class="w-full h-42 bg-gray-300">
        <img
          v-if="scope.thumbnail"
          :src="scope.thumbnail"
          :alt="scope.title"
        />
      </div>

      <div v-if="!isFreeOrOwned">
        <PaymentModal
          v-model:open="showModal"
          btn-classes="absolute -bottom-4 right-2"
          btn-variant="default"
          :label="isFreeOrOwned ? 'Lire' : `${scope.cost} Craftout`"
          :project-id="props.type == 'project' ? props.scope.id : null"
          :course-id="props.type == 'course' ? props.scope.id : null"
          @close="showModal = false"
        />
      </div>
      <div v-else>
        <Button
          class="absolute -bottom-4 right-2"
          :as="Link"
          :href="route('projects.show', scope.id)"
          @click="handleClick"
        >
          <span v-if="isFreeOrOwned">Lire</span>
          <span v-else>{{ scope.cost }} Craftout</span>
        </Button>
      </div>
    </div>

    <div class="mt-2 p-2">
      <Badge variant="accent">{{ type }}</Badge>
      <p class="text-lg">{{ scope.title }}</p>
      <p>par {{ scope.craftman.user?.fullname }}</p>
    </div>

    <div class="mt-auto p-2">
      <hr class="border-primary my-2" />
      <div class="flex flex-row justify-between">
        <Badge variant="secondary">{{ scope.difficulty }}</Badge>
        <p>{{ scope.duration }} heures</p>
      </div>
    </div>
  </div>
</template>
