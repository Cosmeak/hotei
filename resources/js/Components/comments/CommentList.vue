<script setup lang="ts">
import type { Comment } from '@/types';
import CommentNode from './CommentNode.vue';
import CommentForm from './CommentForm.vue';

const { comments, scope, scopeId } = defineProps<{ comments: Comment[], scope: 'project' |'course', scopeId: string }>();
</script>

<template>
  <section class="bg-muted w-full">
    <div class="container mx-auto py-8">
      <h2>Commentaires</h2>
      <div class="mx-4 mt-6 flex flex-col gap-4">
        <CommentForm :scope="scope" :scopeId="scopeId" />
        <div>
          <CommentNode
            v-for="comment in comments"
            :key="comment.id"
            :comment="comment"
            :isChild="false"
          />
        </div>
      </div>
    </div>
  </section>
</template>
