<script setup lang="ts">
import type { Comment } from '@/types';
import { formatDate } from '@vueuse/core';

const { comment, isChild } = defineProps<{ comment: Comment, isChild: boolean }>();
console.log(isChild);
</script>

<template>
  <div class="mt-4">
    <div class="flex justify-between">
      <span class="font-bold">{{ comment.user.fullname}}</span>
      <span>Le {{ formatDate(new Date(comment.created_at), "DD/MM/YY à hh:mm") }}</span>
    </div>
    <p>{{ comment.text }}</p>
  </div>
  <div v-if="comment.comments.length > 0" class="ms-8">
    <CommentNode v-for="subcomment in comment.comments" :key="subcomment.id" :comment="subcomment" :isChild="true" />
  </div>
</template>
